<?php 
    session_start();
 ?>

<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php
$_SESSION['PrevPage'] = $_SERVER['PHP_SELF']; 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>Development</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/documentation.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
<script src="JavaScript/jBox.min.js"></script>
<link rel="stylesheet" href="CSS/magnific-popup.css" type="text/css">
<script src="JavaScript/jquery.magnific-popup.js"></script>
<link href="CSS/jBox.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="CSS/lightbox.css">
<script src="JavaScript/lightbox.js"></script>
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
    
<div id="community_toppest">
<div id="community_toppest_title">Documentation</div>
<div id="community_toppest_desc">Development, Desgin, Direction, Algorithm , Mechanism, Method, Thought </div>
</div>
    
<div id="topbox_container">
    
<div id="community_topbox1">
<div id="support">What is Support center and how it works? <a href="documentation.php"><img src="images/previous.png"></a></div>
</div>
    
    <div id="support_detail"> 
    
    <b>Introduction</b><br><br>
        
    Support center is a communication system between user and our backend system. It actived once any user report their case and we receive the case sucessfully. On the backend side, support center is a remedy system which is a standard process that provide support and solution for our user. The support center contains of several parts : <i>FAQs , Case-report interface , Issue table , Case detail , Management Center ,  Database etc...</i><br><br> 
    
    <div id="intro">
    <a href="development/support1.jpg" data-lightbox="box1" data-title="Support - IMG1">
    <img class="thumbnail" src="development/support1.jpg"/></a><br>
    Here is the algorithm design of support center
    </div>    
        
    <br><b>Mechanism</b><br><br> 
       
    Support center only provide support to our user that registered in our website. It is a internal system that not allow unregistered people to access. However, the FAQs sections is a constant part to provide quick solution to people. If there are any guest browser this page, no form and table will be displayed. No further activity if visitor do not login, the brief introduction will display.
    <br><br>
        
    <div id="intro">
    <a href="development/support2.png" data-lightbox="box1" data-title="Support - IMG2">
    <img class="thumbnail" src="development/support2.png"/></a><br>
    No further activity if visitor do not login.
    </div>        
    <br><br>    
     
    <div id="mechanism">
    <ul>
    <li> Once visitor login to stone, this part will transform to a form. User can report their issue through this form.</li>  
    <li> Any case reported will be sent to our database and appear in the management center.</li>   
    <li> Only administrator can browser all the cases and do further action.</li>
    <li> These cases classified as category and array order by date, so supporter can do any action immediately. </li>
    <li> When user reported their case, issue table will be displayed instead of the report-form. </li>
    <li> In issue table, user may see brief information of their case: <i>case-id , category , title , content , time </i>and most importantly the <i>status</i> - do your question answered by backend supporter?</li>
    <li> There are two status in this corner <img src="images/reply_no.png"> and <img src="images/reply_yes.png"> which means user case is not answered or has been answered respectively.</li>
    <li> User may click the case to go into a detail page. In this page, user can talk with supporter words by words and Backend supporter will answer user question to help them solve technical problems.</li>
    <li> However, in the communication between user and supporter, user is just allowed to respond <b>ONE</b> time until supporter answered thier question. They have to wait supporter to answer whereas supporter can speak unlimited times.</li>
    <li> User can click "End Case" in anytime no matter their problem has been solved or not.</li>
    <li> When "End Case" is clicked by user (or supporter) , this case will be closed and the issue table will disappear, user can report another case again.</li><br><hr><br>
    <li>In server side, the form will store in stone database and displayed in Management center classified as category and array order by date.</li>
    <li>"Status" in Management center is a very significant index for supporter. Here are the definition : <br><br>
        <ul>
            <div id="definition">
            <li>Processing - User reported latest status and waiting supporter to follow</li>
            <li> Wait to close - Waiting user to respond or end the case</li>
            <li> Closed - The case is closed with user or administrator and no need to follow </li>
            </div>
        </ul>
        </li><br>
    <li> In the details page, supporter has no limit on speaking.</li>   <li> Supporter also has right to end the case in anytime no matter user's problem has been solved or not.</li> 
    <li> Plus, supporter has right to 'delete' the case , Once the 'delete case' button has been clicked, the case will be removed from database immediately and have no backup record. Also, it will remove record in management center. So, this is an irreversible action.</li>
    <li> Once supporter answered user question, the status will changed to 'Wait to close' , if the user find way to solve their problem,they can click 'end case' , if not , they can keep contact with supporter until everythings is solved.</li>
    <li> 'Processing' is the tier1 case that supporter need to follow immediately because user is waiting supporter to give respond.</li>
    <li> Once user answered supporter question, the status will change to 'Processing'.</li>
    <li> Even if the case is closed by user or supporter, supporter could also access to the details page until it has been removed from database.</li>
        
    </ul>    
    </div>    
       
    <br><b>Design</b><br><br> 
     
    The design of support center is very simple. FAQs section will always on the top of whole page, because it is always helpful for user to read and find solution to their problem. It also help to decrease the pressure to website manpower and server. <br><br>
    
    
    The fade-in/fade-out effect in FAQs section is a good performance to attract visitor sight. It also helps to reduce spaces to put answer and retain more spaces to put the report-form. I have to keep the height of the box to prevent user ignore some important part and keep it simple, because support center is not a place to put much content or information while it need a simple interface to help user to solve their un-simple problem.<br><br>
        
    During the early design stage, I put all the content in the issue table, but finally i find that it make the table too crowded. If the content is very very long , some of the information maybe missed in display. Therefor i desgined a onclick funtion to fade-in the information and added a button to open a new window for the case.<br><br>
        
    <div id="design">
     <a href="development/support3.png" data-lightbox="box1" data-title="Support - IMG3">
    <img class="thumbnail" src="development/support3.png"/></a>
     >>
     <a href="development/support4.png" data-lightbox="box1" data-title="Support - IMG4">
    <img class="thumbnail" src="development/support4.png"/></a></div>   <br><br>
        
    The detail page is also a simple message box between user and supporter. Once user speaks, 'Sorry! your case has been submitted to our supports, we will follow your case as soon as possible. ' will displayed and not allowed user to speak again until any supporter respond.<br><br>
    <div id="mana-center">
    <a href="development/support5.png" data-lightbox="box1" data-title="Support - IMG4">
    <img class="thumbnail" src="development/support5.png"/></a><br>
    The Interface of Management Center
    </div> 
        
    <br><b>Programming</b><br><br>     
        
    In PHP programming, I set some security to prevent visitor to access information that not belongs to them. First, while reading database, i set criteria and limitation. <br>
        
    <div id="program">
    <pre>&lt;!-------- READ MEMBER TABLE (CHECK PERMISSION)-------->
