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
  <title>Image Management</title>
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
      <h1>Image Management</h1>
      <p>Choose one of the options below.</p>

      <!-- Adding new images -->
      <h2>Add New Vehicle Image</h2>
      <?php
        if (isset($message)) {
          echo $message;
        } 
      ?>
      <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
      <label for="invItem">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
          <label>Is this the main image for the vehicle?</label>
          <label for="priYes" class="pImage">Yes</label>
          <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
          <label for="priNo" class="pImage">No</label>
          <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
      <label>Upload Image:</label>
      <input type="file" name="file1">
      <input type="submit" class="regbtn" value="Upload">
      <input type="hidden" name="action" value="upload">
      </form>
      
      <hr>
      <h2>Existing Images</h2>
      <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
      <?php
        if (isset($imageDisplay)) {
          echo $imageDisplay;
        } 
      ?>

      <h3>Vehicle</h3>
      <?php echo $navList; ?>
      <h3>Upload Image</h3>
      <button>Choose file.</button><?php echo "No file chosen"; ?>


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


