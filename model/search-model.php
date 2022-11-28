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
  $newText = "%".$searchText."%";
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory
          WHERE 
          invMake LIKE :searchText
          OR invModel LIKE :searchText
          OR invColor LIKE :searchText';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':searchText', $newText, PDO::PARAM_STR);
  $stmt->execute();
  $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}