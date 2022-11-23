<?php
# Main controller

# Create or access a Session
session_start();

# database connection file
require_once 'library/connections.php';
# main model
require_once 'model/main-model.php';
# functions library
require_once 'library/functions.php';

# set up basepage
require_once 'library/basepage.php';

 
switch ($action) {
  case 'template':
    include 'view/template.php';
    break;
  case 'vehicle-management':
    include 'view/vehicle-man.php';
    break;
  default:
    include 'view/home.php';
}
