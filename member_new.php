<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php
// 建立 session
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['Username'])  ) {
  header('Location: store.php');
}

?>
<?php
//-----------------------------------------
// 在member資料表內插入一筆新的紀錄
//-----------------------------------------

if ((isset($_POST["insert"])) && ($_POST["insert"] == "member_new")) 
{
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO member (username, password, name, sex, birthday, email, phone, address, uniform, unititle, userlevel,photo,datejoin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
		GetSQLValue(strtolower($_POST['username']), "text"), 
		GetSQLValue($_POST['password'], "text"), 
		GetSQLValue($_POST['name'], "text"), 
		GetSQLValue($_POST['sex'], "text"), 
		GetSQLValue($_POST['birthday'], "date"), 
		GetSQLValue($_POST['email'], "text"), 
		GetSQLValue($_POST['phone'], "text"), 
		GetSQLValue($_POST['address'], "text"), 
		GetSQLValue($_POST['uniform'], "text"), 
		GetSQLValue($_POST['unititle'], "text"),
		GetSQLValue($_POST['userlevel'], "int"),
        GetSQLValue($_POST['photo'], "text"),
        GetSQLValue($datetime, "date")            
                    );
	
	// 傳回結果集
	$result = mysql_query($query, $connection);

	if ($result) {
    $_SESSION['login_form_title'] = "Done. Please login";
		header('Location: login_form.php');
	}
}
?>
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Join STONE</title>
<link href="CSS/member_new.css" rel="stylesheet" type="text/css"/>
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="JavaScript/member_new.js" type="text/javascript"></script>
</head>
<body>
<div id="header"></div>
 
<div id="loginbox">
    <div id="register">
        <h2>Create an Account</h2>
        <table>
  <tr>
    <td>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onkeydown="if(event.keyCode==13) return false;"> 
	    <table>
          <tr>
            <td>
              <div id="register_notice">
              Notice
              <br /><br />
              <ul>
                <li>Please be sure to fill in the following information correctly.
                <li>* means essential information that you <B>MUST</B> fill in.</li>
                <li>We will send you a confirmation letter to your email address.</li>
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
                   <input name="username" id="username" type="text" size="20" maxlength="10" 
                     value="" />
                     <span>*</span>                 
                 </td>
               </tr>
               <tr>
                 <td>
                   <h4>Password</h4>
                 </td>
                <td>
                   <input name="password" id="password" type="password" size="20" maxlength="12" 
                     value="" />
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
                     value="" />
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
                     value="" />
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
                     value="" />
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
                     value="" />
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
                     value="" />
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
                     value="member" />
                 </td>
                <td>
                   <input name="photo" id="photo" type="text"
                     value="user.png" />
                 </td>
               </tr>
             </table>
           </td>
         </tr>
         <tr>
           <td>
             <table id="register_submit">
               <tr>
                 <td>
                   <input type="submit" value="Submit" onclick="return CheckFields();" />
                   <input type="button" value="Cancel" 
                   	 onclick="document.location='main'; return false;" />
                 </td>
               </tr>
             </table> 
           </td>
         </tr>
       </table> 
	   <input name="userlevel" id="userlevel" type="hidden" value="0" />
       <input name="birthday" id="birthday" type="hidden" />
	   <input name="insert" id="insert" type="hidden" value="member_new" />
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
</html>