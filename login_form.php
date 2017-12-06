<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 建立 session
if (!isset($_SESSION)) {
  session_start();
}
// 前一個網頁
$_SESSION['PrevPage'] = "login_form.php";
?>
<?php
//*******************************//
// 登入
//*******************************//

// 有帳號與密碼欄位
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
    		header("Location: member_center.php");
	  	}
  		else 
		{
		    // login_form.php的標題
			$_SESSION['login_form_title'] = "Invalid username or password";
		    // 重新登入, 前往login_form.php 
    		header("Location: login_form.php");
  		}
	}
	else
	{
	    // login_form.php的標題
		$_SESSION['login_form_title'] = "Invalid username or password";
		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
    	header("Location: login_form.php");
	}
}
?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign in STONE</title>
<link href="CSS/member_center.css" rel="stylesheet" type="text/css" />
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/jquery.typeit/4.3.0/typeit.min.js">
</script>
</head>
<body>
<!-- 載入上邊區塊 -->
<div id="header"></div>
   <script>
$(document).ready(function(){
  
    $('#header').load('header.php');
  
})
</script>

<div id="form_title"> <?php echo $_SESSION['login_form_title']; ?> </div>
<div id="loginbox">
    <table>
        <tr>
            <td>  
    <div id="logpart">
        <?php
            if (!isset($_SESSION['Username'])) { ?>
    <h3>Sign in</h3>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="fname">Username</label>
    <input name="username" id="username" type="text" size="12" maxlength="10"/>

    <label for="lname">Password</label>
    <input name="password" id="password" type="password" size="12" maxlength="12" />

    <label for="country">State</label>
    <select id="country" name="country">
      <option value="australia">Hong Kong</option>
      <option value="australia">China</option>
      <option value="australia">Australia</option>
      <option value="canada">Canada</option>
      <option value="usa">USA</option>
      <option value="australia">Europe</option>
    </select>
  
    <input type="submit" value="Sign In">
  </form>
        <?php  }     else  { ?>
        
        Hi! <?php echo $_SESSION['Username']; ?>,  Welcome to STONE.
        
        <div id="logined">
        <p> Please take a look at out store now!</p>
        <a href="index.php" class="button">STORE</a>
        </div>
        <div id="gologout">
        <p> OR you can logout</p>
        <a href="log_out.php" class="button">LogOut</a>
        </div>
        
        
        <?php  }   ?>
        
        
    </div>
           </td>
        
            
    <td>      
    <div id="joinus">
        
    <div class="joinimg"></div>
   
    <P>It is free and easy to use STONE, Click to join us now!</P>
    <a href="member_new.php" class="button">Sign Up</a>
        
    </div>
    </td> 
        </tr>
    </table>    
</div>
    
    
    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
   <script>
$(document).ready(function(){
  
    $('#footer').load('footer.html');
  
})
</script>
</body>
</html>