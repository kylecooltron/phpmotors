<?php
/**
* CONNECTIONS LIBRARY
* contains functions for managing database connection
* defines table name constants
*/

# Table name CONSTANTS
define('TABLE_CLIENTS',              "clients");
define('TABLE_CLASSIFICATION',   "carclassification");
define('TABLE_INVENTORY',            "inventory");

# filter CONSTANTS
define('FILTER_LOOKUP', array(
    "string" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "email" => FILTER_SANITIZE_EMAIL,
    "password" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    "float" => FILTER_SANITIZE_NUMBER_FLOAT,
    "int" => FILTER_SANITIZE_NUMBER_INT,
  )
);

# connect to phpmotors database
function phpmotorsConnect()
{
  $server = 'localhost';
  $dbname = 'phpmotors';
  $username = 'iClient';
  $password = 'V9-q1SQrvwP]0bi-';
  $dsn = "mysql:host=$server;dbname=$dbname";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  # Create connection object and assign it to variable
  try {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
  } catch (PDOException $e) {
    header('Location: /phpmotors/view/500.php');
    exit;
  }
}
