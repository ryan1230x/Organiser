<?php
/*---------------------------------------
---------------------
Page Content
--------------------
This page show all of the data that is with in the db
in a table.

There is a query that accesses multiple tables using the
client reference as the link between all of them, this table
focuses on show the data that has a status of "pending".

----------------------------------------*/
$query = "SELECT
client_info.id,
client_address.reference,
name,
address,
package,
status,
network
FROM client_address
JOIN client_info USING(reference)
JOIN status USING(reference)
JOIN client_service USING(reference)
WHERE status='Pending' OR status='Router Installation' ORDER BY id DESC";
echo '
<div id="table-container">
<blockquote>
  <h4>Pending Installations <span class="badge">'.$conn->query($query)->num_rows.' Open</span></h4></h4>
</blockquote>
<table class="striped">
 <thead>
  <tr class="thead">
   <th>Name</th>
   <th>Address</th>
   <th>Selected Package</th>
   <th>Network</th>
   <th>Status</th>
   <th>Action</th>
   </tr>
  </thead>
    <tbody>';
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
echo '
<tr>
 <td>'.$row["reference"].' - '.$row["name"].'</td>
 <td>'.$row["address"].'</td>
 <td>'.$row["package"].'</td>
 <td>'.$row["network"].'</td>
 <td><strong>'.$row["status"].'</strong></td>
 <td><a class="btn secondary-btn hoverable waves-effect" href="?ng=ticket&id='.$row["reference"].'">open</a></td>
</tr>';
}
echo'
  </tbody>
 </table>
</div>';
