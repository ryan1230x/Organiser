<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  require_once 'dbh.php';

  $comment = $_POST["comment"];
  $client_reference = $_POST["reference"];
  //
  $query = "INSERT INTO comments(comment, reference) VALUES(?, ?)";
  $stmt = $conn->stmt_init();
  if (!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=ticket&comment=unset");
    exit();
  }
  $stmt->bind_param("ss", $comment, $client_reference);
  $stmt->execute();
  header("Location: ../index.php?ng=ticket&id=$client_reference");
  exit();

} else {
  header("Location: ../index.php");
  exit();
}
