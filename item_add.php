<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>
<?php require_once('member_new_cookie.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
//----------------------------------------------------
// 在 $_SESSION['database'] 資料表內插入一筆新的紀錄
//----------------------------------------------------
if ((isset($_POST["insert"])) && ($_POST["insert"] == "item_add")) 
{	
  // 設定 category 與 category_type 欄位
	$database = $_POST['database'];
	$index = strpos($database, " - ");	
	$_POST['category'] = substr($database, 0, $index);
	$_POST['category_type'] = substr($database, $index + 3);

  // 選擇 MySQL 資料庫ch30
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch30不存在');
  // 設定 publishdate 欄位
	$_POST['publishdate'] = $_POST['year'] . '-' . $_POST['month'] . '-' . "01";
	
  $query = sprintf("INSERT INTO " . $_SESSION['database'] . " (title, author, translator, contents, feature, cd, 
	  publishdate, price, discount, saleprice, item_index, photo, publisher, color, 
		category, category_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			 GetSQLValue(trim($_POST['title']), "text"),
			 GetSQLValue(trim($_POST['author']), "text"),
			 GetSQLValue(trim($_POST['translator']), "text"),
			 GetSQLValue(trim($_POST['contents']), "text"),
			 GetSQLValue(trim($_POST['feature']), "text"),
			 GetSQLValue(trim($_POST['cd']), "int"),
			 GetSQLValue(trim($_POST['publishdate']), "date"),
			 GetSQLValue(trim($_POST['price']), "int"),
			 GetSQLValue(trim($_POST['discount']), "int"),
			 GetSQLValue(trim($_POST['saleprice']), "int"),
			 GetSQLValue(trim($_POST['item_index']), "text"),
			 GetSQLValue(trim($_POST['photo']), "text"),
			 GetSQLValue(trim($_POST['publisher']), "text"),
			 GetSQLValue(trim($_POST['color']), "int"),
			 GetSQLValue(trim($_POST['category']), "text"),
			 GetSQLValue(trim($_POST['category_type']), "text"));

  $result = mysql_query($query, $connection) or die(mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增書籍資料</title>
<link href="CSS/item_add.css" rel="stylesheet" type="text/css" />
<script src="Spry/xpath.js" type="text/javascript"></script>
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script src="JavaScript/item_add.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
  var dsItems = new Spry.Data.XMLDataSet("xml/items.xml", "items/item");
  var dsPublisher = new Spry.Data.XMLDataSet("xml/publisher.xml", "companies/company");
//-->
</script>
</head>
<body>
<!-- 載入上邊區塊 -->
<?php require_once("menu_top.php"); ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onkeydown="if(event.keyCode==13) return false;"> 
  <table class="item_add_style1">
    <tr>
      <td class="item_add_style2">
        <span class="item_add_style3">
          新增書籍資料
        </span>
      </td>
    </tr>
    <tr>
      <td>
        <table class="item_add_style4">
          <tr>
            <td class="item_add_style5">
              <span class="item_add_style6">
                資&nbsp;&nbsp;料&nbsp;&nbsp;庫
              </span>
            </td>
            <td>
              <div spry:region="dsItems">
                <select name="database" id="database" spry:repeatchildren="dsItems" class="item_add_style10" 
                  onchange="dsItems.setCurrentRowNumber(this.selectedIndex);">
                  <option value="{text}" 
                    spry:if="{ds_RowNumber}=={ds_CurrentRowNumber}" selected="selected">{text}</option>
                  <option value="{text}"                      
                    spry:if="{ds_RowNumber}!={ds_CurrentRowNumber}">{text}</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                書籍編號
              </span>
            </td>
            <td class="item_add_style9">
              <input name="item_index" id="item_index" type="text" size="70" maxlength="10" class="item_add_style10" 
                value="<?php echo $_COOKIE['item_index']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                標　　題
              </span>
            </td>
            <td class="item_add_style9">
              <input name="title" id="title" type="text" size="70" class="item_add_style10" 
                value="<?php echo $_COOKIE['title']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                作　　者
              </span>
            </td>
            <td class="item_add_style9">
              <input name="author" id="author" type="text" size="70" class="item_add_style10" 
                value="<?php echo $_COOKIE['author']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                譯　　者
              </span>
            </td>
            <td class="item_add_style9">
              <input name="translator" id="translator" type="text" size="70" class="item_add_style10" 
                value="<?php echo $_COOKIE['translator']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                目　　錄
              </span>
            </td>
            <td class="item_add_style9">
              <textarea name="contents" id="contents" cols="60" rows="4" class="item_add_style10"> 
                <?php echo $_COOKIE['contents']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                特　　色
              </span>
            </td>
            <td class="item_add_style9">
			        <textarea name="feature" id="feature" cols="60" rows="4" class="item_add_style10"> 
                <?php echo $_COOKIE['feature']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                C　　&nbsp;&nbsp;&nbsp;D
              </span>
            </td>
            <td class="item_add_style9">
              <input name="cd" id="cd" type="radio" value="1" checked="checked" />
                &nbsp;有&nbsp;
              <input name="cd" id="cd" type="radio" value="0" />
                &nbsp;沒有
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                出版日期
              </span>
            </td>
            <td class="item_add_style9">
              <input name="year" id="year" type="text" size="6" maxlength="4" 
                value="<?php echo date("Y", time()); ?>" />
                &nbsp;年&nbsp;
                <select name="month" id="month">
                <?php
                for ($i = 1; $i <= 12; $i++)
								{
									$month = date("n", time());
									if ($month == $i)
									{
								?>
                  <option value="<?php echo $i ?>" selected="selected">
                    &nbsp;&nbsp;<?php echo $i ?>&nbsp;
                  </option>         
								<?php
                  }	else {
								?>
              ?>
                  <option value="<?php echo $i ?>">
                    &nbsp;&nbsp;<?php echo $i ?>&nbsp;
                  </option>         
							<?php
									}
                }
							?>
              </select>
              &nbsp;月&nbsp;&nbsp;（請填入西元年, 例如 2011)
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                定　　價
              </span>
            </td>
            <td class="item_add_style9">
              <input name="price" id="price" type="text" size="10" maxlength="10" class="item_add_style10" 
                value="<?php echo $_COOKIE['price']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                折　　扣
              </span>
            </td>
            <td class="item_add_style9">
              <input name="discount" id="discount" type="text" size="10" maxlength="10" class="item_add_style10" 
                value="<?php echo $_COOKIE['discount']; ?>" />
                &nbsp;%
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                售　　價
              </span>
            </td>
            <td class="item_add_style9">
              <input name="saleprice" id="saleprice" type="text" size="10" maxlength="10" class="item_add_style10" 
                value="<?php echo $_COOKIE['saleprice']; ?>" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                彩&nbsp;&nbsp;色&nbsp;&nbsp;書
              </span>
            </td>
            <td class="item_add_style9">
              <input name="color" type="radio" value="1" />
                &nbsp;是&nbsp;
              <input name="color" type="radio" value="0" checked="checked" />
                &nbsp;不是
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                封面照片
              </span>
            </td>
            <td class="item_add_style9">
              <input name="photo" type="file" id="photo" size="70" />
            </td>
          </tr>
          <tr>
            <td class="item_add_style7">
              <span class="item_add_style8">
                出版公司
              </span>
            </td>
            <td class="item_add_style9">
              <div spry:region="dsPublisher">
                <select name="publisher" spry:repeatchildren="dsPublisher"                    
                  onchange="setCurrentRowNumber(this.selectedIndex);">
                  <option value="{short}" 
                    spry:if="{ds_RowNumber} == 0" selected="selected">{short}</option>
                  <option value="{short}"                      
                    spry:if="{ds_RowNumber} > 0">{short}</option>
                </select>
              </div>
           </td>
         </tr>
       </table>
     </td>
   </tr>
   <tr>
     <td class="item_add_style11">
       <table class="item_add_style12">
         <tr>
           <td class="item_add_style2">
             <input type="submit" value="確定送出" onclick="return CheckFields();" />
             <input type="button" value="取消" class="item_add_style15" 
               onclick="document.location='<?php echo $_SESSION['PrevPage']; ?>'; return false;" />
           </td>
          </tr>
        </table> 
      </td>
    </tr>
  </table> 
  <input name="publishdate" type="hidden" />
  <input name="category" type="hidden" />
  <input name="category_type" type="hidden" />        
  <input name="insert" id="insert" type="hidden" value="item_add" />        
</form>
<!-- 載入下邊區塊 -->
<?php require_once("menu_bottom.php"); ?>
</body>
</html>