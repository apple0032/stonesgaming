<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/function.php'); ?>

<?php 
if (!isset($SESSION)) {
    session_start();
} 

$_SESSION['login_form_title'] = "HEY!  WHO ARE YOU?"
?>

<!-------- READ MEMBER TABLE (CHECK PERMISSION)-------->
<?php 
    if (isset($_SESSION['Username'])){
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
    } 
?>

<?php if (!isset($_SESSION['Username']))  
    header('Location: ../login_form.php')  ?>
<?php if (($row5['unititle']) !== "admin")  
    header('Location: ../login_form.php')  ?>

<!------------------------------------------>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Management Center</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="../CSS/manacenter.css" rel="stylesheet" type="text/css" />
</head>

<body>

<nav id="nav">

<div class="nav_menu">
<a href="member/" target="_blank">
<img src="../images/mana-member.png">
    <div class="nav_title">Member System</div>
</a>
</div>
    
<div class="nav_menu">
<a href="community/" target="_blank">
<img src="../images/mana-commu.png">
    <div class="nav_title">Community System</div>
</a>
</div>
    
<div class="nav_menu">
<a href="announ_add.php" target="_blank">
<img src="../images/mana-announ.png">
    <div class="nav_title">Announcement</div>
</a>
</div>
    
<div class="nav_menu">
<a href="../store_list.php" target="_blank">
<img src="../images/mana-store.png">
    <div class="nav_title">Store Database</div>
</a>
</div>
    
<div class="nav_menu">
<a href="../deliver_list.php" target="_blank">
<img src="../images/mana-delivery.png">
    <div class="nav_title">Store OrderList</div>
</a>
</div>
    
<div class="nav_menu">
<a href="../support_gm.php" target="_blank">
<img src="../images/mana-sup.png">
    <div class="nav_title">Support Center</div>
</a>
</div>
</nav>
    
 
<div id="toptop">
<a href="../main"><img src="../images/back-page.png"></a>
</div>
    
<div id="outout">
<a href="../log_out.php"><img src="../images/logout.png"></a>
</div>

    
</body>
</html>