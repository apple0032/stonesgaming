<?php
  session_start();
?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 

$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>

<!-------- READ MEMBER TABLE -------->
<?php 

    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_GET['username'],"text"));

    $result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
    {$row = mysql_fetch_assoc($result);} ;
    
?>
<!----------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title><?php echo $row['username'] ?>'s Profile</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/profile.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/jBox.min.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
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

<div id="mainbox">

<div id="user_detail">
    <div id="user_top"><?php echo $row['username'] ?></div>
    
    
    <?php 
        if (isset($_SESSION['Username'])
        AND ($_SESSION['Username']) == ($row['username'])) { ?>
        <div id="user_image">
        <a href=""><img src="images/user/<?php echo $row['photo']?>"></a>
        </div>
        <div id="btn">Upload Image</div>
    
    <?php  } else { ?>
       
     <div id="user_image"><img src="images/user/<?php echo $row['photo']?>"></div>
        
    <?php  }
    ?>
    <div id="user-title"> <?php echo $row['unititle'] ?> </div>
    <div id="user_info">
    
    Name : <i><?php echo $row['name'] ?></i> <br>
    
    Date of join : <i><?php echo substr(($row['datejoin']), 0,10); ?></i><br>
    
    <?php 
    $query2 = sprintf("SELECT DISTINCT(item_name) FROM order_detail WHERE username = %s GROUP BY item_name DESC", GetSQLValue($row['username'], "text"));
    $result2 = mysql_query($query2, $connection) or die(mysql_error());
if ($result2)
{   
    $totalRows2 = mysql_num_rows($result2);
}
    ?>
    
    Games owned : <i><?php echo $totalRows2 ?></i> <br>
     
    <?php 
    $query3 = sprintf("SELECT * FROM order_list WHERE username = %s", GetSQLValue($row['username'], "text"));
    $result3 = mysql_query($query3, $connection) or die(mysql_error());
if ($result3)
{   
    $totalRows3 = mysql_num_rows($result3); 
    $sum=0; 
    while($row3 = mysql_fetch_assoc($result3)) {
        $value = $row3['order_price'];
        $sum += $value;
    }}
?>
        
    Total Spend : <i>$<?php echo $sum ?></i> <br>
    Community Points : <i><?php echo $row['point'] ?></i><br>
    
    <?php 
    $query_3 = sprintf("SELECT * FROM order_list WHERE username = %s ORDER BY order_date DESC LIMIT 1" , GetSQLValue($row['username'], "text"));
    $result_3 = mysql_query($query_3, $connection) or die(mysql_error());
    if ($result_3)
{   
    {$row_3 = mysql_fetch_assoc($result_3);} ;
}
    ?>    
        
        
    Last Pruchase : <i><?php echo $row_3['order_date'] ?></i> <br>
        
    Total Friends : 
    
    <?php $query8x = sprintf("SELECT * FROM friendship WHERE myid = %s OR myfriends = %s", GetSQLValue($row['username'], "text"),GetSQLValue($row['username'], "text"));
        $result8x = mysql_query($query8x, $connection) or die(mysql_error());
    if ($result8x)
{   
    $totalRows8x = mysql_num_rows($result8x);
    $row8x = mysql_fetch_array($result8x);
    }  ; ?>
        
        <i> <?php echo $totalRows8x ?> </i><br>
        
    <?php 
    if (isset($_SESSION['Username'])) {
    $query8y = sprintf("SELECT * FROM request WHERE sender = %s AND receiver = %s", GetSQLValue($_SESSION['Username'], "text"),GetSQLValue($row['username'], "text"));
        $result8y = mysql_query($query8y, $connection) or die(mysql_error());
    if ($result8y)
{   
    $totalRows8y = mysql_num_rows($result8y);
    $row8y = mysql_fetch_array($result8y);
    }  ; }?>
    
    <?php if (isset($_SESSION['Username'])) {   //睇下有冇Login
        if (($_SESSION['Username']) !== ($row['username'])) {  //睇下是否自己
            
     $query8w = sprintf("SELECT * FROM friendship WHERE myid = %s AND myfriends = %s OR myid = %s AND myfriends = %s", 
            GetSQLValue($row['username'], "text"),
            GetSQLValue($_SESSION['Username'], "text"),
            GetSQLValue($_SESSION['Username'], "text"),
            GetSQLValue($row['username'], "text"));
        $result8w = mysql_query($query8w, $connection) or die(mysql_error());
    if ($result8w)
{   
    $totalRows8w = mysql_num_rows($result8w);
    $row8w = mysql_fetch_array($result8w);
    }  ; 
        
    if($totalRows8w !== 0){         
    
    if  ( $row8w['myfriends'] == $_SESSION['Username']) { ?>
        
        <div id="request_fd">
        <a href="friend-unfriend.php?myid=<?php echo $row['username'] ?>">    
            UnFriend
        </a></div>  
    <?php } else if  ( $row8w['myid'] == $_SESSION['Username']) {  ?> 

        <div id="request_fd">
        <a href="friend-unfriend.php?myfriends=<?php echo $row['username'] ?>">
            UnFriend
        </a></div>
    
    <?php } } else if ($totalRows8y !== 0 ) { ?>    
        
        <div id="request_pend">Friend Pending</div>
    
    <?php } else { ?>
        
        <div id="request_fd">
        <a href="friend-add.php?receiver=<?php echo $row['username'] ?>">Freind Request</a>
        </div>
        
   <?php } } }?>
        
    </div>
