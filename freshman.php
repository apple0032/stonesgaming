<?php 
if (!isset($_SESSION)) {
  session_start();
}
// 前一個網頁
$_SESSION['PrevPage'] = "freshman.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::德瑞購物廣場::</title>
<link href="CSS/freshman.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- 載入上邊區塊 -->
<?php require_once("menu_top.php"); ?>
<table class="freshman_style1">
  <tr>
    <td class="freshman_style2">
      歡迎您光臨本站！
      <br /><br />
      德瑞購物廣場Online秉持著「供應全國最齊全的資訊圖書及軟體」的精神為您服務。
      <br /><br />
      <ul>
        <li>
          <span class="freshman_style4">
            簡單的購物流程
          </span>
          <br /> <br />
          <table class="freshman_style1">
            <tr>
              <td class="freshman_style3">
                step.1
              </td>
              <td>
                登入你的會員帳號(若無會員帳號可點選『加入會員』。
              </td>
            </tr>
            <tr>
              <td class="freshman_style3">
                step.2
              </td>
              <td>
                選定您中意的商品後，點選該商品名稱或圖片，即可將您要購買<br />的商品
                <span class="freshman_style4">
                  加入您的購物車
                </span>
                內。 
              </td>
            </tr>
            <tr>
              <td class="freshman_style3">
                step.3
              </td>
              <td>
                確認您的
                <span class="freshman_style4">
                  大名
                </span>
                  、
                <span class="freshman_style4">
                  送貨地址
                </span>
                  及
                <span class="freshman_style4">
                  金額
                </span>
                  等資料是否正確。
              </td>
            </tr>
            <tr>
              <td class="freshman_style3">step.4</td>
              <td>
                點選
                <span class="freshman_style4">
                 【購買】
                </span>
                鍵即可完成本次消費。
              </td>
            </tr>
          </table>
        </li>
        <br />
        <li>
          <span class="freshman_style4">
            安全及隱私
          </span>
          <br /><br />
          我們極重視安全及個隱私，我們率先使用128 bit SSL加密，並不留信用卡號。
          <br /> <br />
        </li>
        <li>
          <span class="freshman_style4">
            簡便的付款機制
          </span>
          <br /><br />
            我們目前提供數種付款方式以符合您的需要；
          <br /> 
          <span class="freshman_style5">
            》信用卡　　 》ATM轉帳　　 》銀行電匯　　 》郵政劃撥
          </span>
          <br />
          等，未來我們也將陸續增加更多樣的付款機制予您選擇。
          <br /> <br />
        </li>
        <li>
          <span class="freshman_style4">
            註冊為德瑞購物廣場Online會員
          </span>
          <br /><br />
            如果您要在此先登記為本站的購物會員，我們非常歡迎！並會不定期的通知您好康
          的購物訊息。<br /> <br />
        </li>
      </ul>
      <span class="freshman_style7">
        登記為 
        <a href="member_new.php" class="freshman_style8">
          德瑞購物廣場會員 》
        </a>
      </span>
    </td>
  </tr>
</table>
<!-- 載入下邊區塊 -->
<?php require_once("menu_bottom.php"); ?>
</body>
</html>