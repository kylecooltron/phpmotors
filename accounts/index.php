<?php
# Accounts Controller

# Create or access a Session
session_start();

# database connection file
require_once '../library/connections.php';
# main model
require_once '../model/main-model.php';
# shared model
require_once '../model/shared-model.php';
# form controller module
require_once '../library/forms.php';
# functions library
require_once '../library/functions.php';

# accounts model
require_once '../model/accounts-model.php';
// set up basepage
require_once '../library/basepage.php';


function actionLogin()
{
  # form input filter types and names
  $inputs_array = array(
    "clientEmail" => "email",
    "clientPassword" => "password",
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_CLIENTS, $inputs_array, 'handleLogin');

  # handle the result
  return
  [
    "success" => [
      "message" => "<p class='message-yes'>'Login Success.'</p>",
      "include" => '../view/admin.php',
      "sticky inputs" => noSticky(),
    ],
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "include" => '../view/login.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, login failed. Please try again.</p>",
      "include" => '../view/login.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
  ][
    $result["message"]
  ];
}


function actionRegister()
{
  # form input filter types and names
  $inputs_array = array(
    "clientFirstname" => "string",
    "clientLastname" => "string",
    "clientEmail" => "email",
    "clientPassword" => "password",
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_CLIENTS, $inputs_array, 'handleInsert');
  
  # set default value to blank
  $firstNameValue = '';
  
  # if registration was successful
  if($result["message"] == "success"){
    # set first name cookie
    if(array_key_exists("clientFirstname", $result["filtered inputs"])){
      $firstNameValue = $result["filtered inputs"]["clientFirstname"];
      // setcookie('firstname', $firstNameValue, strtotime('+1 year'), '/');
    }

    # redirect to login page
    header('Location: /phpmotors/accounts/?action=login-page');
  }
  
  # handle the result
  return
  [
    "success" => [
      "message" => "<p class='message-yes'>Thanks for registering {$firstNameValue}. Please use your email and password to login.</p>",
    ],
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "include" => '../view/registration.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
    "already exists" => [
      "message" => "<p class='message-no'>Email already registered. Do you want to login?</p>",
      "include" => '../view/login.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but the registration failed. Please try again.</p>",
      "include" => '../view/registration.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
  ][
    $result["message"]
  ];
}

function actionUpdateInfo()
{
  # form input filter types and names
  $inputs_array = array(
    "clientId" => "int",
    "clientFirstname" => "string",
    "clientLastname" => "string",
    "clientEmail" => "email",
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_CLIENTS, $inputs_array, 'handleUpdate');
  
  # if registration was successful
  if($result["message"] == "success"){

    # query for the updated client data associated with this id
    $clientData = getClientByID($result["filtered inputs"]["clientId"]);
    if($clientData){
      # store client data in session
      $_SESSION['clientData'] = $clientData;
    }

    # get the sanitized inputs
    $clientFirstname = $result["filtered inputs"]["clientFirstname"];

    $message = "<p class='message-yes'>Congratulations $clientFirstname, your account information was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/accounts/');
    exit;
  }

  # handle the result
  return
  [
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "include" => '../view/account-update.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
    "already exists" => [
      "message" => "<p class='message-no'>Email already registered.</p>",
      "include" => '../view/account-update.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but the update failed. Please try again.</p>",
      "include" => '../view/account-update.php',
      "sticky inputs" => $result["filtered inputs"],
    ],
  ][
    $result["message"]
  ];
}


function actionUpdatePassword()
{
  # form input filter types and names
  $inputs_array = array(
    "clientId" => "int",
    "clientPassword" => "password",
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_CLIENTS, $inputs_array, 'handleUpdate');
  
  # if registration was successful
  if($result["message"] == "success"){
    $message = "<p class='message-yes'>Password successfully changed.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/accounts/');
    exit;
  }

  # handle the result
  return
  [
    "missing info" => [
      "message" => "<p class='message-no'>Password invalid.</p>",
      "include" => '../view/account-update.php',
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but the change failed. Please try again.</p>",
      "include" => '../view/account-update.php',
    ],
  ][
    $result["message"]
  ];
}

# handle action
switch ($action) {
  case 'login-page':
    include '../view/login.php';
    break;
  case 'login':
    $result = actionLogin();
    $_SESSION['message'] = $result["message"];
    $sticky = $result["sticky inputs"];
    include $result["include"];
    break;
  case 'logout':
    $_SESSION['message'] = $result["message"];
    session_unset();
    session_destroy();
    header('Location: /phpmotors/');
    break; 
  case 'registration-page':
    include '../view/registration.php';
    break;
  case 'register':
    $result = actionRegister();
    $_SESSION['message'] = $result["message"];
    $sticky = $result["sticky inputs"];
    include $result["include"];
    break;
  case 'update-account-page':
    $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
    include '../view/account-update.php';
  break;
  case 'update-account-submit':
    $result = actionUpdateInfo();
    $account_message = $result["message"];
    $sticky = $result["sticky inputs"];
    include $result["include"];
  break;
  case 'update-password-submit':
    $result = actionUpdatePassword();
    $password_message = $result["message"];
    include $result["include"];
  break;

  default:
  include '../view/admin.php';
}
