<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 建立 session
if (!isset($_SESSION)) {
  session_start();
}
// 尚未登入
if (!isset($_SESSION['Username'])) {
  header('Location: member_center.php');
}
?>
<?php
//**********************************//
// 顯示member資料表的目前紀錄
//**********************************//
$username = "-1";
if (isset($_SESSION['Username'])) {
  $username = $_SESSION['Username'];
}

// 選擇 MySQL 資料庫ch30
mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');
// 查詢目前帳號的紀錄
$query = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($username, "text"));

// 傳回結果集
$result = mysql_query($query, $connection);
// 讀取目前帳號的紀錄
if ($result) {
	$row = mysql_fetch_assoc($result);
}
else {
	header('Location: index.php');
}
?>
<?php
//**********************************//
// 更新在member資料表內的一筆紀錄
//**********************************//
if ((isset($_POST["update"])) && ($_POST["update"] == "member_info")) 
{
    // 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');	
	// 新的帳號
	$_SESSION['Username'] = $_POST['username'];
	
	// 在member資料表內插入一筆新的紀錄
    $query = sprintf("UPDATE member SET username=%s, password=%s, name=%s, sex=%s, birthday=%s, email=%s, phone=%s, address=%s, uniform=%s, unititle=%s, userlevel=%s WHERE id=%s", GetSQLValue($_POST['username'], "text"), 
	GetSQLValue($_POST['password'], "text"), GetSQLValue($_POST['name'], "text"), GetSQLValue($_POST['sex'], "text"), 
	GetSQLValue($_POST['birthday'], "date"), GetSQLValue($_POST['email'], "text"), GetSQLValue($_POST['phone'], "text"), 
	GetSQLValue($_POST['address'], "text"), GetSQLValue($_POST['uniform'], "text"), GetSQLValue($_POST['unititle'], "text"),
	GetSQLValue($_POST['userlevel'], "int"), GetSQLValue($_POST['id'], "int"));

	// 傳回結果集
    $result = mysql_query($query, $connection);
  // 回到前一個網頁 
	if ($result) {
	  	header(sprintf("Location: %s", $_SESSION['PrevPage']));
	}
}
?>
<?php 
// 取得這筆紀錄的 birthday 欄位值
$date = getdate(strtotime($row['birthday']));
// 設定 [年],[月],[日] 欄位
$year = $date['year'];
$month = $date['mon'];
$day = $date['mday'];
?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Information</title>
<link href="CSS/member_new.css" rel="stylesheet" type="text/css"/>
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="JavaScript/member_info.js" type="text/javascript"></script>
</head>
<body>

<div id="header"></div>
 
