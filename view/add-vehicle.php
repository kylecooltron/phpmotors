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
      <h1>Add Vehicle</h1>

      <!-- display message if there is one -->
      <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

      <!-- add vehicle form -->
      <form class="add-vehicle-form" action="/phpmotors/vehicles/index.php" method="post">

          <!-- make, model, description -->
          <label for="invMake">Make</label>
          <input type="text" id="invMake" name="invMake"
          <?php if (isset($sticky["invMake"])) {
              echo "value='".$sticky["invMake"]."'";
          }?> required>
          <label for="invModel">Model</label>
          <input type="text" id="invModel" name="invModel"
          <?php if (isset($sticky["invModel"])) {
              echo "value='".$sticky["invModel"]."'";
          }?> required>

          <!-- dynamic classification select input  -->
          <label for="classificationId">Classification</label>
          <?php
            echo $classificationList;
          ?>
          <!-- description  -->
          <label for="invDescription">Description</label>
          <textarea id="invDescription" name="invDescription" 
          maxlength="50" rows="4"required><?php 
          if (isset($sticky["invDescription"])) {
              echo $sticky["invDescription"];
          }?></textarea>
           <!-- image path  -->
          <label for="invImage">Image Path</label>
          <input type="text" id="invImage" 
                 name="invImage"
                 size="30"
                  <?php if (isset($sticky["invImage"])) {
                    echo "value='".$sticky["invImage"]."'";
                  }else{echo "value='/phpmotors/images/no-image.png'";}?> required>
          <!-- thumbnail path  -->
          <label for="invThumbnail">Thumbnail Path</label>
          <input type="text" id="invThumbnail" 
                 name="invThumbnail"
                 size="30"
                 <?php if (isset($sticky["invThumbnail"])) {
                    echo "value='".$sticky["invThumbnail"]."'";
                  }else{echo "value='/phpmotors/images/no-image.png'";}?> required>
          <!-- color  -->
          <label for="invColor">Color</label>
          <select name="invColor" id="invColor">
            <?php
              if (isset($colorOptions)) {
                echo $colorOptions;
                }
            ?>
          </select>

          <div class="form-columns">
            <div>
              <!-- price -->
              <label for="invPrice">Price</label>
              <input id="invPrice" name="invPrice" 
                    type="number" min="1" step="any"
                    <?php if (isset($sticky["invPrice"])) {
                      echo "value='".$sticky["invPrice"]."'";
                    }else{echo "value='1.00'";}?> required />
            </div>
            <div>
              <!-- stock -->
              <label for="invStock">Stock</label>
              <input id="invStock" name="invStock" 
                    type="number" min="0" step="1"
                    <?php if (isset($sticky["invStock"])) {
                      echo "value='".$sticky["invStock"]."'";
                    }else{echo "value='1'";}?> required />
            </div>
          </div>

          <!-- submit -->
          <input type="submit" value="Add Vehicle">
          <!-- ACTION - name - value -->
          <input type="hidden" name="action" value="add-vehicle-submit">

        <!-- extra form info  -->
        <div class="form-info">
          <em>Note: all fields are required.</em>
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