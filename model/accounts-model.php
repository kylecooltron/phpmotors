<?php
/**
* ACCOUNTS MODEL
* contains functions specific to accounts for interfacing with model
*
 I practiced the programming concept of reusability and made model/controller functions
 that work for general form validation / insert queries
*@see 'model/shared-model.php' for functions generic to all models
*@see 'library/forms.php' for functions generic to all forms
*/



// check existing email
function checkExistingEmail($clientEmail) {
  $db =  phpmotorsConnect();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if(empty($matchEmail)){
   return 0;
  } else {
   return 1;
  }
}



// Get client data based on an email address
function getClientByEmail($clientEmail){
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}


function handleLogin($table, $field_names, $values){
  /**
  * Takes username and password and verifies it
  * @return integer success or fail (0, 1)
  */

  $loginMap = array_combine(array_keys($field_names), $values);

  # query for the client data associated with this email
  $clientData = getClientByEmail($loginMap["clientEmail"]);

  # make sure the returned array is not empty
  if($clientData){
    # check if the password matches
    $hashCheck = password_verify($loginMap["clientPassword"], $clientData['clientPassword']);
    # if the password is correct
    if($hashCheck) {
     
      # set session variable
      $_SESSION['loggedin'] = TRUE;

      # make sure we unset the password
      unset($clientData["clientPassword"]);

      # store client data in session
      $_SESSION['clientData'] = $clientData;
      
      # return success
      return 1;
    }
  }

  // otherwise return fail
  return 0;
}


// Get client data based on id
function getClientByID($clientId){
  $db = phpmotorsConnect();
  $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}


