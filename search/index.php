<?php
/**
* Search controller
*/

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicle-model.php';
require_once '../model/search-model.php';
require_once '../library/functions.php';
# shared model
require_once '../model/shared-model.php';
# set up basepage
require_once '../library/basepage.php';


switch ($action) {

  case 'vehicle-search-page':
    include '../view/vehicle-search.php';
  break;

  case 'vehicle-search-submit':
    $searchText = filter_input(INPUT_GET, 'searchText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $searchData = search_vehicles($searchText);
    $searchResults = buildSearchResults($searchData, $searchText);
    include '../view/vehicle-search.php';
  break;
  
  default:
      include '../view/home.php';
      exit;
  break;

}

