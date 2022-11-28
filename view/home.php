<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Motors</title>
  <meta name="author" content="Kyle Coulon" />
  <meta name="description" content="PHP Motors student website" />
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aldrich&display=swap" rel="stylesheet">
  <!-- style sheets -->
  <link rel="stylesheet" href="/phpmotors/css/small.css" />
  <link rel="stylesheet" href="/phpmotors/css/medium.css" />
  <link rel="stylesheet" href="/phpmotors/css/large.css" />
</head>

<body>
  <div id="wrapper">
    <!-- header -->
    <header id="page_header">
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
    </header>
    <!-- navigation -->
    <nav>
      <?php
      echo $navList;
      ?>
    </nav>
    <!-- main content -->
    <main>
      <h1>Welcome to PHP Motors!</h1>

      <section>
        <div class="vehicle-display-box">
          <img src="images/vehicles/1982-dmc-delorean.jpg" alt="Delorean cartoon render">
          <!-- buy box -->
          <div>
            <h2>DMC Delorean</h2>
            <ul>
              <li>3 cup holders</li>
              <li>Superman doors</li>
              <li>Fuzzy dice!</li>
            </ul>
            <button>Own Today</button>
          </div>
        </div>
        <button id="own-today-btn-mobile">Own Today</button>
        <div class="vehicle-details-grid">
          <div class="vehicle-reviews-box">
            <h2>DMC Delorean Reviews</h2>
            <ul>
              <li>"So fast its almost like traveling in time." (4/5)</li>
              <li>"Coolest ride on the road." (4/5)</li>
              <li>"I'm feeling McFly!" (5/5)</li>
              <li>"The most futuristic ride of our day." (4.5/5)</li>
              <li>"80's livin and I love it!" (5/5)</li>
            </ul>
          </div>
          <div class="vehicle-upgrades-box">
            <h2>Delorean Upgrades</h2>
            <div class="vehicle-upgrades-grid">
              <div>
                <div class="upgrade-img-box">
                  <img src="images/upgrades/flux-cap.png" alt="flux capacitor">
                </div>
                <a href="#">Flux Capacitor</a>
              </div>
              <div>
                <div class="upgrade-img-box">
                  <img src="images/upgrades/flame.jpg" alt="flame decals">
                </div>
                <a href="#">Flame Decals</a>
              </div>
              <div>
                <div class="upgrade-img-box">
                  <img src="images/upgrades/bumper_sticker.jpg" alt="bumper stickers">
                </div>
                <a href="#">Bumper Stickers</a>
              </div>
              <div>
                <div class="upgrade-img-box">
                  <img src="images/upgrades/hub-cap.jpg" alt="hub caps">
                </div>
                <a href="#">Hub Caps</a>
              </div>
            </div>
          </div>
        </div>
      </section>
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