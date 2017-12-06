<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
?>
<?php

mysql_select_db('stonesga_ch30', $connection) or die('no database'); 

$_SESSION['bgheader'] = $_GET['wall'];

?>
<?php 
   header(sprintf("Location: %s", $_SESSION['PrevPage']));
?>
