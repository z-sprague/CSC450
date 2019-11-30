<?php

  session_start();

  // Connect to the Oracle database
  $dbc = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = CITDB.NKU.EDU)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = csc450.citdb.nku.edu)))";

  $DB_USER = "SPRAGUEZ1";
  $DB_PASS = "csc700";

  try {
      $conn = new PDO("oci:dbname=" .$dbc, $DB_USER, $DB_PASS);
      //echo 'Successfully connected';
  } catch(PDOException $e) {
      echo ($e->getMessage());
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agent information
    $u = $_POST['uname'];
    $p = $_POST['pwd'];

    // Get information in the agent table
    $sql_agent = "SELECT * FROM web_users WHERE username=:uname";
    $data = array (
      ':uname' => $u
    );
    $stmt = $conn->prepare($sql_agent);
    $stmt->execute($data);
    $affected = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If agent is not in the table
    if (empty($affected)) {
      // Insert
      $sql = "insert into web_users (username, password) values (:uname, :pwd)";
      $val = array (
        'uname' => $u,
        'pwd' => $p
      );
      $conn->beginTransaction();
      $stmt = $conn->prepare($sql);
      $a = $stmt->execute($val);

      // Check if insertion fails
      if ($a === false) {
        $message = 'Error Inserting!';
      }
      else {
        $message = 'User Inserted!';
      }
      // Commit changes
      $conn->commit();
    }
    else {
      $message = 'Username is currently in use!';
    }

  }

 ?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Real State Multi</title>

    </head>

        <div class="agentInsert">
          <h1>Insert New Web User</h1>
          <form method="POST" class="productionForm">
              <div>Username:</div>
              <div>
                  <input type="text" name="uname" placeholder="Username" required />
              </div>
              <div>Password:</div>
              <div>
                  <input type="text" name="pwd" placeholder="Password" required />
              </div>
              <div class="formSubmit">
                  <input type="submit" value="Add Agent" />
              </div>
              <div class="alert"><?php echo $message ?></div>
          </form>
        </div>
      </body>
  </html>