<div id="loginbox">
    <div id="register">
        <h2>Update your information</h2>
        <table>
  <tr>
    <td>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onkeydown="if(event.keyCode==13) return false;"> 
	    <table>
          <tr>
            <td>
              <div id="register_notice2">
              Notice
              <br /><br />
              <ul>
                <li>You are <B>not allowed</B> to modify your username
                <li>Please double check you information,the old infomation will be destroyed once you clicked <B>Update</B></li>
              </ul>
              </div>
            </td>
          </tr>
          <tr>
            <td>
        	  <table id="register_main">
               <tr>
                 <td>
                   <h4>Username</h4>                 
                 </td>
                 <td>
                    <div id="update_no">
                   <input name="username" id="username" type="text" size="10" maxlength="10" 
                     value="<?php echo $row['username']; ?>" readonly />
                     <span></span>   
                    </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>Password</h4>
                 </td>
                <td>
                   <input name="password" id="password" type="password" size="20" maxlength="12" 
                     value="<?php echo $row['password']; ?>" />
                     <span>*</span>&nbsp&nbsp&nbsp&nbsp(6-12 characters including number)
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     Full Name
                   </h4> 
                 </td>
                 <td>
                   <input name="name" id="name" type="text" size="20" maxlength="40" 
                     value="<?php echo $row['name']; ?>" />
                     <span>*</span>
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     Gender
                   </h4> 
                 </td>
                 <td>    
                   
                     
                <div>
    <label class="demo--label">
        <input class="demo--radio" type="radio" name="sex" value="M" />
        <span class="demo--radioInput"></span>male
    </label>
    <label class="demo--label">
        <input class="demo--radio" type="radio" name="sex" value="F" checked="checked"/>
        <span class="demo--radioInput"></span>female
    </label>
                </div>
                               
                     
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     E-mail
                   </h4> 
                 </td>
                 <td>
                   <input name="email" id="email" type="text"  size="40" maxlength="40" 
                     value="<?php echo $row['email']; ?>" />
                     <span>*</span>
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     Birthday
                   </h4> 
                 </td>
                 <td>
                   <input name="year" id="year" type="text"  size="6" maxlength="4" 
                     value="<?php echo $year; ?>" />
                     &nbsp;年&nbsp;
                   <!-- 在選單中填入[出生日期]的[月]欄位值 -->
	               <select name="month" id="month">
                   <?php
		             for ($i = 1; $i <= 12; $i++)
		             {
		           ?>
                     <option value="<?php echo $i ?>" 
              		  <?php 
					    if (!empty($_COOKIE['month']))
						{
						  if ($i == $_COOKIE['month'])
						  {
						    echo "selected=\"selected\"";
						  }
						} 
					  ?>>
                      &nbsp;&nbsp;<?php echo $i ?>&nbsp; 
                     </option>         
                   <?php
                     }
		           ?>
                   </select>
                     &nbsp;月&nbsp;&nbsp;
		           <select name="day" id="day">                   
                   <!-- 在選單中填入[出生日期]的[日]欄位值 -->
                   <?php
		             for ($i = 1; $i <= 31; $i++)
		             {
		           ?>
                     <option value="<?php echo $i ?>" 
					   <?php 
					    if (!empty($_COOKIE['day']))
						{
						  if ($i == $_COOKIE['day'])
						  {
						    echo "selected=\"selected\"";
						  }
						}
					   ?>>
                       &nbsp;&nbsp;<?php echo $i ?>&nbsp;&nbsp; 
                     </option>         
                   <?php
                     }
		           ?>
                   </select>
                   &nbsp;日&nbsp;&nbsp;
                   <span>*</span>
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     Contact no.
                   </h4> 
                 </td>
                 <td>
                   <input name="phone" id="phone" type="text"  size="20" maxlength="15" 
                     value="<?php echo $row['phone']; ?>" />
                     <span>*</span>  
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>
                     Recipient Address  
                   </h4> 
                 </td>
                 <td>
                   <input name="address" id="address" type="text"  size="45" maxlength="120"
                     value="<?php echo $row['address']; ?>" />
                     <span>*</span> 
                 </td>
               </tr>
		       <tr id="hideit">
                 <td>
                   <span>
                     統一編號
                   </span> 
                 </td>
                 <td>
                   <input name="uniform" id="uniform" type="text" size="40" maxlength="20"
                     value="" />
                 </td>
               </tr>
		       <tr id="hideit">
                 <td>
                   <span>
                     發票抬頭
                   </span>
                 </td>
                 <td>
                   <input name="unititle" id="unititle" type="text" size="40" maxlength="40"
                     value="<?php echo $row['unititle']; ?>" />
                 </td>
               </tr>
             </table>
           </td>
         </tr>
         <tr>
           <td>
             <table id="register_submit2">
               <tr>
                 <td>
                   <input type="submit" value="Update" onclick="return CheckFields();" />
                   <input type="button" value="Cancel" 
                   	 onclick="document.location='<?php echo $_SESSION['PrevPage']; ?>'; return false;" />
                 </td>
               </tr>
             </table> 
           </td>
         </tr>
       </table> 
	   <input name="userlevel" id="userlevel"type="hidden" value="<?php echo $row['userlevel']; ?>" />
         <input name="birthday" id="birthday" type="hidden" value="<?php echo $row['birthday']; ?>" />
         <input name="id" id="id" type="hidden" value="<?php echo $row['id']; ?>" />
       <input name="old_username" id="old_username" type="hidden" value="<?php echo $row['username']; ?>" />
         <input name="update" id="update" type="hidden" value="member_info" />

	  </form>
    </td>
 </tr>
</table>
    </div>
</div>
    
<div id="footer"></div>
<script>
$(document).ready(function(){
  
    $('#footer').load('footer.html');
  
})
</script>
</body>
</html>s
    
    
    
<?php
// 釋放結果集
mysql_free_result($result);
?>