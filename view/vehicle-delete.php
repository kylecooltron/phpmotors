<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php 
      if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Delete $invInfo[invMake] $invInfo[invModel]";
      }elseif(isset($invMake) && isset($invModel)){ 
        echo "Delete $invMake $invModel"; 
      }
    ?> | PHP Motors
  </title>
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
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
          echo "Delete $invInfo[invMake] $invInfo[invModel]";
        }elseif(isset($invMake) && isset($invModel)) { 
          echo "Delete $invMake $invModel"; 
        }
      ?>
    </h1>

      <!-- display message if there is one -->
      <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

      <!-- modify vehicle form -->
      <form class="modify-vehicle-form" action="/phpmotors/vehicles/index.php" method="post">

          <!-- make -->
          <label for="invMake">Make</label>
          <input type="text" id="invMake" name="invMake"
          <?php
            if(isset($invInfo['invMake'])){
              echo "value='$invInfo[invMake]'"; 
            }
          ?> readonly>
          <!-- model  -->
          <label for="invModel">Model</label>
          <input type="text" id="invModel" name="invModel"
          <?php
            if(isset($invInfo['invModel'])){
              echo "value='$invInfo[invModel]'"; 
            }
          ?> readonly>

          <!-- description  -->
          <label for="invDescription">Description</label>
          <textarea id="invDescription" name="invDescription" 
          maxlength="50" rows="4" readonly><?php 
          if(isset($invInfo['invDescription'])){
            echo $invInfo["invDescription"]; 
          }
          ?></textarea>

          <!-- submit -->
          <input type="submit" value="Delete Vehicle">
          <!-- ACTION - name - value -->
          <input type="hidden" name="action" value="delete-vehicle-submit">
          <input type="hidden" name="invId" value="
          <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}?>">

        <!-- extra form info  -->
        <div class="form-info">
          <em>Confirm Vehicle Deletion. The delete is permanent.</em>
        </div>
      </form>

      <div class="back-link">
        <a href="/phpmotors/vehicles/">Back to Vehicle Management</a>
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