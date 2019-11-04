<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

// include database connection
require_once 'dbh.php';

// declare variable + sanitize to prevent any SQL injections
$reference = $conn->real_escape_string(trim($_POST["reference"]));
$status = $conn->real_escape_string(trim($_POST["status"]));
$network = $conn->real_escape_string(trim($_POST["network"]));
$package = $conn->real_escape_string(trim($_POST["package"]));
$portability = $conn->real_escape_string(trim($_POST["portability"]));


// Change the network
$query = "UPDATE client_service SET network=? WHERE reference=?";
$stmt = $conn->stmt_init();

if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

$stmt->bind_param("ss", $network, $reference);
$stmt->execute();


// Update the package
$query = "UPDATE client_service SET package=? WHERE reference=?";
$stmt = $conn->stmt_init();

if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

$stmt->bind_param("ss", $package, $reference);
$stmt->execute();

// Update portability
$query = "UPDATE client_service SET portability=? WHERE reference=?";
$stmt = $conn->stmt_init();

if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

$stmt->bind_param("ss", $portability, $reference);
$stmt->execute();


// Make query to update status in the database
$query = "UPDATE status SET status=? WHERE reference=?";
$stmt = $conn->stmt_init();

if (!$stmt->prepare($query)) {
 header("Location: ../index.php");
 exit();
}

$stmt->bind_param("ss", $status, $reference);
$stmt->execute();

header("Location: ../index.php?ng=ticket&id=$reference");
exit();



} else { // End of request server
 header("Location:../index.php?ng=home");
 exit();

}
