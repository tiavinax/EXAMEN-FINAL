<?php
// test_base_url.php dans ton dossier public
echo '<h2>Debug BASE_URL</h2>';
echo '$_SERVER[\'SCRIPT_NAME\']: ' . $_SERVER['SCRIPT_NAME'] . '<br>';
echo 'dirname($_SERVER[\'SCRIPT_NAME\']): ' . dirname($_SERVER['SCRIPT_NAME']) . '<br>';
echo 'rtrim(dirname($_SERVER[\'SCRIPT_NAME\']), \'/\'): ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '<br>';
echo 'URL actuelle: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '<br>';