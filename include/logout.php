<?php 

session_start();

$_SESSION['connected'] = false;
$_SESSION['admin'] = false;

header("Location: ../index.php");

?>