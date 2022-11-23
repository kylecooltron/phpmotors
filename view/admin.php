<?php

if(!isset($_SESSION['loggedin'])){
  # redirect to home page
  header('Location: /phpmotors/');
}else{
  $clientData = $_SESSION['clientData'];
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
} 
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors</title>
  <meta name="author" content="Kyle Coulon">
  <meta name="description" content="PHP Motors student website">
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
  <!-- style sheets -->
  <link rel="stylesheet" href="/phpmotors/css/small.css">
  <link rel="stylesheet" href="/phpmotors/css/medium.css">
  <link rel="stylesheet" href="/phpmotors/css/large.css">
</head>

<body>
  <div id="wrapper">
    <!-- header -->
    <header id="page_header">
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    </header>
    <!-- navigation -->
    <nav>
      <?php echo $navList; ?>
    </nav>
    <!-- main content -->
    <main>
      <?php 
        echo "<h1>$clientData[clientFirstname] $clientData[clientLastname]</h1>"; 
        # display session message
        if (isset($message)) { 
          echo $message; 
        } 
      ?>
      <ul>
        <?php
          foreach ($clientData as $key => $value){
            if($key != "clientLevel"){
              echo "<li> {$key}: {$value} </li>";
            }
          }
        ?>
      </ul>
      <div class="vehicle-class">
        <?php
          # navigation to update account information
          echo "<h3>Account</h3>";
          echo "<a href='/phpmotors/accounts/index.php?action=update-account-page";
          echo "&clientId=$clientData[clientId]'>Update Account Information</a>";
        ?>
      </div>

      
      <?php
        # navigation to vehicle management for admins
        if($clientData['clientLevel'] > 1){
          echo "<div class='vehicle-class'>";
          echo "<h3>Vehicles</h3>";
          echo "<p> Admins have permission to manage vehicles and inventory:</p>
                <a href='/phpmotors/vehicles/'> Vehicle Management </a>";
          echo "</div>";
        }
      ?>

    <div class="back-link">
      <p class="small-logout">You are currently logged in. Click 
      <a href='/phpmotors/accounts/index.php?action=logout' title='Log Out'>here</a>
      to log out.
      </p>
    </div>

    </main>
    <!-- footer -->
    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    <!-- java script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </div>
</body>

</html><?php unset($_SESSION['message']); ?>