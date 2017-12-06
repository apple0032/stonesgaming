<link href="CSS/menu_left.css" rel="stylesheet" type="text/css" />
<script src="Spry/xpath.js" type="text/javascript"></script>
<script src="Spry/SpryData.js" type="text/javascript"></script>
<script src="JavaScript/menu_left.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
  var dsCategory = new Spry.Data.XMLDataSet("xml/category.xml", "category/item");
//-->
</script>
<table class="menu_left_style1">
  <tr>
    <td class="menu_left_style2">
      <div spry:region="dsCategory">
        <table class="menu_left_style3">
          <tr spry:repeat="dsCategory" spry:setrow="dsCategory" 
            onclick="changeCategoryItem('{itemname}', '{list}');">
            <td class="menu_left_style2">
              <img src="photo/category/{itemname}.jpg" />
              <br />
              <div id="div{itemname}">
                <img src="photo/category/展開.jpg" />
              </div>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>