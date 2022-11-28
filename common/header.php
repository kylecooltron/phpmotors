<!-- header -->
<a href="/phpmotors/index.php" title="Home">
  <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
</a>
<div class="acct-bar-container">
<div class="acct-welcome-box">
<?php 
if(isset($_SESSION['loggedin'])){
  # render welcome message
  echo "<a class='welcome-msg' href='/phpmotors/accounts/'>";
  echo "Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a>";
  # log Out button
  echo "<a class='account-link' href='/phpmotors/accounts/index.php?action=logout' title='Log Out'>";
  echo "Log Out </a>";
}else{
  # empty element for grid styling
  echo "<div></div>";
  # My Account button
  echo "<a class='account-link' href='/phpmotors/accounts/index.php?action=login-page' title='My Account'>";
  echo "My Account </a>";
}

?>
</div>
<a href="" class="search-link">
  <img src="/phpmotors/images/site/search.png" alt="search icon">
</a>
</div>