&lt;?php
if (isset($_SESSION['Username'])){    //check login</pre><br>
    When "End Case" is clicked by user or supporter the database value will transfom to 'deal', so it can check whether the user still have a issue or not. Noted that every user may only have ONE issue and displayed in their page. 
    <pre>if((mysql_num_rows($result) !== 0) and ($row2['reply'] !== "deal" )){</pre>
     While mysql only support output existing information, if i want to check whether the user exist in my database or not, i need to use <i>mysql_num_rows</i> to count and judge.<br><br>
    <pre>while ($row = mysql_fetch_array($result)) { ?></pre>
    This is a simple way to use for loop printing user information although it only has one row to print.<br><br>
    <pre>&lt;?php echo substr(($title),0, 40); ?> &lt;?php if (strlen($title)>50){ echo "....." ;} ?></pre>
    This is a good way to make the content simple, display the first 40 units and then judge to output "....." <br><br>
    In detail page, I read two table to achieve the message box.
    <pre>$query = sprintf("SELECT * FROM support WHERE username=%s",      //%s = logged user
    
$query2 = sprintf("SELECT * FROM support_reply WHERE support_id=id</pre>The 'support_id=id' help me to gather two table while the id in 'support_reply' is same as the primary key id in 'support'.<br><br>
    <pre>    $query = sprintf("UPDATE support SET reply='deal' WHERE id=%s",
    $query = sprintf("UPDATE support SET reply='no' WHERE id=%s",
    $query = sprintf("UPDATE support SET reply='yes' WHERE id=%s",</pre>
    When user or supporter speak something, this is also a important script to control the case direction and it change the "status" in database too.<br><br>
    <pre>&lt;?php if($row2['support'] !== "supporter"){ ?></pre>
    This script helps to output correct head-image to classify supporter and user.<br><br><br>
    <div id="mana-center">
    <a href="development/support6.png" data-lightbox="box1" data-title="Support - IMG4">
    <img class="thumbnail" src="development/support6.png"/></a><br>
    This is another security checking for user by the following script:<br><br>
    </div> 
    <pre>&lt;?php if (($_SESSION['Username']) == $row['username'])</pre>
    We need to confirm this case is belongs to the user who are logging and visiting support center.<br><br>
    <pre>&lt;?php if (($row5['unititle']) !== "admin")  header('Location: login_form.php')  ?></pre>
    Same Reason, only admin can access management center.<br><br>
    <pre>$query = sprintf("DELETE FROM support WHERE id=%s",</pre>
    Finally, only supporter has rights to delete the case. And the above script support that action since the id is equal to the issue id in the database. Noted that this is an irreversible action.
    </div><br>
        
    <br><b>Further Development</b><br><br>
    Support center will develop more function to user. For example, a upload function should be developed because it helps user to upload image for their case in order to describe their problem specifically. It may also massively helps supporter to understand user's problem and provide solution.<br><br>
    Plus, FAQs section need to improve and increase more questions. Maybe i can use database to store the question rather than put them in a pure HTML document. Also, the backend system need to improve, give the administrator more useful function or tools to follow the case like a A.I respond function.<br><br>
     
    <br><b>Bugs</b><br><br>
    Small bugs is always easy to troubleshoot, but I find a major bug after finished the whole system. This is the specific situation: When someone close the case, the issue table will no longer appear in user page. yeah it seems reasonable, but when user create a new case, the issue table still not appear in user page. This is a bug  and the problem is database. When case is closed, the case is still remains in datbase even if its status is 'deal' , therefore, the following script may make a judgement mistake.
    <div id="program">
    <pre>if((mysql_num_rows($result) !== 0)</pre>  
    In order to solve this case, supporter need to "delete case" directly from database, so the query in database will become 0 , user can create a new issue table.
    </div><br><br><br>
        
    By apple0032 2017/02/04 07:00:00  
    </div> 
</div>
   
</div>   

</section>    
   
    
<script>$('#backtop').click(function(event){
   $('html, body').animate({ scrollTop: 0 }, 'slow');
});  </script>    
<!-- 載入下邊區塊 -->
<div id="footer"></div>
</body>
</html>