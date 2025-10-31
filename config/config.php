<?php
if (!defined('HOST')) {
    define('HOST', 'localhost');
}
if (!defined('DBNAME')) {
    define('DBNAME', 'coffee-blend');
}
if (!defined('USER')) {
    define('USER', 'root');
}
if (!defined('PASS')) {
    define('PASS', '');
}
if (!defined('APPURL')) {
    define('APPURL', 'http://localhost/coffee-blend');
}

// Create PDO connection
try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME, USER, PASS);
    // Set error mode to exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "fine connection";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
