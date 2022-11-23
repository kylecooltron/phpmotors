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
    <h1>Add Classification</h1>

      <!-- display message if there is one -->
      <?php
        if (isset($message)) {
        echo $message;
        }
      ?>

      <!-- add classification form -->
      <form action="/phpmotors/vehicles/index.php" method="post">

          <!-- classification name -->
          <div class="hinted">
            <label for="classificationName">Classification Name</label>
            <input type="text" id="classificationName" 
              name="classificationName"
              maxlength="30"
              <?php if (isset($clientFirstname)) {
                  echo "value='$clientFirstname'";
              }?> required>
              <span class="hinttext">30 characters maximum</span>
          </div>
          <!-- submit -->
          <input type="submit" value="Add Classification">
          <!-- ACTION - name - value -->
          <input type="hidden" name="action" value="add-classification-submit">

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