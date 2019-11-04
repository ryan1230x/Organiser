<?php
require_once 'require/header.php';
echo "<main>";
if (isset($_GET["ng"])) {
  if ($_GET["ng"] === "login") {
    require_once 'require/login.php';
  }
  if ($_GET["ng"] === "home") {
    require_once 'require/search_bar.php';
    require_once 'require/table.php';
  }
  if ($_GET["ng"] === "search") {
    require_once 'require/search_bar.php';
    require_once 'config/search.php';
  }

  if ($_GET["ng"] === "ticket") {
    require_once 'require/ticket-view.php';
  }

  if ($_GET["ng"] === "create") {
    require_once 'require/add_modal.php';
  }

  if($_GET["ng"] === "history") {
    require_once 'require/history_modal.php';
  }

} else {
  require_once 'require/search_bar.php';
  require_once 'require/info-card.php';
}
echo "</main>";
require_once 'require/footer.php';
