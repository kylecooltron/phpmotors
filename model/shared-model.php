<?php
/**
* SHARED MODEL
* Contains functions that are generic to all models
*/

function handleInsert($table, $field_names, $values){
  /**
  * Takes any table name, field names, and values and inserts them
  * @return integer number of rows succesfully affected
  */

  # get connection
  $db = phpmotorsConnect();

  # construct field and values strings
  $fields = implode(", ", array_keys($field_names));
  $stmt_values_string = "";
  foreach ($values as $value){
    $stmt_values_string .= "'{$value}',";
  }
  # remove last comma
  $stmt_values_string = substr($stmt_values_string, 0, -1);

  // prepare and execute statement
  $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$stmt_values_string})";
  $stmt = $db->prepare($sql);
  $stmt->execute(); 

  // get rows changed
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  // return rows affected
  return $rowsChanged;
}

function handleUpdate($table, $field_names, $values){
  /**
  * First element in field_names and values act as the key index for updating
  * Takes any table name, field names, and values and update them
  * @return integer number of rows succesfully affected
  */

  # get connection
  $db = phpmotorsConnect();

  # get the key index for updating
  $key_index_field = array_key_first($field_names);
  array_shift($field_names);
  $key_index_value = array_shift($values);

  $stmt_key_values_string = "";
  foreach (array_combine(
      array_keys($field_names), $values) 
      as $field => $value){
    $stmt_key_values_string .= "{$field}='{$value}',";
  }
  # remove last comma
  $stmt_key_values_string = substr($stmt_key_values_string, 0, -1);

  // prepare and execute statement
  $sql = "UPDATE {$table} SET {$stmt_key_values_string} WHERE {$key_index_field}={$key_index_value}";
  
  $stmt = $db->prepare($sql);
  $stmt->execute();

  // get rows changed
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  // return rows affected
  return $rowsChanged;
}


function handleDelete($table, $field_names, $values){
  /**
  * First element in field_names and values act as the key index for deleting
  * @return integer
  */

  # get connection
  $db = phpmotorsConnect();

  # get the key index for updating
  $key_index_field = array_key_first($field_names);
  array_shift($field_names);
  $key_index_value = array_shift($values);

  // prepare and execute statement
  $sql = "DELETE FROM {$table} WHERE {$key_index_field}={$key_index_value}";
  $stmt = $db->prepare($sql);
  $stmt->execute();

  // get rows changed
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();

  // return rows affected
  return $rowsChanged;
}





