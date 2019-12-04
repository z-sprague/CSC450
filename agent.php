<?php
  require('includes/header.php');

  if (isset($_POST['inProp'])) {
    // Property information
    $pID = $_POST['pID'];
    $county = $_POST['county'];
    $addr = $_POST['addr'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $type = $_POST['type'];
    $built = $_POST['built'];
    $lPrice = $_POST['lPrice'];
    $rooms = $_POST['rooms'];
    $bedrooms = $_POST['bedrooms'];
    $sqft = $_POST['sqft'];
    $pool = $_POST['pool'];

      // Get information in the property table
      $sql_prop = "SELECT * FROM property WHERE prop_id=:pID";
      $data = array (
        ':pID' => $pID
      );
      $stmt = $conn->prepare($sql_prop);
      $stmt->execute($data);
      $p = $stmt->fetch(PDO::FETCH_ASSOC);

      // If property is not in the table
      if (empty($p)) {
        // Insert
        $sql = "Insert into property (prop_id, county, street_address, city, p_state, zip, p_type, listing_price, prop_date, num_of_rooms, num_of_bedrooms, square_footage, have_pool)
                values (:pID, :county, :addr, :city, :state, :zip, :type, :lPrice, TO_DATE(:built, 'yyyy-mm-dd'), :rooms, :bedrooms, :sqft, :pool)";
        $val = array (
          ':pID' => $pID,
          ':county' => $county,
          ':addr' => $addr,
          ':city' => $city,
          ':state' => $state,
          ':zip' => $zip,
          ':type' => $type,
          ':built' => $built,
          ':lPrice' => $lPrice,
          ':rooms' => $rooms,
          ':bedrooms' => $bedrooms,
          ':sqft' => $sqft,
          ':pool' => $pool
        );
        $conn->beginTransaction();
        $stmt = $conn->prepare($sql);
        $r = $stmt->execute($val); // Results

        // Check if insertion fails
        if ($r === false) {
          $message = 'Error Inserting!';
        }
        else {
          $message = 'Property Inserted!';
        }
        // Commit changes
        $conn->commit();
      }
      else {
        $message = 'Property ID is currently in use!';
      }
  }

  /* Modify a Listing */
  if (isset($_POST['modList'])){

    $pID = $_POST['propID'];
    $pDate = $_POST['pDate'];
    $new = $_POST['newPrice'];

    $sql_mod = "SELECT * FROM property WHERE prop_id=:propID";
    $data = array (
      ':propID' => $pID
    );
    $stmt = $conn->prepare($sql_mod);
    $stmt->execute($data);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($p)) {
      $sql = "UPDATE listing SET purchase_date=TO_DATE(:pDate, 'yyyy-mm-dd'), price=:newPrice WHERE prop_id=:propID";
      $val = array (
        ':pDate' => $pDate,
        ':newPrice' => $new,
        ':propID' => $pID
      );
      $conn->beginTransaction();
      $stmt = $conn->prepare($sql);
      $r = $stmt->execute($val); // Results

      // Check if modification fails
      if ($r === false) {
        $message1 = 'Error Modifying!';
      }
      else {
        $message1 = 'Listing Modified!';
      }
      // Commit changes
      $conn->commit();
    }
    else {
      $message1 = 'No Listing Associated with that ID!';
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

.agentList .agentSearchList .propInsert{
  text-align: center;
}

.agentForm {
  padding: 5px;
}

.formSubmit {
  text-align: center;
}

.message {
  text-align: center;
}

 </style>

<div class="agentPage">
  <div class="propInsert">
  <h1>Insert New Property</h1>
    <form action="agent.php" method="POST">
      <table cellpadding='10'>
      <tr><th>Property ID:</th>
          <td><input type="text" name="pID" placeholder="Property ID" required /></td>
      </tr>
      <tr><th>County:</th>
          <td><input type="text" name="county" placeholder="County" required /></td>
      </tr>

      <tr><th>Street Address:</th>
          <td><input type="text" name="addr" placeholder="Address" required /></td>
      </tr>

      <tr><th>City:</th>
          <td><input type="text" name="city" placeholder="City" required /></td>
      </tr>

      <tr><th>State:</th>
          <td><input type="text" name="state" placeholder="State" required /></td>
      </tr>

      <tr><th>Zip Code:</th>
          <td><input type="text" name="zip" placeholder="Zip Code" required /></td>
      </tr>

      <tr><th>Type:</th>
          <td><input type="text" name="type" placeholder="Type" required /></td>
      </tr>

      <tr><th>Date Built:</th>
          <td><input type="date" name="built" required /></td>
      </tr>

      <tr><th>Listing Price:</th>
          <td><input type="text" name="lPrice" placeholder="Price" required /></td>
      </tr>

      <tr><th># of Rooms:</th>
          <td><input type="text" name="rooms" placeholder="Rooms" required /></td>
      </tr>

      <tr><th># of Bedrooms:</th>
          <td><input type="text" name="bedrooms" placeholder="Bedrooms" required /></td>
      </tr>

      <tr><th>Square Footage:</th>
          <td><input type="text" name="sqft" placeholder="Square Footage" required /></td>
      </tr>

      <tr><th>Pool (Y/N):</th>
          <td><input type="text" name="pool" placeholder="Pool" required /></td>
      </tr>

    </table>
      <div class="formSubmit">
          <button name="inProp">Add Property</button>
      </div>
      <div class="message"><?php echo $message ?></div>
    </form>
</div>

  <div class="agentList">
    <h1>Modify a Listing</h1>
    <form method="post">
      <table cellpadding='10'>
        <tr><th>Property ID:</th>
        <td><input type="text" name="propID" placeholder="Property ID" /></td>
        <tr><th>Date Listed:</th>
        <td><input type="date" name="pDate" /></td>
        <tr><th>Listing Price:</th>
        <td><input type="text" name="newPrice" placeholder="New Price" /></td>
      </table>
      <div class="formSubmit">
          <button name="modList">Modify</button>
      </div>
      <div class="message"><?php echo $message1 ?></div>
    </form>
  </div>

  <div class="agentSearchProp">
    <h1>Search for Property</h1>
      <table align="center" cellpadding="10">
      <form method="post'">
      <!--<tr><th>Type:</th><td><input type="text" placeholder="House, Apartment or Condo" name="type" required></input></td></tr>-->
      <tr><th>Type:</th><td><select name="type"><option value="House">House</option><option value="Apartment">Apartment</option><option value="Condo">Condo</option></select></td></tr>
      <tr><th>Number of Bedrooms:</th><td><input type="text" placeholder="Bedrooms" name="numBed" required></input></td></tr>

      <tr><th>Have a Pool (Y/N):</th><td><select name="pool"><option value="Y">Y</option><option value="N">N</option></td></tr>
      <tr><th>County:</th><td><input type="text" placeholder="County" name="county" required></input></td></tr>
      </form>
    </table>
    <div class="formSubmit">
        <button name="searchProp">Search</button>
    </div>
  </div>

  <div class="agentSearchList">
    <h1>Search for Listing</h1>
    <form method="post">
      <table cellpadding='10'>
      <tr><th>Property ID:</th>
        <td><input type="text" name="searchPropID" placeholder="Property ID" /></td></tr>
        <tr><th>Date Listed:</th>
        <td><input type="date" name="searchDate" /></td></tr>
        <tr><th>Listing Price:</th>
        <td><input type="text" name="Price" placeholder="New Price" /></td></tr>
      </table>
    </form>
    <div class="formSubmit">
        <button name="searchList">Search</button>
    </div>
  </div>
</div>

<div class="searchForms">
  <?php
  /* Search for property */
  if (isset($_POST['searchProp'])){

    $type = $_POST['type'];
    $broom = $_POST['numBed'];
    $pool = $_POST['pool'];
    $county = $_POST['county'];

    $sql = "SELECT * FROM property WHERE p_type=:type AND num_of_bedrooms=:numBed AND have_pool=:pool AND county=:county";
    $data = array (
      ':type' => $type,
      ':numBed' => $broom,
      ':pool' => $pool,
      ':county' => $county
    );
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($p)){
      echo 'WORKING';
    }


  }


  ?>
</div>


<?php require('includes/footer.php'); ?>
