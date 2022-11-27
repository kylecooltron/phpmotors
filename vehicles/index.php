<?php
# Vehicles Controller

# Create or access a Session
session_start();

# database connection file
require_once '../library/connections.php';
# main model
require_once '../model/main-model.php';
# shared model
require_once '../model/shared-model.php';
# uploads model
require_once '../model/uploads-model.php';
# form controller module
require_once '../library/forms.php';
# functions library
require_once '../library/functions.php';

# vehicle model
require_once '../model/vehicle-model.php';
// set up basepage
require_once '../library/basepage.php';


function getColorOptions($selectedColor = ""){
  # make a list of colors
  $colors = array(
    "White","Black","Silver","Gold","Red","Purple","Pink","Orange","Yellow","Green","Cyan","Blue",
    "Rust", "Brown",
  );
  # initialize empty string
  $colorOptions = "";
  # for every color, generate HTML option tag
  foreach($colors as $color){
    $colorOptions .= "<option value='$color' ";
    # check for sticky or default selected input
    if($selectedColor == $color){
    $colorOptions .= " selected ";
    }
    $colorOptions .= ">$color</option>";
  }
  # return generated HTML string
  return $colorOptions;
}

function getClassificationsList($classifications, $selectedClassification = ""){
  # create dynamic select box - - - - -
  $classificationList  = '<select name="classificationId" id="classificationId">';
  foreach ($classifications as $classification) {
    $classificationList  .= "<option value='$classification[classificationId]' ";
    # check for sticky or default selected input
    if($classification["classificationId"] == $selectedClassification){
      $classificationList .= " selected ";
    }
    $classificationList  .= ">$classification[classificationName]</option>";
  }
  $classificationList  .= '</select>';
  return $classificationList;
}




function actionAddVehicle()
{
  # form input filter types and names
  $inputs_array = array(
    "invMake" => "string",
    "invModel" => "string",
    "invDescription" => "string",
    "invImage" => "string",
    "invThumbnail" => "string",
    "invPrice" => "float",
    "invColor" => "string",
    "invStock" => "int",
    "classificationId" => "int"
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_INVENTORY, $inputs_array, 'handleInsert');
  # handle the result
  return 
  [
    "success" => [
      "message" => "<p class='message-yes'>Vehicle was added successfully.</p>",
      "sticky inputs" => noSticky($inputs_array),
    ],
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "sticky inputs" => $result["filtered inputs"],
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but adding vehicle failed. Please try again.</p>",
      "sticky inputs" => $result["filtered inputs"],
    ],
  ][
    $result["message"]
  ];
}


function actionAddClassification()
{
  # form input filter types and names
  $inputs_array = array("classificationName" => "string");
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_CLASSIFICATION, $inputs_array, 'handleInsert');

  # if success, reload vehicles controller
  if ($result["message"] == "success"){
    $filtered_name = $result["filtered inputs"]["classificationName"];
    $_SESSION['message'] = "<p class='message-yes'>Succesfully created classification named $filtered_name </p>";
    header('Location: /phpmotors/vehicles/index.php');
    exit;
  }

  # otherwise display a message
  return 
  [
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "sticky inputs" => $result["filtered inputs"],
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but adding classification failed. Please try again.</p>",
      "sticky inputs" => $result["filtered inputs"],
    ],
  ][$result["message"]];
}


function actionUpdateVehicle()
{
  # form input filter types and names
  $inputs_array = array(
    "invId" => "int",
    "invMake" => "string",
    "invModel" => "string",
    "invDescription" => "string",
    "invImage" => "string",
    "invThumbnail" => "string",
    "invPrice" => "float",
    "invColor" => "string",
    "invStock" => "int",
    "classificationId" => "int"
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_INVENTORY, $inputs_array, 'handleUpdate');

  if($result["message"] == "success"){

    # get the sanitized inputs
    $invMake = $result["filtered inputs"]["invMake"];
    $invModel = $result["filtered inputs"]["invModel"];

    $message = "<p class='message-yes'>Congratulations, the $invMake $invModel was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;
  }

  # handle the result
  return 
  [
    "missing info" => [
      "message" => "<p class='message-no'>Please provide valid information for all empty form fields.</p>",
      "sticky inputs" => $result["filtered inputs"],
      "include" => '../view/vehicle-update.php',
    ],
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but updating vehicle failed. Please try again.</p>",
      "sticky inputs" => $result["filtered inputs"],
      "include" => '../view/vehicle-update.php',
    ],
  ][
    $result["message"]
  ];
}


