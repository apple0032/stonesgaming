<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 建立 session
if (!isset($_SESSION)) {
  session_start();
}
// 前一個網頁
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF'];
?>

<!-------- READ MEMBER TABLE FIRST -------->
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
<!----------------------------------------->

<?php
//*******************************//
// 登入
//*******************************//
// login_form.php的標題
$_SESSION['login_form_title'] = "Please Login.";

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
	$result = mysql_query($query, $connection) or die(mysql_error());
	
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
			// 重新登入, 前往login_form.php 
			header("Location: login_form.php");
		}
	}
	else
	{		
		// 無效的帳號或密碼, 重新登入, 前往login_form.php 
		header("Location: login_form.php");
	}
}
?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Center</title>
<link href="CSS/member_center.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- 載入上邊區塊 -->
<div id="header"></div>
   <script>
$(document).ready(function(){
  
    $('#header').load('header.php');
  
})
</script>

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
        
        <div id="member_info">
        
            <a href="profile.php?username=<?php echo $row5['username']?>"><img src="images/member_summary.png" class="tooltip" title="View your profile"></a>
            
        </div>
            
        <div id="logined">
            
        <div id="user_detail">
        <div id="user_top"><?php echo $row5['username'] ?></div>
        <div id="user_image"><img src="images/user/<?php echo $row5['photo']?>"></div>
        <div id="user-title"> <?php echo $row5['unititle'] ?> </div>
        <div id="user_join">Join : <?php echo substr(($row5['datejoin']), 0,10); ?></div>
        <div id="profile"><a href="profile.php?username=<?php echo $row5['username']?>" class="logoutbut">Profile</a></div>
        <div id="user_logout"><a href="log_out.php" class="logoutbut">Logout</a></div>
            
            
        </div>    
            
        </div>
        
        <?php if($_SESSION['UserGroup']==99) { ?> 
        
        <div id="root">
        <a href="management/control_center.php" id="admin_fun">
        <img src="images/modify.png">
        </a>
        </div>
                
        <?php } ?>
        
        <?php  }   ?>
        
   
        
        
    </div>
           </td>
        
            
    <td>      
    <div id="joinus">
        
    <?php
            if (!isset($_SESSION['Username'])) { ?>    
    <div class="joinimg"></div>
   
    <P>It is free and easy to use STONE, Click to join us now!</P>
    <a href="member_new.php" class="button">Sign Up</a>
    </div>
        <?php  }   else  {?>
        
        <div id="welcome">Welcome back , <?php echo $row5['username'] ?> </div><br>
        
        
        <div id="logined2">
            View and manage your shopping chart </br>
        <a href="order_step01.php" class="button2"><img src="images/shop.png">Shopping Cart</a>
        </div>
    
        <div id="gologout2">
        Modify your personal information</br>
        <a href="member_info.php" class="button2"><img src="images/member_info.png">Update Info</a>
        </div>
        
        <div id="member_community">
        Join COMMUNITY</br>
        <a href="community.php" class="button3"><img src="images/chatting.png">COMMUNITY</a>
        </div>
        
    
        <div id="member_support">
        Want technical support?</br>
        <a href="support.php" class="button3"><img src="images/support2.png">Support</a>
        </div>
        
    
    
        <?php  }   ?>
        
        
    
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