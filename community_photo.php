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


<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'uploads/'; // upload directory

if(isset($_FILES['image']))
{
	$img = $_FILES['image']['name'];
	$tmp = $_FILES['image']['tmp_name'];
		
	// get uploaded file's extension
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	
	// can upload same image using rand function
	$final_image = rand(1000,1000000).$img;
	
	// check's valid format
	if(in_array($ext, $valid_extensions)) 
	{					
		$path = $path.strtolower($final_image);	
			
		if(move_uploaded_file($tmp,$path)) 
		{
            
            // 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO community (username,title,photo,datetime) VALUES ( %s, %s, %s, %s)",  
		GetSQLValue($_SESSION['Username'], "text"),
        GetSQLValue($_POST['com_title'], "text"),
		GetSQLValue($path, "text"),
        GetSQLValue($datetime, "date"));
        
    
	// 傳回結果集
	$result = mysql_query($query, $connection);

	if ($result) {
		// 回到前一個網頁 
		header('Location: community.php');
        
	};
		}
	} 
	else 
	{
		echo 'invalid';
	}
}

?>

 <!----------- Insert new post ----------->


    <!---------------------------------------->


<!doctype html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<title>Community - Share Image</title>
    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="JavaScript/community_detail.js"></script>
    <link href="CSS/community.css" rel="stylesheet" type="text/css" />
    <link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
    <script src="JavaScript/jBox.min.js"></script>
    <link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
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
    <div id="goback"><a href="community.php"><img src="images/previous.png" class="tooltip" title="BACK"/></a></div>
    <div id="post"><a href="community_add.php"><img src="images/post.png" class="tooltip" title="Post article"/></a></div>
    </div>    
      
        <div id="post_detail">
            
        <div id="upload_rule" class="tooltip" title="Please read before you post">
        <div id="upload_rule_content">
        <ul>
            <li>Noted that only picture format should be allowed to upload.('jpeg', 'jpg', 'png', 'gif' or 'bmp')</li>
            <li>Please make sure you will not post content that: is hate speech, threatening, or pornographic; incites violence; or contains nudity or graphic or gratuitous violence.</li>
            <li>The limitation of image size is 2MB.
</li>
        </ul>  
        </div>
        <div id="upload_noti"><img src="images/picture.png"></div>

    </div>
     
<!----------- This is the upload main part -----------> 

<div id="upload_box">
<div id="upload_title">Please give a TITLE for your image here:</div>
<form id="form" method="post" enctype="multipart/form-data">
    <input type="text" name="com_title" id="com_title" maxlength="100"><br><br>
    
    <div id="preview" class="tooltip" title="This is preview box"><img id="blah" src="#" alt="YOUR IMAGE" /></div>
    
    <div id ="upload_image">
    <input id="uploadImage" type="file" accept="image/*" name="image"/>
    
    <label for="image">Choose a file</label>
    
    <input id="button" type="submit" value="Post" onclick="return CheckFields();">
    </div>
	</form>
</div>            
<!----------------------------------------------------->
            
        
        
        </div> 
    </div>
</section>    
<script>
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#uploadImage").change(function(){
        readURL(this);
    });    
    
</script>    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>