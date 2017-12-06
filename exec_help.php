<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php 
// 建立緩衝區
ob_start();
// 建立 session
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>忘記密碼</title>
<link href="CSS/exec_help.css" rel="stylesheet" type="text/css" />
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script src="JavaScript/exec_help.js" type="text/javascript"></script>
<?php
// 前往前一頁
if ($_POST['return'] == "yes") {
	header("Location: " . $_SESSION['PrevPage']);
}
?>
</head>
<body>
<!-- 載入上邊區塊 -->
<?php require_once("menu_top.php"); ?>
<table class="exec_help_style1">
  <tr>
	<td class="exec_help_style2">
	  <form method="post" onkeydown="if(event.keyCode==13) return false;">
        <table class="exec_help_style3">
          <tr>
            <td class="exec_help_style4">
              <span name="title" id="title">請填入您的帳號，我們會將密碼寄至電子信箱。</span>
	        </td>
          </tr>
          <tr>
            <td class="exec_help_style5">
			  <span class="exec_help_style6">
                帳號
				<input name="username" id="username" type="text" class="exec_help_style7" size="30" maxlength="10" />
              </span>
			</td>
          </tr>
          <tr>
            <td class="exec_help_style8">
			  <input type="submit" value="確認送出" onclick="return CheckFields();" />
              <input value="取消" type="button" class="exec_help_style9"
                onclick="document.location='<?php echo $_SESSION['PrevPage']; ?>'; return false;" />
			</td>
          </tr>
        </table>
        <input name="return" id="return" type="hidden" value="no" />
      </form>
    </td>
  </tr>
</table>
<!-- 載入下邊區塊 -->
<?php require_once("menu_bottom.php"); ?>
</body>
</html>
<?php 
ob_end_flush();
?>