function actionDeleteVehicle()
{
  # form input filter types and names
  $inputs_array = array(
    "invId" => "int",
    "invMake" => "string",
    "invModel" => "string",
  );
  # send data to be validated and inserted into db
  $result = handleFormSubmit(TABLE_INVENTORY, $inputs_array, 'handleDelete');

  if($result["message"] == "success"){
    # get the sanitized inputs
    $invMake = $result["filtered inputs"]["invMake"];
    $invModel = $result["filtered inputs"]["invModel"];
    $_SESSION['message'] = "<p class='message-yes'> $invMake $invModel was successfully deleted.</p>";
    header('location: /phpmotors/vehicles/');
    exit;
  }

  # handle the result
  return 
  [
    "fail" => [
      "message" => "<p class='message-no'>Sorry, but deleting vehicle failed. Please try again.</p>",
      "include" => 'location: /phpmotors/vehicles/',
    ],
  ][
    $result["message"]
  ];
}


# EXTRA CREDIT
# catch and redirect if client is not above level 1
if( !isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] <= 1 ){
    # redirect to home page
    header('Location: /phpmotors/');
}

# handle action
switch ($action) {

  case 'add-classification-page':
    include '../view/add-classification.php';
  break;

  case 'add-vehicle-page':
    # dynamically generate drop down options for form
    $classificationList = getClassificationsList($classifications);
    $colorOptions = getColorOptions();
    include '../view/add-vehicle.php';
  break;

  case 'add-vehicle-submit':
    $result = actionAddVehicle();
    # display message
    $message = $result["message"];
    $sticky = $result["sticky inputs"];
    # get color and classification options with sticky selected
    $colorOptions = getColorOptions($sticky["invColor"]);
    $classificationList = getClassificationsList($classifications, $sticky["classificationId"]);
    include "../view/add-vehicle.php";
  break;

  case 'add-classification-submit':
    $result = actionAddClassification();
    # display message
    $message = $result["message"];
    $sticky = $result["sticky inputs"];
    include "../view/add-classification.php";
  break;

  case  'get-inventory-item':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
  break;

  case 'modify-vehicle-page':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);

    $defaultClassification = NULL;
    $defaultColor = NULL;

    if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
    }else{
      # determine form options to be selected by default
      $defaultClassification = $invInfo['classificationId'];
      $defaultColor = $invInfo['invColor'];
    }
    
    $classificationList = getClassificationsList($classifications, $defaultClassification);
    $colorOptions = getColorOptions($defaultColor);
    include '../view/vehicle-update.php';
    exit;
  break;

  case 'modify-vehicle-submit':
    $result = actionUpdateVehicle();
    # display message
    $message = $result["message"];
    $sticky = $result["sticky inputs"];

    # determine form options to be selected by default
    $defaultValues = [
      "classification" => "",
      "color" => "",
    ];
    
    # if there is a sticky value, use it, otherwise use default
    if(isset($sticky['invClassification'])){
      $defaultValues['classification'] = $sticky['invClassification'];
    }elseif(isset($invInfo['invClassification'])){
      $defaultValues['classification'] = $invInfo['invClassification'];
    }
    if(isset($sticky['invColor'])){
      $defaultValues['color'] = $sticky['invColor'];
    }elseif(isset($invInfo['invColor'])){
      $defaultValues['color'] = $invInfo['invColor'];
    }

    # get color and classification options with sticky selected
    $classificationList = getClassificationsList($classifications, $defaultValues['classification']);
    $colorOptions = getColorOptions($defaultValues['color']);
    
    # if an include path was given, apply it
    if(array_key_exists("include", $result)){
      include $result["include"];
    }
  break;

  case 'delete-vehicle-page':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
    }
    # determine form options to be selected by default
    $defaultValues = [
      "classification" => "",
      "color" => "",
    ];
    if(isset($invInfo['invClassification'])){
      $defaultValues['classification'] = $invInfo['invClassification'];
    }
    if(isset($invInfo['invColor'])){
      $defaultValues['color'] = $invInfo['invColor'];
    }
    $classificationList = getClassificationsList($classifications, $defaultValues['classification']);
    $colorOptions = getColorOptions($defaultValues['color']);
    include '../view/vehicle-delete.php';
    exit;
  break;

  case 'delete-vehicle-submit':
    $result = actionDeleteVehicle();
    # display message
    $message = $result["message"];
    # if an include path was given, apply it
    include $result["include"];
  break;

  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    if(!count($vehicles)){
      $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    include '../view/classification.php';
  break;

  case 'vehicle-details-page':
    $inventoryId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $details = getInvItemInfo($inventoryId);
    $thumbnails = getVehicleThumbnailImages($inventoryId);
    if(!count($details)){
      $message = "<p class='notice'>Sorry, error.</p>";
    }else{
      $vehicleThumbnailsDisplay = "";
      if(count($thumbnails)){
        $vehicleThumbnailsDisplay = buildVehicleThumbnailDisplay($thumbnails);
      }
      $vehicleDetailsDisplay = buildVehicleDetailDisplay(
        $details,
        $vehicleThumbnailsDisplay
      );
      
      include '../view/vehicle-detail.php';
    }
  break;

  default:
  $classificationList = buildClassificationList($classifications);
  include '../view/vehicle-man.php';
}
