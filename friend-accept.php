<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
if (!isset($_SESSION)) {
	session_start();	
}
?>
<?php

mysql_select_db('stonesga_ch30', $connection) or die('no database'); 

$query = sprintf("INSERT INTO friendship (myid, myfriends) VALUES (%s, %s)",
        GetSQLValue($_SESSION['Username'],"text"),
        GetSQLValue($_GET['sender'],"text"));

$query2 = sprintf("DELETE FROM request WHERE sender=%s and receiver=%s",
        GetSQLValue($_GET['sender'],"text"),
        GetSQLValue($_SESSION['Username'],"text"));

$result = mysql_query($query, $connection) or die(mysql_error());

$result2 = mysql_query($query2, $connection) or die(mysql_error()); 

?>
<?php 
if (isset($_SESSION['Username']) ) {
  header(sprintf("Location: profile.php?username=%s", $_SESSION['Username']));
}
else {
  header('Location: member_center.php');
}
?>
<?php
// 釋放結果集
mysql_free_result($result);
?>