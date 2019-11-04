<?php
/*--------------------------------
----------------------
Contents of this page
----------------------
This page is to add information using the form
below to the db, all of this data is displayed
on the table in the "Home".

The if statements are being used below to catch
error message from the config/setTicket.php file
which is where this data is being sent to
---------------------------------*/
echo<<<_e
  <div class="row" id="create">
    <form class="col s12" action="config/setTicket.php" method="post" id="setTicket">
      <div class="row">
        <div class="col s12">
_e;
if ($_GET["creation"]) {

  if ($_GET["creation"] === "success") {
    echo "
    <div class='card-panel teal' style='font-weight:300;'>
      <h5>Ticket Created Successfully</h5>
    </div>";
  } elseif ($_GET["creation"] === "failed") {
    echo "
    <div class='card-panel red' style='font-weight:300;'>
      <h5>Ticket Created failed</h5>
    </div>";
  } elseif ($_GET["creation"] === "unset") {
    echo "
    <div class='card-panel red' style='font-weight:300;'>
      <h5>Ticket Created failed</h5>
      <strong>
        <p style='border-top:1px solid #333;padding-top:15px;'>There is already a ticket created with the same client reference.</p>
      </strong>
    </div>";
  }
}
echo '
          <blockquote>
            <h4>Create ticket</h4>
          </blockquote>
          <p>
            Please fill in this form correctly to add a new ticket to the list.
          </p>
        </div>
        <div class="input-field col s12 m3">
          <input type="text" name="cliRef" id="cliRef" class="validate" required>
          <label for="cliRef">Client Ref</label>
        </div>

        <div class="input-field col s12 m9">
          <input type="text" name="name" id="name" class="validate" required>
          <label for="name">Name</label>
        </div>

        <div class="input-field col s12 m3">
          <input type="date" name="date" id="date" class="validate" placeholder="" value="" required>
        </div>

        <div class="input-field col s12 m9">
          <input type="text" name="address" id="address" class="validate" required>
          <label for="address">Address</label>
        </div>

        <div class="input-field col s12 m3">
          <select name="network" required>
            <option disabled selected>Select Option</option>
            <option value="network 1">network 1</option>
            <option value="network 2">network 2</option>
            <option value="network 3">network 3</option>
            <option value="network 4">network 4</option>
          </select>
          <label>Choose Network</label>
        </div>

        <div class="input-field col s12 m3">
          <select name="requested_service" required>
            <option disabled selected>Select Option</option>
            <option value="option 1">option 1</option>
            <option value="option 2">option 2</option>
            <option value="option 3">option 3</option>
          </select>
          <label>Requested Service</label>
        </div>

        <div class="input-field col s12 m3">
          <select name="client_package" required>
            <option disabled selected>Select Option</option>
            <option value="option 1">option 1</option>
            <option value="option 2">option 2</option>
            <option value="option 3">option 3</option>
            <option value="option 4">option 4</option>
          </select>
          <label>Clients package</label>
        </div>

        <div class="input-field col s12 m3">
          <select name="portability" id="potability" required>
            <option disabled selected>Select Option</option>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
          <label>Portability</label>
        </div>

        <div class="input-field col s12 m6" id="landline-div">
          <input type="text" name="landline" id="landline" class="validate" required>
          <label for="landline">Landline Number</label>
        </div>

        <div class="input-field col s12 m6" id="mob-div">
          <input type="text" name="mobile_number" id="mob" class="validate">
          <label for="mob">Mobile Number</label>
        </div>

        <div class="col s12">
          <h6>Would you like to a comment?
            <p>
              <input type="checkbox" id="comment" name="comment_checkbox" class="scale-transition" value="yes"/>
              <label for="comment">Yes</label>
            </p>
          </h6>
        </div>

        <div class="input-field col s12 scale-transition scale-out hidden" id="text-div">
          <input type="text" class="materialize-textarea" id="comment_text" name="init_comment" />
          <label for="comment_text">Add Comment</label>
        </div>

      </div>
      <div class="col s12">
        <button type="submit" name="submitBtn" class="btn waves-effect waves-blue secondary-btn" id="addBtn">create</button>
      </div>
    </div>
  </form>';
