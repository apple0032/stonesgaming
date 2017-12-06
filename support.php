<?php 
    session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>
<!-------- READ MEMBER TABLE (CHECK PERMISSION)-------->
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
<!------------------------------------------>

<!----------- Display SUPPORT List ----------->
<?php
if (isset($_SESSION['Username'])){
 mysql_select_db('stonesga_ch30', $connection) or die('database error');
$query = sprintf("SELECT * FROM support WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));
$result = mysql_query($query, $connection) or die(mysql_error());
}
?>
<!------------------------------------------>
<!----------- Insert new SUPPORT ----------->

<?php
if (isset($_POST["editor1"]) ) 
{
    if (!isset($_SESSION['Username']))  header('Location: login_form.php');
    
	// 選擇 MySQL 資料庫ch26
	mysql_select_db('stonesga_ch30', $connection) or die('資料庫ch26不存在');	
	  
    $datetime = date ("Y-m-d H:i:s" , mktime(date('H')+7, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
    
	// 在member資料表內插入一筆新的紀錄
	$query = sprintf("INSERT INTO support (username,title,category,content,datetime) VALUES ( %s, %s, %s, %s, %s)",  
		GetSQLValue($_SESSION['Username'], "text"),
        GetSQLValue($_POST['com_title'], "text"),
        GetSQLValue($_POST['fCity'], "text"),
		GetSQLValue($_POST['editor1'], "text"),
        GetSQLValue($datetime, "date"));
    
	// 傳回結果集
	$result = mysql_query($query, $connection);

    if ($result)  {
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
<div id="support_toppest_title">Support
</div>
<div id="support_toppest_desc">Provide technical support , suggestion and solution for our user.  
<?php if (isset($_SESSION['Username'])){
   if($row5['unititle'] == "admin") { ?>  
    <div id="gmlogin">
    <a href="support_gm.php"><img src="images/gm-panel.png"></a>
    </div>
<?php } else {  ?>
    <div id="faq">
    <img src="images/faq.png">
    </div>
<?php } } else { ?>    
    <div id="faq">
    <img src="images/faq.png">
    </div>
<?php } ?>
</div>
</div>    
    
<div id="topbox_container">
    <div id="community_question">
        <div id="ques1" class="ques">
            <a href="#ques1">How to purchase my game and download?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
        <div id="ques2" class="ques">
            <a href="#ques2">How to connect and chat with others in game ?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
        <div id="ques3" class="ques">
            <a href="#ques3">You do not receive the game(s) after purchasing for 14 days?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
        <div id="ques4" class="ques">
            <a href="#ques4">Network problem occur when you are playing games?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
        <div id="ques5" class="ques">
            <a href="#ques5">You lose games in your store collection?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
        <div id="ques6" class="ques">
            <a href="#ques6">Other issues with your Stone account?</a>&nbsp;&nbsp;&nbsp;<img src="images/open_new2.png"></div>
    </div>
    
    <div id="answer1" class="answer-box">
        Answer: <br><br>
        First, you need to have a Stone's account to process the purchasing. If you don't, please register one. Then, you are required to fill in some of personal information and choose your payment method. Stone will handle the order and deliver your games in digital version and send a confirmation letter to your.<br><br>
        <div id="goback1" class="backbox">BACK</div>
    </div>  
    <div id="answer2" class="answer-box">
        Answer: <br><br>
        Stone provide a multiplayer platform for other user to play with other. You can also join Stone community to discuss with them and meet friend.<br><br>
        <div id="goback2" class="backbox">BACK</div>
    </div>
    <div id="answer3" class="answer-box">
        Answer: <br><br>
        First, Please make sure that you had successfully finished the payment. Then go to Stone collection to check that whether the game existed in the list or not. If you still find problems, please contact our support immediately.<br><br>
        <div id="goback3" class="backbox">BACK</div>
    </div>  
    <div id="answer4" class="answer-box">
        Answer: <br><br>
        This kind of problems depends on the user's network enviornment, Please check carefully your network setting and keep in touch with your ISP provider. Remember, restart your computer is always the best way to solve this case.<br><br>
        <div id="goback4" class="backbox">BACK</div>
    </div>
    <div id="answer5" class="answer-box">
        Answer: <br><br>
        Please check carefully and re-login to stone website. If you still find problems, please contact our support immediately.<br><br>
        <div id="goback5" class="backbox">BACK</div>
    </div>
    <div id="answer6" class="answer-box">
        Answer: <br><br>
        Please contact our support and provide specific information to us, we will help you to handle your problem as soon as possible.<br><br>
        <div id="goback6" class="backbox">BACK</div>
    </div>
</div> 
    

<div id="support_more">
    
    <?php if (isset($_SESSION['Username'])){
    
        $query2 = sprintf("SELECT * FROM support WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));
        $result2 = mysql_query($query2, $connection) or die(mysql_error());
        $row2 = mysql_fetch_array($result2);
    
    if((mysql_num_rows($result) !== 0) and ($row2['reply'] !== "deal" )){
    while ($row = mysql_fetch_array($result)) { ?>
    
    <div id="issue_table_title">This is your current issue table.</div>
     <?php $comment1 = $row['content'] ;
              $title = $row['title']
    ?>
<table class="responstable">
  
  <tr>
    <th>Case-ID</th>
    <th>Category</th>
    <th>Title</th>
    <th>Content</th>
    <th>Time</th>
    <th>Reply</th>
  </tr>
  
  <tr>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['category'] ?></td>
    <td><?php echo substr(($title),0, 40); ?> <?php if (strlen($title)>50){ echo "........" ;} ?></td>
    <td>
        <?php echo substr(($comment1),0, 50); ?> <?php if (strlen($comment1)>60){ echo "........" ;} ?>
    </td>
    <td><?php echo $row['datetime'] ?></td>
    <td>
        <div id="replyornot">
        <?php if(($row['reply']) == "no") { ?>
        <img src="images/reply_no.png">
        <?php } else { ?>
        <img src="images/reply_yes.png">
        <?php } ?>
        </div>
    </td>
  </tr>
  
</table>
    
    <div id="table_detail">
        
       Title : <?php echo $title ?> <br><br>
       Content : <?php echo $comment1 ?>
        
        <div id="table_detail_new">
            <a href="support_detail.php?id=<?php echo $row['id']?>"><img src="images/open_new2.png" class="tooltip" title="Open"></a></div>    
    </div>
    <?php } }  else { ?>
    
    
    <div id="support_more_desc">If the common problem above still not suit for you, contact our support here!</div>
    <div id="support_more_form">
    
        <form method="post" id="post_form">
		<p>
            <div id="post_topic">Topic & Category</div>
            <select id="fCity" name="fCity" placeholder="Category" autocomplete="off">
                <option value="Network">Network</option>
                <option value="Games">Games</option>
                <option value="Account">Account</option>
                <option value="Purchase">Purchase</option>
                <option value="Others">Others</option>
            </select>
            <input type="text" name="com_title" id="com_title" maxlength="100" placeholder="Title"><br><br>
			<textarea id="editor1" name="editor1" placeholder="Please state your problem."></textarea>
			
		</p>
		<p>  
            <input type="submit" value="Submit" onclick="return CheckFields();"/>
            <input type="Reset" value="Reset"/>
            <img src="images/support2.png">
		</p>
	   </form>
    
    <?php }  } else { ?>
    
    <div id="support_area">
    <img src="images/support-center.png"> 
    </div>
    <div id="support_area_desc">
    STONE support center provide 24/7 services.<br>
    We will follow the case immediately once any of case reported.<br>
    <i><a href="documentation-support.php">Click here</a></i> to learn more about our mechanism.
    </div>
    <?php } ?>
    
    </div>
</div>
    
    
</div>
</section>
   

<!-- 載入下邊區塊 -->
<div id="footer"></div>   
</body>
</html>
    
    
    
    
    
    
    
    
