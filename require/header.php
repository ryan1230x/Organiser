<?php

session_start();
if(!isset($_SESSION["username"])) {
 header("Location: ../login.php");
 exit();
}


require_once 'config/dbh.php';
echo <<<_e
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link rel="stylesheet" href="css/master.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Organiser</title>
  </head>
  <body>
  <!-- Navigation menu -->
  <header>
    <ul id="slide-out" class="side-nav fixed">
      <li style="padding:50px 32px 0 32px">
        <a href="index.php">
          <h4>Helpdesk</h4>
        </a>
      </li>
      <li>
        <a href="?ng=home">Home
          <i class="material-icons">home</i>
        </a>
      </li>
      <li>
        <a href="?ng=create">Add
          <i class="material-icons">edit</i>
        </a>
      </li>
      <li>
        <a href="?ng=history">History
          <i class="material-icons">history</i>
        </a>
      </li>
<li>
  <a href="config/logout.php">Logout
   <i class="material-icons">logout</i>
  </a>
</li>
    </ul>
  </header>
  <div id="nav-icon">
    <a href="#" data-activates="slide-out" class="button-collapse">
      <i class="material-icons">menu</i>
    </a>
  </div>
_e;
