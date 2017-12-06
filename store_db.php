<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

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
    header('Location: login_form.php')  ?>
<?php if (($row5['unititle']) !== "admin")  
    header('Location: login_form.php')  ?>

<!---------------------------------------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query = sprintf("SELECT id,item_index FROM computer_books ORDER BY id DESC LIMIT 1");

    $result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
    {$row = mysql_fetch_assoc($result);} ;
?>

<!----------- Insert new post ----------->

<?php
if ((isset($_POST["insert"])) && ($_POST["insert"] == "item_add")) 
{	
	mysql_select_db('stonesga_ch30', $connection) or die('no database');	
    
	$query = sprintf("INSERT INTO computer_books (id,item_index,title,author,contents,feature,publishdate,saleprice,photo,img1,img2,img3,img4,img5,category,topseller) VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )",  
        GetSQLValue($_POST['com_id'], "int"),  
        GetSQLValue($_POST['com_index'], "text"),             
		GetSQLValue($_POST['com_title'], "text"),
        GetSQLValue($_POST['com_author'], "text"),
		GetSQLValue($_POST['content1'], "text"),
        GetSQLValue($_POST['editor1'], "text"), 
        GetSQLValue($_POST['com_publish'], "date"),
        GetSQLValue($_POST['com_price'], "text"),
        GetSQLValue($_POST['com_photo'], "text"),
        GetSQLValue($_POST['img1'], "text"), 
        GetSQLValue($_POST['img2'], "text"),
        GetSQLValue($_POST['img3'], "text"),
        GetSQLValue($_POST['img4'], "text"),
        GetSQLValue($_POST['img5'], "text"),
        GetSQLValue($_POST['category'], "text"),
        GetSQLValue($_POST['topsell'], "text"));
	
    $result = mysql_query($query, $connection);

	if ($result)  {
		// 回到前一個網頁 
		header('Location: management/upload.php');
        
	};
} 
?>
<!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Store - Input Game</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/store_db.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	var editor_data = CKEDITOR.instances.editor1.getData();
</script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
</head>   

<body>

    
<section id="detail">
<div id="community_main">
    <div id="title">
    <h3>Input new game in store database 
    <a href="store_list.php"><img src="images/previous.png" class="tooltip" title="Back to Center"></a>
    </h3>
    </div>
    
    <form method="post" id="post_form">
		
        <?php     
            $newid = $row['id'] + 1;
        ?>
        
        ID :
        <input type="text" name="com_id" id="com_id" maxlength="100" value="<?php echo $newid ?>" required>
        <I>(Current ID = [<?php echo $row['id'] ?>] + 1)</I>
        <br><br>
        
        Item_index : 
        <input type="text" name="com_index" id="com_index" maxlength="100" required>
        <I>(Current index = [<?php echo $row['item_index'] ?>] + 1)</I>
        <br><br>
        
        Game Title :
        <input type="text" name="com_title" id="com_title" maxlength="100" required><br><br>
        
        Game Author :
        <input type="text" name="com_author" id="com_author" maxlength="100" required><br><br>
        
        Game Content :<br><br>
        <textarea id="content1" name="content1" required></textarea>
        
        <br><br>
        
        Game Feature :<br><br>
        <div id="ckeditor">
			<textarea id="editor1" name="editor1" required></textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor1' );
			</script>
        </div>
		
        Publish Day : <input type="text" name="com_publish" id="com_publish" maxlength="100" required><br><br>
        
        Sale Price : <input type="text" name="com_price" id="com_price" maxlength="100" required><br><br>
        
        <div id="notice">Please type the picture filename like GTA5.png/CSGO.jpg/aoc2017.jpg....<br>
        Then, upload the file in the next page that what you had type.<br>
        Remember! Don't miss the picture format.
        </div>
            
            
        Photo path : <input type="text" name="com_photo" id="com_photo" maxlength="100"><br><br>
        
        Path - IMG1 : <input type="text" name="img1" id="img1" maxlength="100"><br><br>
        
        Path - IMG2 : <input type="text" name="img2" id="img2" maxlength="100"><br><br>
        
        Path - IMG3 : <input type="text" name="img3" id="img3" maxlength="100"><br><br>
        
        Path - IMG4 : <input type="text" name="img4" id="img4" maxlength="100"><br><br>
        
        Path - IMG5 : <input type="text" name="img5" id="img5" maxlength="100"><br><br>
        
        Category : 
                <select id="category" name="category" placeholder="Category" autocomplete="off">
                <option value="Adventure">Adventure</option>
                <option value="Action">Action</option>
                <option value="Strategy">Strategy</option>
                <option value="Sports">Sports</option>
                <option value="Multiplay">Multiplay</option>
                </select><br><br>
        
        Top Seller : <input type="text" name="topsell" id="topsell" maxlength="100"><br><br>
        
        
<input name="insert" id="insert" type="hidden" value="item_add" />
            <input type="Reset" value="Reset"/>
			<input type="submit" value="Submit">
		
	</form>
    
    <a href="management/upload.php"><img src="images/nextpage.png" class="tooltip" title="Go to upload"></a>
    
    </div>
    
</section>

    
</body>
</html>
      
    