<link href="CSS/menu_top.css" rel="stylesheet" type="text/css" />
<script src="Spry/xpath.js" type="text/javascript"></script>
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
  var dsCategorySearch = new Spry.Data.XMLDataSet("xml/category_search.xml", "category/item");
//-->
</script>
<table class="menu_top_style1">
  <tr>
    <td class="menu_top_style2">
      <img src="photo/logo.jpg" alt="德瑞購物廣場" />
	  </td>
    <td class="menu_top_style3">
	    <table class="menu_top_style1">
        <tr>
          <td class="menu_top_style4">
            <table class="menu_top_style1">
              <tr>
                <td>&nbsp;                  
                </td>
                <td class="menu_top_style5">
                  <a href="freshman.php"><img src="photo/menu_top/freshman.jpg" alt="新手上路" class="menu_top_style6" /></a> 
                </td>
                <td class="menu_top_style5">
                  <a href="member_new.php"><img src="photo/menu_top/member_new.jpg" alt="加入會員" class="menu_top_style6" /></a>
                </td>
                <td class="menu_top_style5">
                  <a href="index.php"><img src="photo/menu_top/homepage.jpg" alt="網站首頁" class="menu_top_style6" /></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="menu_top_style4">
            <table class="menu_top_style1">
              <tr>
                <td>&nbsp;</td>
                <td class="menu_top_style7">
                  <a href="member_center.php"><img src="photo/menu_top/member_center.jpg" alt="會員中心" 
                    class="menu_top_style6" />
                  </a>
                </td>
                <td class="menu_top_style8">
                  <a href="order_step01.php"><img src="photo/menu_top/shop.jpg" alt="我的購物車" class="menu_top_style6" /></a> 
                </td>
                <td class="menu_top_style9">
                  <a href="item_add.php"><img src="photo/menu_top/book_add.jpg" alt="新增書籍資料" class="menu_top_style6" /></a>
                </td>
                <td class="menu_top_style10">
                  <a href="log_out.php"><img src="photo/menu_top/log_out.jpg" alt="登出" class="menu_top_style6" /></a>
                </td>             
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="menu_top_style4">
            <form action="search_result.php" method="post"> 
              <table class="menu_top_style1">
                <tr>
                  <td class="menu_top_style11">
                    <div spry:region="dsCategorySearch">
                      <select name="keyword_category" id="keyword_category" spry:repeatchildren="dsCategorySearch" 
                         class="menu_top_style12">
                        <option value="{itemname}" spry:if="{ds_RowNumber}==0" selected="selected">
                          {itemname}
                        </option>
                        <option value="{itemname}" spry:if="{ds_RowNumber}!=0">
                          {itemname}
                        </option>
                      </select>
                    </div>
                  </td>
                  <td class="menu_top_style13">
                    <input name="keyword" id="keyword" type="text" value="關鍵字" 
                      onclick="this.value=''" class="menu_top_style14" />
                    <input type="submit" value="尋找" />
                  </td>
                </tr>
              </table>            
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
