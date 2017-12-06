<?php
  session_start();
  ob_start();
?>


<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 


$_SESSION['PrevPage'] = $_SERVER['REQUEST_URI']; 
$_SESSION['login_form_title'] = "Login to join community."
?>

<?php if (!isset($_SESSION['Username']))  header('Location: login_form.php')  ?>

<!----------- SELECT TOPIC DETAIL ----------->
<?php 
    
mysql_select_db('stonesga_ch30', $connection) or die('no database'); 
$query = sprintf("SELECT * FROM community WHERE id = %s", GetSQLValue($_GET['id'], "int"));
$result = mysql_query($query, $connection) or die(mysql_error());
if ($result)
{
     // 目前的列
	$row = mysql_fetch_assoc($result);
	// 結果集的記錄筆數
	$totalRows = mysql_num_rows($result);
}

?>
<!---------------------------------------->

    <!----------- Insert new post ----------->

<?php
if (isset($_POST["editor1"]) ) 
{
    
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("UPDATE community SET title=%s, comment=%s WHERE id=%s",  
        GetSQLValue($_POST['com_title'], "text"),
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($row['id'], "int"));
        
    
	// 傳回結果集
	$result = mysql_query($query, $connection);

	if ($result) {
		
        $link = $row['id'];
		header("Location: community_detail.php?id=$link");
        
	};
} 
?>
    <!---------------------------------------->

<?php 
    if(($_SESSION['Username'])!==("apple0032")){
    if(($_SESSION['Username'])!==($row['username'])){
         header('Location: community.php');
    } }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Community - Edit</title>
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <link href="CSS/community.css" rel="stylesheet" type="text/css" />
    <link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
    <script src="JavaScript/community_detail.js"></script>
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
    
    var fieldvalue = document.getElementById("editor1").value;
	if (fieldvalue == "") 
	{
		alert("The content is empty!");
		document.getElementById("editor1").focus();
		return false;
	} ;  
    
}
    </script>
    <?php
  $bg = array('bg-01.png', 'bg-02.png','bg-03.png','bg-04.png','bg-05.png','bg-06.png','bg-07.png','bg-08.png','bg-09.png','bg-10.png' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">

body{
background: url(images/<?php echo $selectedBg; ?>) no-repeat;
background-size: cover;
background-attachment: fixed;　
background-size: cover;
}
</style>
</head>

<body>
<!-- 載入上邊區塊 -->
 <div id="header"></div>

    
<section id="detail">
<div id="community_main">
    
    <div id="community_bar">
    <div id="goback"><a href="community_detail.php?id=<?php echo $row["id"] ?>"><img src="images/previous.png" class="tooltip" title="BACK"/></a></div>
    <div id="post"><a href="community_photo.php"><img src="images/photo-camera.png" class="tooltip" title="Share a photo?"/></a></div>
    </div>
    
    <div id="post_detail">
    <div id="post_rule" class="tooltip" title="Please read before you post">
        <div id="post_rule_content">
        <ul>
            <li>Please confirm to put a topic for your post.</li>
            <li>Don't use all caps or special characters to draw attention.</li>
            <li>Outside the translator forum English is the only allowed language.
</li>
        </ul>  
        </div>
        <div id="post_noti"><img src="images/noti.png"></div>

    </div>
      
    
    <form method="post" id="post_form">
		<p>
            <div id="post_topic">Topic:</div><input type="text" name="com_title" id="com_title" maxlength="100" value="<?php echo $row['title'] ?>"><br><br>
			<textarea id="editor1" name="editor1">
            
            <?php if(empty($row['photo'])) { ?> 
            <?php echo $row['comment'] ?>
            <?php } else { ?> 
            <img src="<?php echo $row['photo'] ?>">
            <?php } ?>
        
            </textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
		</p>
		<p>  
            <input type="Reset" value="Reset"/>
			<input type="submit" value="Submit" onclick="return CheckFields();"/>
		</p>
	</form>
    </div>
    
</div>
</section>

    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>


