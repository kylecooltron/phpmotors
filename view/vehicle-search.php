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
  <meta name="description" content="PHP Motors - search">
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
      <?php echo '<h1>Search Inventory</h1>'; ?>

      <!-- display message if there is one -->
      <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

      <!-- search bar  -->

          <!-- TODO WHY DOES CLASSIFICATION HAVE CLIENT FIRST NAME AS VALUE? -->

      <!-- search form -->
      <form action="/phpmotors/search/index.php" method="get">
          <div class="hinted">
            <label for="searchText">Enter your search:</label>
            <input type="text" id="searchText" 
              name="searchText"
              maxlength="30"
              <?php if (isset($searchText)) {
                  echo "value='$searchText'";
              }?> required>
              <span class="hinttext">30 characters maximum</span>
          </div>
          <!-- submit -->
          <input type="submit" value="Search">
          <!-- ACTION - name - value -->
          <input type="hidden" name="action" value="vehicle-search-submit">
      </form>
    

      <?php
        # echo out search results
        if (isset($searchResults)) {
          echo $searchResults;
        }
        if (isset($pagination)) {
          echo $pagination;
        }
      ?>

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