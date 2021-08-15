<?php

session_start();
if ($_GET['user']) {
  $_SESSION['user'] = $_GET['user'];
} else {
  session_unset();
  session_destroy();
}
$source = $_GET['source'];

//header("Location: $source.php"); exit;
header("Location: /"); exit;