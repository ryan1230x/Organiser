<?php


if($_SERVER["REQUEST_METHOD"] === "POST") {
/*
// Include database connection
require_once 'dbh.php';

// Declare variables

$username = $conn->real_escape_string(trim($_POST["uname"]));
$password = $conn->real_escape_string(trim($_POST["password"]));

// Check there is not already an existing user with the same username

$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->stmt_init();

if(!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

$stmt->bind_param("s", $username);
$stmt->execute();

$stmt->store_result();

$result = $stmt->num_rows;

if($result > 0 ) {

 header("location: ../index.php");
 exit();
}

// insert the user input into database to make a new user
$query = "INSERT INTO users (username, password) VALUES(?, ?)";

$stmt = $conn->stmt_init();

if(!$stmt->prepare($query)) {

 header("Location: ../index.php");
 exit();
}

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt->bind_param("ss", $username, $password_hashed);
$stmt->execute();

header("location: ../login.php?insert=success");
exit();


*/
} else { // end of $_SERVER["REQUEST_METHOD"]

header("Location:../login.php");
exit();

}
/*
echo <<<_e
<form action="signin.php" method="POST">
 <input type="text" name="uname" placeholder="Username"/>
 <input type="text" name="password" placeholder="password"/>
 <input type="submit" value="submit"/>
</form>

_e;
*/

// 'REMOTE_ADDR'