</div> 
    
<!------------------------------------------------------>

<div id="user_detail2">
 
<div id="user_collection">

<?php echo $row['username'] ?>'s games - <br>

<div id="user_collection_box">
<?php   
    
if($totalRows2 !=0 ) {
while($row2 = mysql_fetch_array($result2)) { 
    
$query4 = sprintf("SELECT * FROM computer_books WHERE title = %s ", GetSQLValue($row2['item_name'], "text"));
$result4 = mysql_query($query4, $connection) or die(mysql_error());
if ($result4)
{   
    $totalRows4 = mysql_num_rows($result4);
    $row4 = mysql_fetch_array($result4);
    } ?>

<div id="user_game">
<a href="item_detail.php?pro_id=<?php echo $row4['id']?>"><img src="photo/item/<?php echo $row4['photo']?>"></a>
</div>

<?php } } else { ?>
    <br>
    No any purchasing activity.
    
<?php } ?>

</div> <!-- user_collection_box -->
</div> <!-- user_collection -->  
    
    
<div id="user_community_post">
    
    <?php echo $row['username'] ?>'s post in community - 
    
   <div id="user_community_post_box">
    
    <table id="post_title">
        <tr>
        <td><div id="post_title_title">Topic (↑) </div></td>
        <td><div id="post_title_like">Like  </div></td>
        <td><div id="post_title_dislike">Dislike </div></td>
        </tr>
       
       
    <?php $query5 = sprintf("SELECT * FROM community WHERE username = %s ORDER BY datetime DESC limit 6", GetSQLValue($row['username'], "text"));
    $result5 = mysql_query($query5, $connection) or die(mysql_error());
if ($result5)
{   
    $totalRows5 = mysql_num_rows($result5);
    } 
    if($totalRows5 !=0 ) {
    while( $row5 = mysql_fetch_array($result5)) { ?>
        <tr>
        <td><a href="community_detail.php?id=<?php echo $row5['id'] ?>"><?php echo $row5['title'] ?></a> </td>
        <td style="text-align:center"><?php echo $row5['love'] ?></td>
        <td style="text-align:center"><?php echo $row5['dislove'] ?></td>
        </tr>

<?php  } } else { ?>
       </table>
       <br>
       <div id="no_post">No any post in community.</div>
        
        
<?php } ?>
       </table>
    </div> <!-- user_community_post -->
</div> <!-- user_community_post_box -->
    

<div id="user_community_post">
    
    <?php echo $row['username'] ?>'s reply in community - 
    
   <div id="user_community_post_box">
    
    <table id="post_title">
        <tr>
        <td><div id="post_title_title">Reply Topic (↑) </div></td>
        </tr>
       
       
    <?php $query6 = sprintf("SELECT DISTINCT(topic) FROM community_reply WHERE username = %s ORDER BY datetime DESC limit 5", GetSQLValue($row['username'], "text"));
    $result6 = mysql_query($query6, $connection) or die(mysql_error());
    if ($result6)
{   
    $totalRows6 = mysql_num_rows($result6);
    }  ;
    
    if ($totalRows6 !=0 ) {
    while( $row6 = mysql_fetch_array($result6)) { 
        
     $query_6 = sprintf("SELECT * FROM community WHERE title = %s ORDER BY datetime DESC limit 5", GetSQLValue($row6['topic'], "text"));
    $result_6 = mysql_query($query_6, $connection) or die(mysql_error());
    if ($result_6)
{   
    $row_6 = mysql_fetch_array($result_6);
    } 
        
        ?>
        <tr>
        <td><a href="community_detail.php?id=<?php echo $row_6['id'] ?>"><?php echo html_entity_decode($row6['topic']) ?></a> </td>
        </tr>

<?php  } } else { ?>
        </table>
       <br>
       <div id="no_post">No any post in community.</div>

<?php } ?>
       </table>
    </div> <!-- user_community_post -->
