<?php
/**
* VEHICLE MODEL
* contains functions specific to vehicles for interfacing with model
*
* 

 Note for week 5:

 I practiced the programming concept of reusability and made model/controller functions
 that work for general form validation / insert queries

*@see 'model/shared-model.php' for functions generic to all models
*@see 'library/forms.php' for functions generic to all forms
*/



// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

// Get vehicle information by invId
function getInvItemInfo($invId){
  $db = phpmotorsConnect();
  $sql = 'SELECT inventory.*, images.imgPath
          FROM inventory
          JOIN images ON images.invId = inventory.invId
          WHERE inventory.invId = :invId
          -- AND images.imgPrimary = 1
          AND images.imgPath NOT LIKE "%-tn.jpg"';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}
 

// Get vehicle information by classification name
function getVehiclesByClassification($classificationName){
  $db = phpmotorsConnect();
  $sql = 'SELECT invMake, invModel, invPrice, inventory.invId, images.imgPath 
          FROM inventory 
          JOIN images ON images.invId = inventory.invId
          WHERE classificationId IN (
            SELECT classificationId FROM carclassification 
            WHERE classificationName = :classificationName
          )
          -- AND images.imgPrimary = 1
          AND images.imgPath LIKE "%-tn.jpg"';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}





// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

