<?php
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

.agentInsert {
  text-align: center;
  padding-bottom: 250px;
}

.allCompany {
  padding-top: 100px;
  display: flex;
  justify-content: space-evenly;
}

.queries {
  text-align: center;
}

button {
  color: black;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}


</style>

<div class="allCompany">
  <div class="officeID">
    <h1>Office ID For New Agents</h1>

    <?php
      $sql = "SELECT * FROM office";
      $q = $conn->query($sql);

      foreach ($q as $row) {
        echo $row[1]." ID is <b>".$row[0]."</b><br />\n";
      }
     ?>

  </div>

  <div class="agentInsert">
  <h1>Insert New Agent</h1>
    <form action="company.php" method="POST">
      <div>License Number (6):</div>
      <div>
          <input type="text" name="licNum" placeholder="License Number" value="<?php if(isset($_POST['licNum'])) echo $_POST['licNum']; ?>" required />
      </div>
      <div>Office ID:</div>
      <div>
          <input type="text" name="ofID" placeholder="Office ID" value="<?php if(isset($_POST['ofID'])) echo $_POST['ofID']; ?>" required />
      </div>
      <div>Firstname:</div>
      <div>
          <input type="text" name="fname" placeholder="Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" required />
      </div>
      <div>Lastname:</div>
      <div>
          <input type="text" name="lname" placeholder="Lastname" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" required />
      </div>
      <div>Commission Rate:</div>
      <div>
          <input type="text" name="comRate" placeholder="Commission Rate" value="<?php if(isset($_POST['comRate'])) echo $_POST['comRate']; ?>" required />
      </div>
      <div>Hired Date:</div>
      <div>
          <input type="date" name="hDate" value="<?php if(isset($_POST['hDate'])) echo $_POST['hDate']; ?>" required />
      </div>
      <div class="formSubmit">
          <input type="submit" value="Add Agent" />
      </div>
      <div><?php echo $message ?></div>
    </form>
</div>

<div class="queries">
  <h1>Query Analysis</h1>
    <div>
      <button><a href="queries.php">View Queries</a></button>
    </div>
</div>

</div>

<?php require('includes/footer.php'); ?>
