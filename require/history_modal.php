<?php
/*----------------------------------------
------------------------
Contents of this page
------------------------
This page is used to display previous comments that
other user have added onto clients individual tickets

There is a query in this file that accesses
data over multiple table using the client reference as
the link to get all the needed information
-----------------------------------------*/
echo <<<_e
<div class="row" id="history">
  <div class="col s12">
    <blockquote>
      <h4>Recent History</h4>
    </blockquote>
_e;
$query = "SELECT
name,
landline,
comment,
address,
client_info.reference,
comments.id
FROM client_info
JOIN comments USING(reference)
JOIN client_address USING(reference) ORDER BY id DESC LIMIT 25";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
  echo '
  <div class="col s12 black-text history-card">
    <h5>'. $row["reference"] .' - '. $row["name"] .' - '. $row["landline"] .' - '. $row["address"] .'</h5>
    <p class="align-justify">'. nl2br($row["comment"]) .'</p>
    <a href="?ng=ticket&id='.$row["reference"].'" class="btn secondary-btn hoverable waves-effect">Open</a>
  </div>
  ';
}

echo '
    </div>
  </div>';
