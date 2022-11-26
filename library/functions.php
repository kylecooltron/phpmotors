<?php
/*
* General functions library
*/

# Validate email
function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}


# check password against regex
function checkPassword($clientPassword){
 $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
 return preg_match($pattern, $clientPassword);
}


# generate navigation html string
function createNavList($classifications){
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']);
    $navList .= "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  # return html string
  return $navList;
}

function noSticky($inputs_array = []){
  /*
  * Creates an array with correct input names as keys and null values
  * to prevent errors from other functions looking for sticky values
  */
  # default is empty
  $sticky_array_names = [];
  # if an array of input names was passed in
  foreach($inputs_array as $input_key => $input_value){
    if($input_value != "password"){
      # create the key with null value
      $sticky_array_names[$input_key] = "";
    }
  }
  return $sticky_array_names;
}


// Build the classifications select list 
function buildClassificationList($classifications){ 
  $classificationList = '<select name="classificationId" id="classificationList">'; 
  $classificationList .= "<option>Choose a Classification</option>"; 
  foreach ($classifications as $classification) { 
   $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
  } 
  $classificationList .= '</select>'; 
  return $classificationList; 
}


// Build the vehicles display html
function buildVehiclesDisplay($vehicles){
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
   $dv .= '<li>';
   $dv .= "<a href='/phpmotors/vehicles/?action=vehicle-details-page&invId="  . urlencode($vehicle['invId']) . "'>";
   $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
   $dv .= "</a>";
   $dv .= '<hr>';
   $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
   $price = number_format($vehicle['invPrice'], 2, '.', ',');
   $dv .= "<span class='currency-format'>$price</span>";
   $dv .= "<a href='/phpmotors/vehicles/?action=vehicle-details-page&invId="  . urlencode($vehicle['invId']) . "'>";
   $dv .= "$vehicle[invMake] $vehicle[invModel] details page </a>";
   $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}


// Build the vehicles display html
function buildVehicleDetailDisplay($vehicleDetails){
  $dv = '<div id="vehicle-detail-display">';
  $dv .= "<img src='$vehicleDetails[invThumbnail]' alt='Image of $vehicleDetails[invMake] $vehicleDetails[invModel] on phpmotors.com'>";
  $dv .= '<hr>';
  $dv .= "<h2>$vehicleDetails[invMake] $vehicleDetails[invModel]</h2>";
  $price = number_format($vehicleDetails['invPrice'], 2, '.', ',');
  $dv .= "<span class='currency-format'>$price</span>";
  $dv .= "<p>$vehicleDetails[invDescription]</p>";
  $dv .= "<h2>VEHICLE SUMMARAY";
  foreach([
  'invId',
  'invImage',
  'invThumbnail',
  'classificationId'
  ] as $unset_value){
    unset($vehicleDetails[$unset_value]);
  }
  $dv .= "<div class='vehicle-summary'><table class='vd-summary'>";
  foreach($vehicleDetails as $detail => $value){
    $detail_formatted = preg_replace('/^inv/', '', $detail);
    $dv .= "<tr><td class='td-label'>$detail_formatted:</td><td class='td-value'>$value</td></tr>";
  }
  $dv .= '</table></div></div>';
  return $dv;
}


//**** functions for uploads and image management  */////


function makeThumnailName(){
  
}