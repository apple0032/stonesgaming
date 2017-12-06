<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
?>
<?php

mysql_select_db('stonesga_ch30', $connection) or die('no database'); 

$query = sprintf("INSERT INTO request (sender, receiver) VALUES (%s, %s)",
        GetSQLValue($_SESSION['Username'],"text"),
        GetSQLValue($_GET['receiver'],"text"));

$result = mysql_query($query, $connection) or die(mysql_error());

?>
<?php 
if (isset($_SESSION['Username']) ) {
  header(sprintf("Location: profile.php?username=%s", $_GET['receiver']));
}
else {
  header('Location: member_center.php');
}
?>
<?php
// 釋放結果集
mysql_free_result($result);
?>