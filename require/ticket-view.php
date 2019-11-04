<?php
/*--------------------------------------------------------
-------------
Page Content
-------------

This page show all the information for one client, this
information is obtained by quering the db over multile tables
using the client reference as the link.

The first large query display the page if the status is pending

The second large query displays the page if the status is closed, There
are some differences in design.

-----------------------------------------------------------*/
$id = $_GET["id"];
$query = "SELECT client_info.reference,
name,
landline,
contact_number,
network,
service,
portability,
package,
requested_date,
status,
address
FROM client_service
JOIN client_address USING(reference)
JOIN client_info USING(reference)
JOIN status USING(reference)
WHERE client_info.reference = '$id' AND status='Pending'
OR client_info.reference = '$id' AND status='Router Installation'";

$result = $conn->query($query);
if ($result->num_rows > 0) {

  while ($row = $result->fetch_assoc()) {
  echo'
  <div id="ticket" class="col s12">
    <div id="inner-ticket" class="col s12">
      <blockquote>
        <h4>'.$row["reference"].' - '.$row["name"].' - '.$row["address"].'</h4>
         <p class="right-align"><button class="btn secondary-btn" id="printBtn" onclick="window.print()" disabled >Print
         <i class="material-icons left">print</i>
        </button></p>
      </blockquote>
    </div>
    <div class="row">
      <div class="col s12 m6">
        <p><strong>Address:</strong> '. $row["address"] .'</p>
        <p><strong>Landline Number:</strong> '. $row["landline"] .'</p>
        <p><strong>Contact Number:</strong> '. $row["contact_number"] .'</p>
        <p><strong>Requested date:</strong> '.$row["requested_date"].'</p>
      </div>

      <div class="col s12 m6">
      <form action="config/setUpdate.php" method="POST">
       <div class="input-field">
         <p><strong>Status:</strong></p>
          <select name="status">
           <option selected>'.$row["status"].'</option>
           <option value="Pending">Pending</option>
           <option value="Router Installation" >Router Installation</option>
          </select>
        </div>
        <div class="input-field">
         <p><strong>Network:</strong></p>
         <select name="network">
          <option selected>'.$row["network"].'</option>
          <option value="Masmovil">MasMovil</option>
          <option value="NEBA">NEBA</option>
          <option value="Layer4">Layer4</option>
          <option value="ADSL Layer4">ADSL Layer4</option>
         </select>
        </div>
        <p><strong>dT client Package:</strong></p>
        <div class="input-field">
         <select name="package">
          <option selected>'.$row["package"].'</option>
          <option value="50/50(basic)">50/50 (basic)</option>
          <option value="100/100(Fibernate)">100/100 (Fibernate)</option>
          <option value="300/300(Basic)">300/300 (Basic)</option>
          <option value="600/600(Fibernate)">600/600 (Fibernate)</option>
         </select>
        </div>
        <p><strong>Portability:</strong></p>
        <div>
         <select name="portability">
          <option selected>'.$row["portability"].'</option>
            <option value="Yes">Yes</option>
            <option value="No">No</select>
         </select>
        </div>
         <p class="right-align"><button class="btn secondary-btn" id="submitForm" type="submit">update</button></p>
         <input type="hidden" value="'.$row["reference"].'" name="reference" />
       </form>
      </div>

      <div class="col s12">
        <h5>
          <blockquote>
            <strong>Comments</strong>
          </blockquote>
        </h5>
          <div id="comment-section">';
        // This query gets all the comments from the table comments that have the clients reference
        $query = "SELECT * FROM comments WHERE reference='{$_GET["id"]}' ORDER BY id DESC";
        $res = $conn->query($query);
        if($res->num_rows > 0) {
          while ($row1 = $res->fetch_assoc()) {
            echo'
            <div style="margin-bottom:20px;" class="z-depth-1 white-text">
              <div style="padding:15px; background-color: var(--primary-color-light);">
                <span>'. $row1["added_at"] .'</span>
              </div>
              <div class="black-text" style="padding:15px;">
                <span>'. nl2br($row1["comment"]) .'</span>
              </div>
            </div>';
           }
          }
         else { echo '<h6 style="padding: 40px 0;" class="center-align">There are currently no comments</h6>';}

      echo'
      </div>
      <div class="row" style="margin-bottom:50px;">
        <form class="col s12" method="post" action="config/setComment.php">
          <div class="input-field col s12">
            <textarea name="comment" class="materialize-textarea validate" id="comment" required></textarea>
            <label for="comment">Add Comment</label>
          </div>
          <div class="col s12">
            <button type="submit" name="button" class="right btn waves-effect waves-blue secondary-btn">add note
              <i class="material-icons left">edit</i>
            </button>
            <input type="hidden" name="reference" value="'. $row["reference"] .'" />
          </div>
        </form>
      </div>
      <blockquote>
        <h5>
          <strong>Closing Comment</strong>
        </h5>
      </blockquote>
      <div class="row">
        <form class="col s12" action="config/closeTicket.php" method="post">
          <div class="input-field col s12">
            <textarea name="comment" class="materialize-textarea validate" id="comment" required></textarea>
            <label for="comment">Add Comment</label>
          </div>
          <button type="submit" name="button" class="right btn waves-effect waves-teal" id="close-btn">Close ticket
            <i class="material-icons left">done</i>
          </button>
          <input type=hidden value="'.$row["reference"].'" name="reference" />
        <form>
      </div>

    </div>';
  }

} else {
  $query = "SELECT client_info.reference,
  name,
  landline,
  contact_number,
  network,
  service,
  portability,
  package,
  requested_date,
  status,
  address
  FROM client_service
  JOIN client_address USING(reference)
  JOIN client_info USING(reference)
  JOIN status USING(reference)
  WHERE client_info.reference = '$id' AND status='closed' OR status='Cancelled'";
  $result = $conn->query($query);
  while ($row = $result->fetch_assoc()) {

    echo'
    <div id="ticket" class="col s12">
      <div id="inner-ticket" class="col s12">
        <div class="card-panel teal lighten-2 closed-card">
          <h4>Closed Ticket</h4>';
          // This query gets all the comments from the table comments that have the clients reference
          $query = "SELECT * FROM comments WHERE reference='{$row["reference"]}' ORDER BY id DESC LIMIT 1";
          $res = $conn->query($query);
          if ($res->num_rows > 0) {
            while ($row1 = $res->fetch_assoc()) {
              echo'<p>'.$row1["comment"].'</p>';
            }
          }
        echo '
         <form method="POST" action="config/setReopen.php">
           <button class="btn d-flex teal darken-3 hoverable">reopen</button>
           <input type="hidden" value="'.$id.'" name="reference" />
         </form>
        </div>
        <blockquote>
          <h4>'.$row["reference"].' - '.$row["name"].' - '.$row["address"].'</h4>
        </blockquote>
      </div>
      <div class="row">
        <div class="col s12 m6">
          <p><strong>Address:</strong> '. $row["address"] .'</p>
          <p><strong>Requested date:</strong> '. $row["requested_date"] .'</p>
          <p><strong>landline Number:</strong> '. $row["landline"] .'</p>
          <p><strong>Contact Number:</strong> '. $row["contact_number"] .'</p>
        </div>

        <div class="col s12 m6">
          <p><strong>Network:</strong> '. $row["network"] .'</p>
          <p><strong>dT Clien Package:</strong> '. $row["package"] .'</p>
          <p><strong>Portability:</strong> '. $row["portability"] .'</p>
        </div>

        <div class="col s12">
          <h5>
            <blockquote>
              <strong>Comments</strong>
            </blockquote>
          </h5>
            <div id="comment-section">';
          $query = "SELECT * FROM comments WHERE reference='{$row["reference"]}' ORDER BY id DESC";
          $res = $conn->query($query);
          if ($res->num_rows > 0) {
            while ($row1 = $res->fetch_assoc()) {
              echo'
              <div style="margin-bottom:20px;" class="z-depth-1 white-text">
                <div style="padding:15px; background-color: var(--primary-color-light);">
                  <span>'. $row1["added_at"] .'</span>
                </div>
                <div class="black-text" style="padding:15px;">
                  <span>'. nl2br($row1["comment"]) .'</span>
                </div>
              </div>';
            }
          } else { echo '<h6 style="padding: 40px 0;" class="center-align">There are currently no comments</h6>'; }
        echo'</div>';
  }
}

echo "
</div>";
