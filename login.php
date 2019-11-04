<?php
echo <<<_e
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="css/master.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Organiser</title>
    <style media="screen">
body{
background-color:#f0f0f0;
}
#login-panel {
position: absolute;
top:50%;
left:50%;
transform:translate(-50%, -50%);
border: 1px solid #fff;
}
    </style>
  </head>
  <body>
  <div class="card-panel z-depth-0" id="login-panel">

    <div class="row">
      <div class="col s12">
        <form action="config/login.php" method="post">
          <div class="row">
<div class="col s12">
 <h4 class="center-align">Welcome</h4>
 <p class="center-align"> Please use your credentials</p>
</div>
            <div class="input-field col s12">
              <input type="text" name="uname" id="uname" />
              <label for="uname">Username</label>
            </div>
            <div class="input-field col s12">
              <input type="password" name="password" id="pwd">
              <label for="pwd">Password</label>
            </div>
            <button type="submit" class="btn secondary-btn hoverable">Login</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="js/main.js" charset="utf-8"></script>
  </body>
</html>
_e;
