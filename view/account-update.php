<?php

if(!isset($_SESSION['loggedin'])){
  # redirect to home page
  header('Location: /phpmotors/');
}else{
  $clientData = $_SESSION['clientData'];
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
      <h1>
        <?php
            echo "$clientData[clientFirstname] $clientData[clientLastname]'s Information"; 
        ?>
      </h1>

      <!-- display account info update message if there is one -->
      <?php
        if (isset($account_message)) {
          echo $account_message;
        } 
      ?>

      <form action="/phpmotors/accounts/index.php" method="post">
          <small>Account Information</small>
          <hr>
          <!-- name -->
          <label for="clientFirstname">First Name</label>
          <input type="text" id="clientFirstname" name="clientFirstname"
          <?php 
          if (isset($sticky["clientFirstname"])) {
              echo "value='".$sticky["clientFirstname"]."'";
          }elseif(isset($clientData['clientFirstname'])){
            echo "value='$clientData[clientFirstname]'"; 
          }
          ?> required>

          <label for="clientLastname">Last Name</label>
          <input type="text" id="clientLastname" name="clientLastname" 
          <?php 
          if (isset($sticky["clientLastname"])) {
              echo "value='".$sticky["clientLastname"]."'";
          }elseif(isset($clientData['clientLastname'])){
            echo "value='$clientData[clientLastname]'"; 
          }
          ?> required>
          <!-- email -->
          <label for="clientEmail">Email Addess</label>
          <input type="email" id="clientEmail" name="clientEmail" 
          placeholder="Enter valid email address" 
          <?php 
          if (isset($sticky["clientEmail"])) {
              echo "value='".$sticky["clientEmail"]."'";
          }elseif(isset($clientData['clientEmail'])){
            echo "value='$clientData[clientEmail]'"; 
          }
          ?> required>

        <!-- submit -->
        <input type="submit" value="Update Information">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="update-account-submit">
        <input type="hidden" name="clientId" value="
          <?php 
          if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
          elseif(isset($clientId)){ echo $clientId; } 
          ?>">

         <!-- form info  -->
        <div class="form-info">
          <em>Note: all fields are required.</em>
        </div>
      </form>

      <!-- display password change message if there is one -->
      <?php
        if (isset($password_message)) {
          echo $password_message;
        } 
      ?>

      <form action="/phpmotors/accounts/index.php" method="post"> 
        <!-- password -->
        <div class="hinted">
          <label for="clientPassword">Password</label>
          <input type="password" id="clientPassword" name="clientPassword" 
          required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
          <span class="hinttext">Must be at least 8 characters, contain at least 1 number, 1 capital letter and 1 special character</span>
        </div>
        <span class="passreqs">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <!-- submit -->
        <input type="submit" value="Change Password">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="update-password-submit">
        <input type="hidden" name="clientId" value="
          <?php 
          if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
          elseif(isset($clientId)){ echo $clientId; } 
          ?>">
      </form>

      <div class="back-link">
        <a href="/phpmotors/accounts/">Back to Account Page</a>
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

</html>