<html>
<head>
  <title>Basic PDO</title>
</head>

<body> 
<?php
$tns = "  
(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = CITDB.NKU.EDU)(PORT = 1521))
    (CONNECT_DATA =
		(SERVER = DEDICATED)
        (SERVICE_NAME = csc450.citdb.nku.edu)    
	)
)";
	   

$db_username = "spraguez1";
$db_password = "csc700";
try {
    $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
	echo 'Successfully connected to Oracle.';
	$conn = NULL; // destroy connection object, will close db connection
} catch(PDOException $e) {
    echo ($e->getMessage());
}
?>
</body>

</html>
