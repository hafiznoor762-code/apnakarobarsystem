<?php
function listFolderFiles($dir, $level = 0) {
    $ffs = scandir($dir);
    foreach ($ffs as $ff) {
        if ($ff != '.' && $ff != '..') {
            if (is_dir($dir . '/' . $ff)) {
                echo str_repeat("&nbsp;&nbsp;&nbsp;", $level) . "📁 <b style='color:blue'>" . $ff . "</b><br>";
                listFolderFiles($dir . '/' . $ff, $level + 1);
            } else {
                echo str_repeat("&nbsp;&nbsp;&nbsp;", $level) . "📄 " . $ff . "<br>";
            }
        }
    }
}

echo "<h2>📂 File Manager Structure</h2>";
listFolderFiles(__DIR__);
?>