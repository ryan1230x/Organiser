<?php
/*--------------------------------------
-----------------------
Contents of this page
-----------------------
This page is shows two card, and within these
cards a query was executed to get how many
number of rows there were with a certain status;
Pending and closed.
--------------------------------------*/
$query = "SELECT status FROM status WHERE status='pending'";
$result = $conn->query($query);
$number_of_rows = $result->num_rows;
echo <<<_e
<div id="info-card">
  <blockquote>
    <h4>Dashboard</h4>
  </blockquote>
  <div class="info-card card-panel">
    <div class="row">
      <div class="col s12 m7">
        <h3>Pending Installatons</h3>
      </div>
      <div class="col s5 m5">
        <h3>$number_of_rows</h3>
      </div>
    </div>
  </div>
</div>
_e;
$query = "SELECT status FROM status WHERE status='closed'";
$result = $conn->query($query);
$number_of_rows = $result->num_rows;
echo <<<_e
<div id="info-card">
  <div class="info-card card-panel">
    <div class="row">
      <div class="col s12 m7">
        <h3>Finished Installatons</h3>
      </div>
      <div class="col s12 m5">
        <h3>$number_of_rows</h3>
      </div>
    </div>
  </div>
</div>
_e;
