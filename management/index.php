<?php require_once('../Connections/connection.php'); ?>
<?php require_once('../Connections/function.php'); ?>
<?php
// 建立 session
if (!isset($_SESSION)) {
  session_start();
}
// 前一個網頁
$_SESSION['PrevPage'] = "../login_form.php";
?>

<?php 
        if (isset($_SESSION['Username'])){
        if(($_SESSION['Username']) == 'apple0032') {
        header("Location: control_center.php");
} }
?>

<?php
if (isset($_POST['username']) && isset($_POST['password'])) 
{
    // 帳號與密碼欄位
	$username = $_POST['username'];
  	$password = $_POST['password'];	
	// 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');	  
	
  	// 查詢member資料表的username與password欄位
  	$query = sprintf("SELECT username, password, userlevel FROM member WHERE username=%s AND password=%s",
        GetSQLValue($username, "text"), GetSQLValue($password, "text")); 		
   	// 傳回結果集
    $result = mysql_query($query, $connection);	
	
	if ($result)
	{
		// 結果集的記錄筆數
    	$totalRows = mysql_num_rows($result);
	
		// 使用者輸入的帳號與密碼存在於member資料表
    	if ($totalRows) 
		{    
			// 建立session變數
    		$_SESSION['Username'] = $username;
		    $_SESSION['UserGroup'] = mysql_result($result, 0, 'userlevel');
			// 成功登入, 前往 main.php
    		header("Location: control_center.php");
	  	}
  		else 
		{
		    // login_form.php的標題
			$_SESSION['login_form_title'] = "Invalid username or password";
		    // 重新登入, 前往login_form.php 
    		header("Location: ../login_form.php");
  		}
	}
	else
	{
	    // login_form.php的標題
		$_SESSION['login_form_title'] = "Invalid username or password";
		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
    	header("Location: ../login_form.php");
	}
}


?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Management Center</title>
<link href="../CSS/manacenter.css" rel="stylesheet" type="text/css" />
<script src="assets/js/jquery-3.1.1.min.js"></script>
</script> 
</head>
<body>


    <div id="logpart">
       
    <h3>STONE MANAGEMENT CENTER</h3>
        
    <div id="main">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginform">
    <label for="fname">Username:</label>
    <input name="username" id="username" type="text" size="12" maxlength="10"/>
            &nbsp;&nbsp;
    <label for="lname">Password:</label>
    <input name="password" id="password" type="password" size="12" maxlength="12" />
  
    <input type="submit" value="Sign In">
        </form>
    </div>
        
    </div>
    
 

</body>
</html>
