<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/function.php'); ?>

<?php 
if (!isset($SESSION)) {
    session_start();
}

$_SESSION['PrevPage'] = $_SERVER['REQUEST_URI']; 
$_SESSION['login_form_title'] = "HEY!  WHO ARE YOU?"
?>

<!-------- READ MEMBER TABLE FIRST -------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
?>

<?php if (!isset($_SESSION['Username']))  
    header('Location: ../login_form.php')  ?>
<?php if (($row5['unititle']) !== "admin")  
    header('Location: ../login_form.php')  ?>



    <!----------- Insert new post ----------->

<?php
if (isset($_POST["editor1"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('no database');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	$query = sprintf("INSERT INTO announ (username,title,content,datetime) VALUES ( %s, %s, %s, %s)",  
		GetSQLValue($_SESSION['Username'], "text"),
        GetSQLValue($_POST['com_title'], "text"),
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($datetime, "date"));
	
    $result = mysql_query($query, $connection);

	if ($result)  {
		// 回到前一個網頁 
		header('Location: announ_list.php');
        
	};
} 
?>
    <!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Announ - Post</title>
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <link href="announ_add.css" rel="stylesheet" type="text/css" />
    <script src="JavaScript/jBox.min.js"></script>
    <link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
    <script src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
	var editor_data = CKEDITOR.instances.editor1.getData();
    </script>
    <script type="text/javascript">
    function CheckFields()
{
	var fieldvalue = document.getElementById("com_title").value;
	if (fieldvalue == "") 
	{
		alert("Please type a title !");
		document.getElementById("com_title").focus();
		return false;
	} ;
    
}
    </script>
</head>

<body>

    
<section id="detail">
<div id="community_main">
    <h3>Publish Announcement 
    <a href="control_center.php"><img src="../images/previous.png"></a>
    </h3>
    <form method="post" id="post_form">
		<p>
            Topic:
        <input type="text" name="com_title" id="com_title" maxlength="100"><br><br>
			<textarea id="editor1" name="editor1"></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
		</p>
		<p>  
            <input type="Reset" value="Reset"/>
			<input type="submit" value="Submit" onclick="return CheckFields();"/>
		</p>
	</form>
    <a href="announ_list.php"><img src="../images/nextpage.png"></a>
    
    </div>
    
</section>

    
</body>
</html>


