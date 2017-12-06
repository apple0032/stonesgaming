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

<!---------------------------------------->
<!----------------UPLOAD-------------------->

<?php
    if (isset($_POST['submit'])) {
        
	for($i=0;$i<count($_FILES["image"]["name"]);$i++)
{
		$errors= array();
		$file_name = $_FILES['image']['name'][$i];
		$file_size =$_FILES['image']['size'][$i];
		$file_tmp =$_FILES['image']['tmp_name'][$i];
		$file_type=$_FILES['image']['type'][$i];   
    
  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'][$i])));
		
        
		$expensions= array("jpeg","jpg","png"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 4194304){
		$errors[]='File size must be excately 2 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../photo/item/".$file_name);
			header('Location: ../store.php');
		}else{
			print_r($errors);
		  }
	   	}
exit();
    }
?>
<!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Store - Input Picture</title>
<script src="../assets/js/jquery-3.1.1.min.js"></script>
<link href="../CSS/store_db.css" rel="stylesheet" type="text/css" />

<section id="detail">
<div id="community_main">
    <div id="title">
    <h3>Upload picture for your game!
    <a href="control_center.php"><img src="../images/previous.png"></a>
    </h3>
    </div>  
    
<div id="upload-guide">
Congratulations! Your game has been stored in database.<br>
Now, please upload some pictures to feature you game!
</div>
    
<form action="" method="POST" enctype="multipart/form-data" id="upload">
<i>The profile picture first : </i>
<input type="file" name="image[]" /><br><br>
    
<i>Then, upload FIVE pictures or gameplay to feature this game.</i><br><br>
<input type="file" name="image[]" /><br>
<input type="file" name="image[]" /><br>
<input type="file" name="image[]" /><br>
<input type="file" name="image[]" /><br>
<input type="file" name="image[]" /><br><br>
    
<input type="submit" name="submit" value="Upload"/>
</form>
    
    
 </div>
    
</section>

    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    
