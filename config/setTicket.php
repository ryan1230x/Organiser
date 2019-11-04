<?php

# Make sure there was a post Request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  # include the db connection
  require_once 'dbh.php';

  # filter function for strings
  function filterString($var) {
    $var = filter_var(trim($var, FILTER_SANITIZE_STRING));
    return $var;
  }

  #filter function for integers
  function filterInt($var) {
    $var = filter_var(trim($var, FILTER_VALIDATE_INT));
    return $var;
  }

  # Get the input from the file
  $client_reference  = $_POST["cliRef"];
  $client_name       = $_POST["name"];
  $date              = $_POST["date"];
  $client_address    = $_POST["address"];
  $network           = $_POST["network"];
  $requested_service = $_POST["requested_service"];
  $portability       = $_POST["portability"];
  $client_landline   = $_POST["landline"];
  $client_mobile     = $_POST["mobile_number"];
  $client_package    = $_POST["client_package"];
  $comment_checkbox  = $_POST["comment_checkbox"];
  $first_comment     = $_POST["init_comment"];
  $status            = "Pending";

  // Check to see if any of the fields are empty
 if (empty($client_reference) || empty($cient_name) || empty($date)) {
   header("Location: ../index.php?ng=create&error=emptyfields");
   exit();

  } elseif (empty($client_address) || empty($network) || empty($requested_service)) {
    header("Location: ../index.php?ng=create&error=emptyfields");
    exit();

  } elseif (empty($portability) || empty($client_landline)) {
    header("Location:../index.php?ng=create&error=emptyfields");
    exit();
  }

  /*===========================================================
  Check to see if the client reference the user put is not already
  in the db.

  Steps for this section
  1# Query the db
  2# Make prepared statement
  3# Prepare the statement
  4# Bind values to statement
  5# Execute
  6# Store the results
  7# Check if there is a row with the same data.
  ============================================================*/

  // Step 1
  $query = "SELECT * FROM `client_info` WHERE `reference`=?";
  // Step 2
  $stmt = $conn->stmt_init();
  // Step3
  if (!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=create&creation=failed");
    exit();
  }
  // Step 4
  $stmt->bind_param("s", $client_reference);
  // Step 5
  $stmt->execute();
  // Step 6
  $stmt->store_result();
  $result = $stmt->num_rows;
  // Step 7
  if ($result > 0) {
    header("Location: ../index.php?ng=create&creation=unset");
    exit();
  }

/*=========================================================
# If there are no empty fields execute the following code

  1. Make an INSERT INTO query to the db
  2. Use prepared statement
  3. Bind and Execute the prepared statement
  4. Send the user to index.php page
============================================================*/

  # insert data into client_info table

  // Step 1 + 2
  $query1 = "INSERT INTO `client_info`(`reference`, `name`, `landline`, `contact_number`) VALUES(?, ?, ?, ?)";
  $stmt = $conn->stmt_init();
  if(!$stmt->prepare($query1)) {
    header("Location: ../index.php?ng=create&creation=failed");
    exit();
  }

  // Step 3.
  $stmt->bind_param("ssss", $client_reference, $client_name, $client_landline, $client_mobile);
  $stmt->execute();

  /*--------------------------------------------*/
  # insert data into client_address table

  // Step 1 + 2
  $query = "INSERT INTO client_address(reference, address) VALUES(?, ?)";
  $stmt = $conn->stmt_init();
  if(!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=create&creation=failed");
    exit();
  }

  // Step 3.
  $stmt->bind_param("ss", $client_reference, $client_address);
  $stmt->execute();

  /*--------------------------------------------*/
  # insert data into the client_service table

  // Step 1 + 2
  $query = "INSERT INTO client_service(reference, network, service, portability, package, requested_date) VALUES(?, ?, ?, ?, ?, ?)";
  $stmt = $conn->stmt_init();
  if(!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=create&creation=failed");
    exit();
  }

  // Step 3.
  $stmt->bind_param("ssssss", $client_reference, $network, $requested_service, $portability, $client_package, $date);
  $stmt->execute();
  /*---------------------------------------------*/
  # insert data in the status table

  // Step 1 + 2
  $query = "INSERT INTO status(reference, status) VALUES(?, ?)";
  $stmt = $conn->stmt_init();
  if(!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=create&creation=failed");
    exit();
  }

  // Step 3.
  $stmt->bind_param("ss", $client_reference, $status);
  $stmt->execute();

  /*=============================================
  If the checkbox has a value of yes, add the input
  and insert into the comments table.
  1. Make an INSERT INTO query to the db
  2. Use prepared statement
  3. Bind and Execute the prepared statement
  ==============================================*/

  if ($comment_checkbox === "yes") {
    // Step 1
    $query = "INSERT INTO comments(comment, reference) VALUES(?, ?)";
    $stmt = $conn->stmt_init();

    // Step 2
    if (!$stmt->prepare($query)) {
      header("Location: ../index.php?ng=create&creation=failed");
      exit();
    }

    // Step 3
    $stmt->bind_param("ss", $first_comment, $client_reference);
    $stmt->execute();
  }

  /*-------------------------------------------------------------------*/
  // Step 4.
  header("Location: ../index.php?ng=create&creation=success");
  exit();


} else {
  # If there has not been a POST method redirect user to index.php
  header("Location: ../index.php?ng=create");
  exit();
}
