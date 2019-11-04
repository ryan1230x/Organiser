<?php
# Connect to the db
$conn = new mysqli('localhost', 'dt', 'dt', 'dt');
if ($conn->connect_error) {
  die("connection error" . $conn->connect_error);
}
