<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
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

      <div class='vehicle-man-grid'>

        <div>
          <?php echo '<h1>Vehicle Management</h1>';
            if (isset($message)) { 
              echo $message; 
            } 
          ?>
          <div class="vehicle-management">
            <a href="/phpmotors/vehicles/index.php?action=add-classification-page">Add Classification</a>
            <a href="/phpmotors/vehicles/index.php?action=add-vehicle-page">Add Vehicle</a>
          </div>
        </div>

        <div class="vehicle-class">
          <?php
          if (isset($classificationList)) { 
          echo '<h2>Vehicles By Classification</h2>'; 
          echo '<p>Choose a classification to see those vehicles</p>'; 
          echo $classificationList; 
          }
          ?>
          <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
          </noscript>
          <table id="inventoryDisplay"></table>
        </div>

      </div>

    </main>
    <!-- footer -->
    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
    </footer>
    <!-- java script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </div>
  <script src="../js/inventory.js"></script>
</body>

</html><?php unset($_SESSION['message']); ?>