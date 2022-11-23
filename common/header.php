<!-- header -->
<a href="/" title="Home">
  <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo">
</a>
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
