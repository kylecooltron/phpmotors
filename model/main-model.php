<?php

function getClassifications()
{
  //get connection
  $db = phpmotorsConnect();
  // write SQL
  $sql = "SELECT classificationName, classificationId FROM carclassification ORDER BY classificationName ASC";
  // prepare and execute statement
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $classifications = $stmt->fetchAll();
  $stmt->closeCursor();
  // return gathered array
  return $classifications;
}
