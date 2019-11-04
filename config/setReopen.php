<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

// include database connection
require_once 'dbh.php';

// Function for escaping string characters
function sanitize($conn, $var) {
 return $conn->real_escape_string($var);
}

// Declare variables and sanitize data
$reference = $_POST["reference"];

sanitize($conn, $reference);

// Search for a row that has a matching client reference
$query = "SELECT * FROM status WHERE reference = ?";

/*
Make a positional prepared statement
1. Initialize statement
2. Prepare and check for errors
3. Bind the values and execute
*/

// 1.
$stmt = $conn->stmt_init();

// 2.
if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

// 3.
$stmt->bind_param("s", $reference);
$stmt->execute();


/*
Make sure there are not more than one record with the same client reference
1. get the result from the prepared statement
2. check if there are more than 1 record in the database, as if the ticket is going to be reopened it should already exist
3. Make a query to update the status where there is a match with the client reference
4. Initialise the statement
5. Prepare and check for errors
6. Bind and execute
*/

// 1.
$result = $stmt->get_result();

// 2.
if ($result > 1) {
 header("Location: ../index.php");
 exit();
}

// 3.
$query = "UPDATE status SET status = 'Pending' WHERE reference = ?";

//4.
$stmt = $conn->stmt_init();

//5.
if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

//6.
$stmt->bind_param("s", $reference);
$stmt->execute();

if ($stmt->execute()) {
 header("Location:../index.php?ng=ticket&id=$reference");
 exit();

} else {
 header("Location:../index.php");
 exit();

}



} else {

header("Location:../index.php");
exit();

}


?>
