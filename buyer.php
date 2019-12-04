<?php
  require('includes/header.php');
 ?>

 <style>

 .buyerPage {
   padding-top: 100px;
   padding-bottom: 20px;
   text-align: center;
 }

  .buyerSearch {
    text-align: center;
    padding: 45px;
  }

  .buyerPage input {
    width: 15em;
  }

  .searchBtn {
    text-align: center;
    padding-bottom: 100px;
  }

  .searchTable {
    padding-top: 50px;
  }

  .PropTable {
    padding-bottom: 50px;
  }

  .result tr {
    border-bottom: 1px solid black;
  }

 </style>

  <div class="buyerPage">
    <h1>Search For Property</h1>
    <div class="searchTable">
      <table align="center" cellpadding="15">
      <form method="post'">
      <tr><th>Type</th><td><input type="text" placeholder="House, Apartment or Condo" name="type" required></input></td><td></td>
        <th>Number of Bedrooms</th><td><input type="text" placeholder="Bedrooms" name="numBed" required></input></td><tr>

      <tr><th>Have a Pool (Y/N)</th><td><input type="text" placeholder="Pool" name="pool" required></input></td><td></td>
        <th>County</th><td><input type="text" placeholder="County" name="county" required></input></td><tr>
    </form>
    </table>
  </div>
  </div>

  <div class="searchBtn">
    <form method="post">
      <input type="submit" value="Search"></input>
    </form>
  </div>

  <div class="PropTable">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Agent information
      $type = $_POST['type'];
      $numBed = $_POST['numBed'];
      $pool = $_POST['pool'];
      $county = $_POST['county'];

      // Create query to search for property
      $sql = "SELECT * FROM property where p_type=:type";
      //AND num_of_bedrooms='$numBed' AND have_pool='$pool' AND county='$county'";
      //$sql = "SELECT * FROM property";
      //$date = array (
      //  ':type' => $type
      //);


      //$conn->beginTransaction();
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':type', $type);
      $stmt->execute(); // Results
      $r = $stmt->fetch(PDO::FETCH_ASSOC);

      echo "<table class='result' align='center' cellpadding='15'>
             <tr>
               <th>Property ID</th>
               <th>County</th>
               <th>Address</th>
               <th>City</th>
               <th>State</th>
               <th>Zip Code</th>
               <th>Type</th>
               <th>Price</th>
               <th>Date Built</th>
               <th># Rooms</th>
               <th># Bedrooms</th>
               <th>Sqft</th>
               <th>Have Pool</th>
             </tr>";

      foreach ($r as $row) {
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td>
          <td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td>
          <td>".$row[11]."</td><td>".$row[12]."</td></tr>";
      }
      echo "</table>";

      }
    ?>
  </div>

<?php require('includes/footer.php'); ?>
