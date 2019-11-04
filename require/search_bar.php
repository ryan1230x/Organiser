<?php
echo<<<_e
<form class="col s12" action="?ng=search" method="POST" id="search_input">
 <div class="row">
  <div class="input-field col s7 m6">
   <i class="material-icons prefix">search</i>
   <input id="icon_prefix" type="search" class="validate" name="s" required>
   <label for="icon_prefix">Client Address</label>
  </div>
  <div class="col s5 m2" style="padding-top:25px;">
   <button type="submit" class="btn secondary-btn">Search</button>
  </div>
 </div>
</form>
_e;
