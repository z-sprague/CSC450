<?php
  session_start();
  require('includes/header.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uname = $_POST['username'];
    $pwd = $_POST['password'];

    $sql = "SELECT * FROM web_users WHERE username='$uname' AND password='$pwd'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($users)) {

        $_SESSION['uname'] = $users[0];

        if ($uname == 'agent') {
            header('location: agent.php');
        }
        else if ($uname == 'buyer') {
          header('location: buyer.php');
        }
        else if ($uname == 'company') {
            header('location: company.php');
        }
        else {
          header('location: customer.php');
        }
    }
    else {
        echo 'Invalid username or password';
    }

  }

 ?>
        <!--================Header Menu Area =================-->

<section class="home_banner_area">
  <div class="loginForm">
    <div class="login">
    <h3>Login</h3>
      <form action="login.php" method="post">
          <div class="loginInput"><input type="text" name="username" placeholder="Username" required></input></div>
          <div class="loginInput"><input type="password" name="password" placeholder="Password" required></input></div>
        <button type="submit" value="submit" class="btn submit_btn">Login</button>
      </form>
    </div>
  </div>
</section>


        <!--================ start footer Area  =================-->
        <?php require('includes/footer.php'); ?>
