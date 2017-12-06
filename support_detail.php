<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 
if (!isset($SESSION)) {
    session_start();
}

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>

<?php if (!isset($_SESSION['Username']))  header('Location: support.php')  ?>

<!----------- Display SUPPORT List ----------->
<?php
if (isset($_SESSION['Username'])){
 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query = sprintf("SELECT * FROM support WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));
$result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
{
    $row = mysql_fetch_assoc($result);
	$totalRows = mysql_num_rows($result);  
}
    
 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query2 = sprintf("SELECT * FROM support_reply WHERE support_id=%s ORDER BY datetime asc",
        GetSQLValue($row['id'],"text"));
$result2 = mysql_query($query2, $connection) or die(mysql_error());
    if ($result2)
{
	$totalRows2 = mysql_num_rows($result2);  
}
    
}
?>
<!----------------------------------------->
<!--------------- Again Form -------------->

<?php
if (isset($_POST["editor1"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	$query = sprintf("INSERT INTO support_reply  (support_id,username,content,datetime) VALUES ( %s, %s, %s, %s)",  
		GetSQLValue($row['id'], "int"),
        GetSQLValue($_SESSION['Username'], "text"),
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($datetime, "date"));
    
    $result = mysql_query($query, $connection);
    
    $query3 = sprintf("UPDATE support SET reply='no' WHERE id=%s",
              GetSQLValue($row['id'], "int"));
    $result3 = mysql_query($query3, $connection);

    if (($result) and ($result3)) {
		// 回到前一個網頁 
		header('Location: support.php');
        
	};
} 
?>
    <!---------------------------------------->

    <!--------------- End case -------------->

<?php
if (isset($_POST["end"]) ) 
{
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
    
	$query = sprintf("UPDATE support SET reply='deal' WHERE id=%s",  
        GetSQLValue($row['id'], "text"));
    
    $result = mysql_query($query, $connection);
    
    if ($result) {
		// 回到前一個網頁 
		header('Location: support.php');
        
	};
} 
?>

    <!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Support</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/support.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/support.js"></script>
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<script type="text/javascript">
    function CheckFields()
{
	var fieldvalue = document.getElementById("com_title").value;
	if (fieldvalue == "") 
	{
		alert("Please type a title !");
		document.getElementById("com_title").focus();
		return false;
	} ;
    
}
    </script>
<?php
  $bg = array('bg-01.png', 'bg-02.png','bg-03.png','bg-04.png','bg-05.png','bg-06.png','bg-07.png','bg-08.png','bg-09.png','bg-10.png' ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>
<style type="text/css">

body{
background: url(images/<?php echo $selectedBg; ?>) no-repeat;
background-size: cover;
background-attachment: fixed;　
background-size: cover;
}

</style>
</head>

<body>
<!-- 載入上邊區塊 -->
<div id="header"></div>
    
<section id="detail">
<div id="detail_main">
    
    
<div id="support_toppest">
<div id="support_toppest_title">Support - CASE-ID NO.  <?php echo $row['id'] ?> </div>
<div id="support_toppest_desc">Provide technical support , suggestion and solution for our user.  </div>
</div>    
    

    

<div id="support_more">
    
    <?php if (($_SESSION['Username']) == $row['username']){
    ?> 
    
    <div id="support_box">
        <div id="case_table_top">
        <b>[<?php echo $row['category']?>]&nbsp;&nbsp;
          <?php echo $row['title'] ?></b>
        <i> <?php echo $row['datetime'] ?> </i>
        </div>
        <table id="case_table_content">
            <tr>
                <td id="case_table_content1" style="vertical-align:top"><img src="images/user2.png"></td>
                <td id="case_table_content2" style="vertical-align:top"><?php echo $row['content'] ?></td>
            </tr>                  
        </table>

        <?php if($row['reply']=="yes") { ?> 
        
        <?php while($row2 = mysql_fetch_assoc($result2)) { ?>
        
        <table id="case_table_content">
            <tr>
                <td id="case_table_content1" style="vertical-align:top">
                    
                <?php if($row2['support'] !== "supporter"){ ?>  
                    <img src="images/user2.png">
                <?php } else { ?>
                    <img src="images/support2.png">Support
                <?php } ?>
                    
                </td>
                <td id="case_table_content2" style="vertical-align:top"><?php echo $row2['content'] ?>
                <div id="support_time"><?php echo $row2['datetime'] ?></div>
                </td>
            </tr>                  
        </table>

        <?php  }  ?>
                       
         <div id="again-form">
        <form method="post" id="post_form">
		
            <div id="post_topic">Do you solve your problem? Keep contact with us if not.</div>
			<textarea id="editor1" name="editor1" placeholder="Please state your problem."></textarea>
		
            <input type="submit" value="Submit" onclick="return CheckFields();"/>
            <input type="Reset" value="Reset"/>
	   </form>
             
             <form method="post" id="end_form">
                <input type="submit" name="end" value="End case"/>
                 Click if you solved your problem.
             </form>
       </div>                                
                                        
        <?php } else { ?> 
    
        <?php while($row2 = mysql_fetch_assoc($result2)) { ?>
        
      <table id="case_table_content">
            <tr>
                <td id="case_table_content1" style="vertical-align:top">
                    
                <?php if($row2['support'] !== "supporter"){ ?>  
                    <img src="images/user2.png">
                <?php } else { ?>
                    <img src="images/support2.png">Support
                <?php } ?>
                    
                </td>
                <td id="case_table_content2" style="vertical-align:top"><?php echo $row2['content'] ?>
                <div id="support_time"><?php echo $row2['datetime'] ?></div>
                </td>
            </tr>                  
        </table>
        <?php } ?>
        
        <div id="waitanswer">
Sorry! your case has been submitted to our supports, we will follow your case as soon as possible.
        </div>
        <div id="waitanswerbutton">
        <a href="support.php">BACK</a>
        </div> <br><br>

        <form method="post" id="end_form">
        <input type="submit" name="end" value="End case"/>
                 Click if you solved your problem.
        </form>
        
        <?php } ?>
        
    </div>
    
    <?php  } else { ?>  
    
    <div id="support_case_no">
    Sorry, You have no premission to view this content. <br><br>
    
    If you are the owner of this case, <a href="member_center.php">please login</a> as owner.
    
    </div>    
        
    <?php } ?>
    
</div>
    
</div>
</section>
   

<!-- 載入下邊區塊 -->
<div id="footer"></div>   
</body>
</html>
    