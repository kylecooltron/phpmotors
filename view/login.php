<?php
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
      <div class="login-form-info">
        <h1>Sign-in</h1>
      </div>
      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>
      <form action="/phpmotors/accounts/" method="post">
          <!-- email -->
          <label for="clientEmail">Email Addess</label>
          <input type="email" id="clientEmail" name="clientEmail"
          placeholder="Enter valid email address" 
          <?php if (isset($sticky["clientEmail"])) {
              echo "value='".$sticky["clientEmail"]."'";
          }?> required>
          <!-- password -->
          <label for="clientPassword">Password</label>
          <input type="password" id="clientPassword" name="clientPassword" 
          required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
          <span class="passreqs">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
          
          <!-- submit -->
          <input type="submit" value="Submit">
          <!-- Add the action name - value pair -->
          <input type="hidden" name="action" value="login">

        <div class="form-info">
          <em>Note: all fields are required.</em>
            <div>
              Don't have an account yet ?
            </div>
            <a href="/phpmotors/accounts/index.php?action=registration-page">Create an account</a> 
        </div>
      </form>
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