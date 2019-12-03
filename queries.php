<?php
  require('includes/header.php');
  /* Show query 1 */


 ?>

 <style>

 .allQuery {
   padding-top: 100px;
   padding-bottom: 150px;
   display: flex;
   justify-content: space-evenly;
 }

 .query {
   text-align: center;
 }

 .showQueries {
   text-align: center;
   padding-bottom: 150px;
 }

 tr {
   border-bottom: 1px solid black;
 }

 input {
   cursor: pointer;
 }

 .backBtn {
   color: black;
   text-align: center;
   padding-bottom: 15px;
 }

 </style>

 <div class="allQuery">

   <div class="query">
     <h2>Query 1</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 1" name="q1" />
       </form>
     </div>
   </div>

   <div class="query">
     <h2>Query 2</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 2" name="q2" />
       </form>
     </div>
   </div>

   <div class="query">
     <h2>Query 3</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 3" name="q3" />
       </form>
     </div>
   </div>

   <div class="query">
     <h2>Query 4</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 4" name="q4" />
       </form>
     </div>
   </div>

   <div class="query">
     <h2>Query 5</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 5" name="q5" />
       </form>
     </div>
   </div>

   <div class="query">
     <h2>Query 6</h2>
     <div>
       <form method="post">
         <input type="submit" value="Show Query 6" name="q6" />
       </form>
     </div>
   </div>

 </div>

 <div class="showQueries">
   <?php
   /* Displays query 1 */
   if (isset($_POST['q1'])){
     echo "<h2>Sale Trends</h2>\n";
     $sql = "SELECT l.purchase_date, p.p_type, p.city, b.min_preferred_price, b.max_preferred_price
              from listing l left join property p
              on l.prop_id = p.prop_id left join buyer b
              on b.prop_id = l.prop_id";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Purchase Date</th>
              <th>Type</th>
              <th>City</th>
              <th>Min Price</th>
              <th>Max Price</th>
            </tr>";

     foreach ($q as $row) {
       echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
     }
     echo "</table>";
   }

   /* Displays query 2 */
   if (isset($_POST['q2'])){
     echo "<h2>Average Selling Price of Property in 2019 for each Agent</h2>\n";
     $sql = "SELECT a.license_num, AVG(l.price), AVG(l.purchase_date - p.prop_date)
              from agent a left join buyer b
              on b.license_num = a.license_num left join listing l
              on b.prop_id = l.prop_id left join property p
              on p.prop_id = b.prop_id
              group by a.license_num";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Agent License Number</th>
              <th>Average Price</th>
              <th>Number of Days on the Market</th>
            </tr>";

     foreach ($q as $row) {
       echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
     }
     echo "</table>";
   }

   /* Displays query 3 */
   if (isset($_POST['q3'])){
     echo "<h2>Each Agents Number of Transactions</h2>\n";
     $sql = "SELECT firstname, lastname, COUNT(a.license_num)
              from agent a full join buyer b
              on a.license_num = b.license_num full join seller s
              on a.license_num = s.license_num
              group by firstname, lastname";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Number of Transactions</th>
            </tr>";

     foreach ($q as $row) {
       echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
     }
     echo "</table>";
   }

   /* Displays query 4 */
   if (isset($_POST['q4'])){
     echo "<h2>Total Amount Made for each Office</h2>\n";
     $sql = "SELECT o.name, SUM(l.price)
              from office o left join agent a
              on o.office_id = a.office_id left join seller s
              on a.license_num = s.license_num left join listing l
              on l.prop_id = s.prop_id
              group by o.name";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Real Estate Office</th>
              <th>Total Amount Accumulated</th>
            </tr>";

     foreach ($q as $row) {
       echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
     }
     echo "</table>";
   }

   /* Displays query 5 */
   if (isset($_POST['q5'])){
     echo "<h2>Best Selling Month</h2>\n";
     $sql = "SELECT MAX(EXTRACT(month from purchase_date))
              from listing";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Best Month</th>
            </tr>";

     foreach ($q as $row) {
       if ($row[0] == 1) $d = "January";
       if ($row[0] == 2) $d = "Febuary";
       if ($row[0] == 3) $d = "March";
       if ($row[0] == 4) $d = "April";
       if ($row[0] == 5) $d = "May";
       if ($row[0] == 6) $d = "June";
       if ($row[0] == 7) $d = "July";
       if ($row[0] == 8) $d = "August";
       if ($row[0] == 9) $d = "September";
       if ($row[0] == 10) $d = "October";
       if ($row[0] == 11) $d = "November";
       if ($row[0] == 12) $d = "December";
       echo "<tr><td>".$d."</td></tr>";
     }
     echo "</table>";
   }

   /* Displays query 6 */
   if (isset($_POST['q6'])){
     echo "<h2>Total Days Unsold Property Has Been on the Market</h2>\n";
     $sql = "SELECT prop_id, (trunc(sysdate) - p.prop_date) as timeday
              from property p
              where (trunc(sysdate) - p.prop_date) = (select MAX((trunc(sysdate) - p.prop_date)) from property)";
     $q = $conn->query($sql);

     echo "<table align='center' cellpadding='15'>
            <tr>
              <th>Property ID</th>
              <th>Total Days Unsold</th>
            </tr>";

     foreach ($q as $row) {
       echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";
     }
     echo "</table>";
   }

   ?>
 </div>

 <div class="backBtn">
   <button><a href="company.php">Back</a></button>
 </div>

 <?php require('includes/footer.php'); ?>
