<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php?page=login");
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../engine/placement_engine.php';
require_once __DIR__ . '/../engine/comission_engine.php';
require_once __DIR__ . '/../engine/spillover_engine.php';

// INPUTS
$user_email      = trim($_POST['user_email'] ?? '');
$activation_code = trim($_POST['activation_code'] ?? '');
$referral_email  = trim($_POST['referral_email'] ?? '');

if (empty($user_email) || empty($activation_code) || empty($referral_email)) {
    header("Location: index.php?page=activate_buyer&error=" . urlencode("All fields required"));
    exit;
}

try {
    // ================================================================
    // Poori activation ek hi DB transaction ke andar hoti hai.
    // "FOR UPDATE" us user ki row ko lock kar deta hai — agar wahi
    // user do baar (double-click ya do tabs se) form submit kare,
    // dusri request pehli request ke commit/rollback hone tak
    // rukegi, aur phir status 'active' dekh kar khud reject ho jayegi.
    // ================================================================
    $conn->beginTransaction();

    $stmt = $conn->prepare("
        SELECT id, status, unlock_codes
        FROM users
        WHERE email = ?
        LIMIT 1
        FOR UPDATE
    ");
    $stmt->execute([$user_email]);

    if (!$stmt->rowCount()) {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("Email not found"));
        exit;
    }

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Agar user pehle se active hai to dobara activation bilkul na ho
    if ($user['status'] === 'active') {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("This account is already activated."));
        exit;
    }

    // Activation code check
    if (trim((string) $user['unlock_codes']) !== $activation_code) {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("Invalid activation code"));
        exit;
    }

    $user_id = $user['id'];

    // Self referral stop
    if (strtolower($user_email) === strtolower($referral_email)) {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("Cannot refer yourself"));
        exit;
    }

    // Referral exists?
    $ref = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $ref->execute([$referral_email]);
    if (!$ref->rowCount()) {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("Referral email not found"));
        exit;
    }
    $upliner_id = $ref->fetchColumn();

    // ================================================================
    // Conditional UPDATE — "AND status != 'active'" ye ensure karta
    // hai ke agar (kisi race condition ki wajah se) row already
    // active ho chuki ho to ye UPDATE 0 rows update karega. Hum
    // rowCount() check karke turant ruk jaate hain, taake neeche
    // wale placement / commission / spillover functions kabhi
    // dobara na chalein.
    // ================================================================
    $update = $conn->prepare("
        UPDATE users
        SET status = 'active',
            referred_by_email = ?,
            unlock_codes = NULL
        WHERE id = ?
          AND status != 'active'
    ");
    $update->execute([$referral_email, $user_id]);

    if ($update->rowCount() !== 1) {
        $conn->rollBack();
        header("Location: index.php?page=activate_buyer&error=" . urlencode("This account is already activated."));
        exit;
    }
    // Placement
    placeUserInNetwork($conn, $user_id, $upliner_id);

    // Is naye buyer ne jo product khareeda, uski direct_commission maloom karo
    $prodStmt = $conn->prepare("
        SELECT p.direct_commission
        FROM users u
        INNER JOIN products p ON p.pin = u.product_code
        WHERE u.id = ?
        LIMIT 1
    ");
    $prodStmt->execute([$user_id]);
    $directAmount = (int) $prodStmt->fetchColumn();

    // Direct commission upliner ko — ab product ke hisaab se
    // (source_user_id = yehi naya activate hone wala buyer)
    giveDirectCommission($conn, $upliner_id, $user_id, $directAmount);

    // Indirect / spillover check
    handleSpillover($conn, $user_id);

    // Sab kuch theek raha to ab hi commit hoga — is se pehle
    // koi bhi cheez DB mein permanently save nahi hoti.
    $conn->commit();

    header("Location: index.php?page=login&success=" . urlencode("Account Activated Successfully"));
    exit;

} catch (PDOException $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    header(
        "Location: index.php?page=activate_buyer&error=" .
        urlencode($e->getMessage())
    );
    exit;
}