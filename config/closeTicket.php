<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  # include db connection
  require_once 'dbh.php';

  # declare variables
  $client_reference = $_POST["reference"];
  $comment = $_POST["comment"];

  # Insert comment into comments tables
  $query = "INSERT INTO comments(comment, reference) VALUES (?,?)";
  $stmt = $conn->stmt_init();
  if (!$stmt->prepare($query)) {
    header("Location: ../index.php?ng=ticket&error=comment");
    exit();
  }
  $stmt->bind_param("ss", $comment, $client_reference);
  $stmt->execute();

  # query the db again to change the status to closed.
  $query = "UPDATE status SET status = 'closed' WHERE reference='$client_reference'";
  $result = $conn->query($query);

  header("Location: ../index.php?ng=home");
  exit();

} else {
  header("Location: ../index.php?ng=create?id=$client_reference");
  exit();
}
