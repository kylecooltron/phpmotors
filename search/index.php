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
    $searchText = filter_input(INPUT_GET, 'searchText', FILTER_SANITIZE_STRING);
    $searchPage = filter_input(INPUT_GET, 'searchPage', FILTER_SANITIZE_NUMBER_INT);

    # if filtered text is not empty
    if($searchText != ""){
      # perform search
      $searchData = search_vehicles($searchText);
      # if any results are found
      if(count($searchData) > 0){
        # build search results for a given page number
        $searchResults = buildSearchResults($searchData, $searchText, $searchPage); 
        # build pagination
        $pagination = buildSearchPagination($searchData, $searchText, $searchPage);
      }
    }
    # report any problems
    if(!isset($searchResults)){
      $message = "No results found.";
    }
    if(!isset($searchData)){
      $message = "Please enter a valid search string.";
    }
    include '../view/vehicle-search.php';
  break;
  
  default:
      include '../view/home.php';
      exit;
  break;

}

