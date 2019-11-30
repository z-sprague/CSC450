<?php
session_start();
// Include file with database connection

// Connect to the Oracle database
$dbc = "(DESCRIPTION =
  (ADDRESS = (PROTOCOL = TCP)(HOST = CITDB.NKU.EDU)(PORT = 1521))
  (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = csc450.citdb.nku.edu)))";

$DB_USER = "SPRAGUEZ1";
$DB_PASS = "csc700";

echo "Testing the database connection<br>";

try {
  $conn = new PDO("oci:dbname=".$dbc, $DB_USER, $DB_PASS);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'Connected to the Database';
}
catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from form as variables
    $username = $_POST['uname'];
    $password = $_POST['pass'];

}
*/
?>
