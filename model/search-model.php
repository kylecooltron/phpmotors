<?php
/**
* SEARCH MODEL
* contains functions specific to vehicles for interfacing with model
*
* 
*@see 'model/shared-model.php' for functions generic to all models
*@see 'library/forms.php' for functions generic to all forms
*/


function search_vehicles($searchText){
  /**
   * Query to find inventory items that contain a given string in certain columns.
   * Returns: An array of inventory info, and image info.
   */
  $newText = "%".$searchText."%";
  $db = phpmotorsConnect();
  $sql = 'SELECT inventory.*, images.imgPath, images.imgName FROM inventory
          JOIN images ON images.invId = inventory.invId
          WHERE 
          (invMake LIKE :searchText
          OR invModel LIKE :searchText
          OR invColor LIKE :searchText)
          AND images.imgPath LIKE "%-tn.jpg" ';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':searchText', $newText, PDO::PARAM_STR);
  $stmt->execute();
  $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}