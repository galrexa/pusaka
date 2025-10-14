<?php
echo "<h3>POST Data:</h3>";
print_r($_POST);

echo "<h3>FILES Data:</h3>";
print_r($_FILES);

echo "<h3>Server Info:</h3>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";
