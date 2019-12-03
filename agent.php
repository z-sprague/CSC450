<?php
  session_start();
  require('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Agent information
    $lic = $_POST['licNum'];
    $office = $_POST['ofID'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $rate = $_POST['comRate'];
    $hired = $_POST['hDate'];

    // License number must be 6 charcters long
    if (strlen($lic) == 6) {
      // Get information in the agent table
      $sql_agent = "SELECT * FROM agents WHERE license_num=:licNum";
      $data = array (
        ':licNum' => $lic
      );
      $stmt = $conn->prepare($sql_agent);
      $stmt->execute($data);
      $agents = $stmt->fetch(PDO::FETCH_ASSOC);

      // If agent is not in the table
      if (empty($agents)) {
        // Insert
        $sql = "Insert into agent (license_num, office_id, firstname, lastname, commission_rate, date_hired)
                values (:licNum, :ofID, :fname, :lname, :comRate, TO_DATE(:hDate, 'yyyy-mm-dd'))";
        $val = array (
          ':licNum' => $lic,
          ':ofID' => $office,
          ':fname' => $fname,
          ':lname' => $lname,
          ':comRate' => $rate,
          ':hDate' => $hired
        );
        $conn->beginTransaction();
        $stmt = $conn->prepare($sql);
        $r = $stmt->execute($val); // Results

        // Check if insertion does not fail
        if ($r === false) {
          $message = 'Error Inserting!';
        }
        else {
          $message = 'Agent Inserted!';
        }
        // Commit changes
        $conn->commit();
      }
      else {
        $message = 'License number is currently in use!';
      }

    }
    else {
      $message = 'License code must be alphanumeric and length of 6!';
    }

  }

 ?>

 <style>

.agentPage {
  padding-top: 100px;
  padding-bottom: 250px;
  display: flex;
  justify-content: space-evenly;
}

 </style>

<div class="agentPage">
  <div class="agentInfo">
    <h1>Insert New Property</h1>
  </div>

  <div class="agentInfo">
    <h1>Modify a Property</h1>
  </div>

</div>

<?php require('includes/footer.php'); ?>
