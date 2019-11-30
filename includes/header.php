<?php

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
 ?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Real State Multi</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/mystyle.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt=""></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav ml-auto">
								<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
								<li class="nav-item"><a class="nav-link" href="properties.html">Properties</a></li>
								<li class="nav-item"><a class="nav-link" href="agents.html">Agents</a></li>
                <!--<li class="nav-item active"><a class="nav-link" href="login.php">Login</a></li>-->
                <?php session_start();
        				if (isset($_SESSION['uname'])) {
        					echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
        				}
        				else {
        					echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
        				}
        				?>
							</ul>
						</div>
					</div>
            	</nav>
            </div>
        </header>
