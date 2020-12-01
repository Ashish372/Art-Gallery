<?php
    session_start();
    
    $username = '';

    $cartuser = "";

    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if (array_key_exists("id", $_SESSION) AND $_SESSION['login_status']) {

      $username = $_SESSION['username'];

      $user = "<a href='login_signin.php?logout=1'>Log out</a>";

      $cartuser = "<a href='cart.php'><img src='/Project/static/images/cart.png' height='30px'</a>";
        
    } else {

      $user = "<a href='login_signin.php'>LogIn/SignUp</a>";
        
    }
?>

<link rel="stylesheet" href="/Project/static/css/nav.css">
<link rel="shortcut icon" href="/Project/static/images/logo.ico" type="image/x-icon">
<link rel="stylesheet" href="/Project/static/css/index.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

<div class="topnav" id="myTopnav">

  <div class="options">
  
  <?php
echo "<p class='navname'>Welcome $username</p>";
echo $user;

?>
  <a href="catalogue.php">Explore</a>
    <a href="About.php">About Us</a>
    
    <?php
echo $cartuser;

?>

    
  </div>

  <a href="javascript:void(0);" style="font-size:25px; text-decoration:none;" class="icon" onclick="myFunction()">&#9776;</a>

  <div class="leftNav">
    <a href="index.php"><img src="/Project/static/images/cslogowithnamewhite.png" height="80px"></a>
  </div>

</div>

<script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script>
