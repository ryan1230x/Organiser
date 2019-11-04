<?php
// Make sure there was a get request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

# include the db connection
require_once 'dbh.php';

# Declare variable and filter
$search = $conn->real_escape_string(trim($_POST["s"]));

# Query the db
$query = "SELECT
name,
client_info.reference,
landline,
address,
network,
status
FROM client_info
JOIN client_address USING(reference)
JOIN client_service USING(reference)
JOIN status USING(reference)
WHERE address LIKE '%$search%'
AND status='pending' OR status='Router Installation'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo '
<div id="table-container">
  <blockquote>
    <h4>Pending Installations <span class="badge">'.$result->num_rows.' Results</span></h4>
  </blockquote>
  <table class="centered striped">
    <thead>
      <tr class="thead">
        <th>Name</th>
        <th>Address</th>
        <th>Network</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>';
while ($row = $result->fetch_assoc()) {
  echo '
  <tr>
    <td>'.$row["reference"].' - '.$row["name"].'</td>
    <td>'.$row["address"].'</td>
    <td>'.$row["network"].'</td>
    <td><strong>'.$row["status"].'</strong></td>
    <td>
      <a class="btn secondary-btn hoverable waves-effect" href="?ng=ticket&id='.$row["reference"].'" style="color:#fff;">
        open
      </a>
    </td>
  </tr>';
  }
} else {
echo '
<!--<div id="table-container">
  <blockquote>
    <h4>Pending Tickets <span class="badge">'.$result->num_rows.' Results</span></h4>
  </blockquote>
  <table class="centered striped">
    <tbody>-->';
}
echo "
    </tbody>
  </table>
</div>";
// Closed ticket table
$query = "SELECT
name,
client_info.reference,
landline,
address,
network,
status
FROM client_info
JOIN client_address USING(reference)
JOIN client_service USING(reference)
JOIN status USING(reference)
WHERE address LIKE '%$search%'
AND status='closed'";
$result = $conn->query($query);
if ($result->num_rows > 0) {
echo '
<div id="table-container">
  <blockquote>
    <h4>Finished Installations <span class="badge" style="font-size:1.5rem; padding-top:10px;">'.$result->num_rows.' Results</span></h4>
  </blockquote>
  <table class="centered striped">
    <thead>
      <tr class="thead">
        <th>Name</th>
        <th>Address</th>
        <th>Network</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>';
while ($row = $result->fetch_assoc()) {
  echo '
  <tr>
    <td>'.$row["reference"].' - '.$row["name"].'</td>
    <td>'.$row["address"].'</td>
    <td>'.$row["network"].'</td>
    <td><strong>'.$row["status"].'</strong></td>
    <td>
      <a class="btn secondary-btn hoverable waves-effect" href="?ng=ticket&id='.$row["reference"].'" style="color:#fff;">
       open
      </a>
    </td>
  </tr>';
  }
} else {
echo '
<!--<div id="table-container">
  <blockquote>
    <h4>Finished Installations <span class="badge" style="font-size:1.5rem; padding-top:10px;">'.$result->num_rows.' Results</span></h4>
  </blockquote>
  <table class="centered striped">
    <tbody>-->';
}
echo "
    </tbody>
  </table>
</div>";

}