</div> <!-- user_community_post_box -->
    
<div id="friend_list">
    <?php echo $row['username'] ?>'s friends
    
<div id="friend_listbox">
        <?php $query8 = sprintf("SELECT * FROM friendship WHERE myid = %s OR myfriends = %s ORDER BY id DESC", GetSQLValue($row['username'], "text"),GetSQLValue($row['username'], "text"));
        $result8 = mysql_query($query8, $connection) or die(mysql_error());
    if ($result8)
{   
    $totalRows8 = mysql_num_rows($result8);
    }  ; ?>
    <?php if($totalRows8 !== 0) {
     while( $row8 = mysql_fetch_array($result8)) { ?>
        
    <?php if ($row8['myfriends'] == $row['username']) { 
    
    $query8a = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($row8['myid'], "text"));
        $result8a = mysql_query($query8a, $connection) or die(mysql_error());
     if($result8a){$row8a = mysql_fetch_array($result8a);};
    ?>
    
    <div class="firnedbox"> 
    <a href="profile.php?username=<?php echo $row8a['username'] ?>" target="_blank"><img src="images/user/<?php echo $row8a['photo']?>"/> <br> 
    <i><?php echo $row8a['username'] ?> </i></a>
    
    </div>  
    
    <?php } ?>
    
    
    <?php if ($row8['myfriends'] !== $row['username']) { 
    
    $query8b = sprintf("SELECT * FROM member WHERE username = %s", GetSQLValue($row8['myfriends'], "text"));
        $result8b = mysql_query($query8b, $connection) or die(mysql_error());
     if($result8b){$row8b = mysql_fetch_array($result8b);};
    ?>
    
    <div class="firnedbox"> 
    <a href="profile.php?username=<?php echo $row8b['username'] ?>" target="_blank"><img src="images/user/<?php echo $row8b['photo']?>"/> <br> 
    <i><?php echo $row8b['username'] ?>  </i></a>
    </div> 
    
    <?php } ?>
    
    
<?php } } else { ?>
    
    <div id="no_post"><br><?php echo $row['username']?> does not have any friend in stone.</div>
    
<?php } ?>
    </div>
    
</div>    
    
    
    
    
<?php if (isset($_SESSION['Username'])
        AND ($_SESSION['Username']) == ($row['username'])) { ?>
    
    
    
<div id="request">
    Friends Request
    
    <div id="request_box">
        
        <?php $query7 = sprintf("SELECT * FROM request WHERE receiver = %s ORDER BY id DESC", GetSQLValue($row['username'], "text"));
        $result7 = mysql_query($query7, $connection) or die(mysql_error());
    if ($result7)
{   
    $totalRows7 = mysql_num_rows($result7);
    }  ; 
   
    if($totalRows7 != 0 ) {                                         
    while( $row7 = mysql_fetch_array($result7)) { ?>
        
        <?php $query8z = sprintf("SELECT * FROM friendship WHERE myid = %s AND myfriends = %s OR myid = %s AND myfriends = %s", 
            GetSQLValue($row7['sender'], "text"),
            GetSQLValue($_SESSION['Username'], "text"),
            GetSQLValue($_SESSION['Username'], "text"),
            GetSQLValue($row7['sender'], "text"));
        $result8z = mysql_query($query8z, $connection) or die(mysql_error());
    if ($result8z)
{   
    $totalRows8z = mysql_num_rows($result8z);
    }  ; 
        
   if($totalRows8z == 0){   //睇下是否已經是朋友, 如是, 則不再顯示Request, row8z=0= 不是朋友 
        ?>
        <div id="request_sender">
        <b><?php echo $row7['sender'] ?></b> want to be friends with you.<br>
        
            <a href="friend-accept.php?sender=<?php echo $row7['sender'] ?>">
            <div id="accept">Accept</div></a>
            <a href="friend-reject.php?sender=<?php echo $row7['sender'] ?>">
            <div id="reject">Reject</div></a>
            
        </div><br>
                
<?php        
    } } }else { ?> 
    <div id="no_post"><br>You do not have any friend pending</div>
<?php  };
        ?>
    </div>

</div><!-- Request(Only for logged user) -->
<?php } ?>
    



</div><!-- user_detail2 -->
</div><!-- mainbox -->

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
<script>
$(document).ready(function(){
    $('#header').load('header4.php');
    $('#footer').load('footer2.html');
})
</script>
</body>
</html>