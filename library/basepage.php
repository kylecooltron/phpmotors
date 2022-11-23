<?php
/**
* BASEPAGE
* calls generic model functions and defines variables that are used
* by every typical page on the php motors site
*/

// get classifications
$classifications = getClassifications();
# create dynamic navigation - - - - -
$navList = createNavList($classifications);

// get first name cookie
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

# use action from post or get
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}