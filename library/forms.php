<?php
/**
* FORMS
* Contains generic controller functions for form validation and filtering
*/


function get_associated_inputs($input_array, $filtered_input){
  /**
  * Zips filtered inputs into key value pairs to return
  * Can be used by controller for "sticky" form inputs or for post-processing
  * @return array
  */

  # write sticky inputs for each valid input
  $associated_inputs = array();
  $idx = 0;
  foreach ($input_array as $name => $filter) {
    # make sure sticky input is not a password
    if($filter != "password" && !empty($filtered_input[$idx])){
      $associated_inputs[$name] = $filtered_input[$idx];
    }
    $idx ++;
  }
  # return array of sticky input names => values
  return $associated_inputs;
}


function handleFormSubmit($table, $input_array, $callback_query){
  /**
  * Filters and validates form data then calls insert query
  * @return string  message ex: "success", "fail", "missing info"
  */

  # initialize array
  $filtered_input = array();
  $existing_flag = false;
  # fill array with filtered sanitized input
  foreach($input_array as $name => $filter) {

    # add special fractions flag for floats
    if($filter == "float"){
      # filter and trim input
      $input = trim(filter_input(
        INPUT_POST,
        $name,
        FILTER_LOOKUP[$filter],
        FILTER_FLAG_ALLOW_FRACTION,
      ));
    }else{
      # filter and trim input
      $input = trim(filter_input(INPUT_POST, $name, FILTER_LOOKUP[$filter]));
    }

    # perform special validations
    if($filter == "email"){
      $input = checkEmail($input); 
      if(checkExistingEmail($input)){
        $existing_flag = true;
      }
    }

    if($filter == "password"){
      
      # if password is invalid
      if (empty(checkPassword($input))){
        # delete it
        $input = NULL; 
      }else{
        if($callback_query != "handleLogin"){
          # otherwise hash it (no need to keep variable containing unhashed password)
          $input = password_hash($input, PASSWORD_DEFAULT);
        }
      }
    }
    # push filtered input to array
    array_push($filtered_input, $input);
  }

  # perform query or return message - - - - - - - - -

  if($existing_flag && $callback_query == "handleInsert"){
    return array(
      "message" => "already exists",
      "filtered inputs" => get_associated_inputs($input_array, $filtered_input)
    );
  }

  # ensure all form info was filled out
  foreach ($filtered_input as $input){
      if(empty($input))
      { 
        # return message
        return array(
          "message" => "missing info",
          "filtered inputs" => get_associated_inputs($input_array, $filtered_input)
        );
      }
  }

  # Send data to database and return result depending on affected rows
  return [
    1 => array(
      "message" => "success",
      "filtered inputs" => get_associated_inputs($input_array, $filtered_input),
    ),
    0 => array(
      "message" => "fail",
      "filtered inputs" => get_associated_inputs($input_array, $filtered_input)
    )
  ][
    $callback_query($table, $input_array, $filtered_input)
  ];
}
