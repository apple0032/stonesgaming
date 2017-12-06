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
<div id="toptop"><img src="images/gotop.png"></div>

<div id="wrapper">
  <div id="main">
    <div id="main-nav"><a href="" id="off-canvas-menu">Menu</a></div>
    <div id="content">
      <!-------- CONTENT HERE -------->
       <section id="detail">
<div id="detail_main">
    
<div id="community_toppest">
<div id="backpage"><a href="about.php"><img src="images/back-page.png"></a></div>
<div id="community_toppest_title">Documentation</div>
<div id="community_toppest_desc">Development, Desgin, Direction, Algorithm , Mechanism, Method, Thought </div>
</div>
    
<div id="topbox_container">
  
<div id="content">

<div id="chap1">
<div id="community_topbox1">
<div id="support">What is Support center and how it works?<img src="images/burn.png" id="gotop"></div>
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
    
    
<div id="chap2">
<div id="community_topbox1">
<div id="support">The development of community<img src="images/burn.png" id="gotop"></div>
</div>
<div id="support_detail">    
    
<b>Introduction</b><br><br> 
    
Community is a platform that connect every member together , so that those website member will have more activity to do with others. Community is a social media, which is a very popular behaviour and trend for people nowadays. However, stone community is still developing, it is so weak and only little function now.<br><br>
    
    The stone community is basically a online forum, which is a place that providing area for member to discuss and chat. The community can be divided into several parts : <i>Main Page, Search engine, Like and dislike function, preview box , topic details, reply post , edit post, quote others, new post, share picture, member point system and backend management center ....etc (still developing...)</i><br><br>
    
    <div id="intro">
    <a href="development/commu1.png" data-lightbox="box1" data-title="Community - IMG1">
    <img class="thumbnail" src="development/commu1.png"/></a><br>
    The main box of community center.
    </div><br>

 <b>Mechanism</b><br><br>    
    
 Community only provide for our member , everyone should have a account and login to our server first, and then they can join the discussion or create a new post. However, guest without login could also allowed to browser the post. <br><br>   

<div id="mechanism">
<ul>
<li>In the mainpage, the white box on the top will display member details - head image, name, title and point. The information shows user details and give them a brief review. </li>
<li>There are two search box in the white box - search by game(top) or search by post name/user name (down). If user search on top, they will be transferred to STORE, otherwise stay at community.</li>
<li>There are two ways to create a new post/discussion - share a picture or create a new post directly.</li>
<li>If user choose to share a picture, they can upload a picture with picture format limited to 2MB. They are not allowed to upload other format document. They are also not allowed to add any opinions or comment on their picture, the picture will be posted as a usual post in the post list, other user then can made any comment on the picture. However, this picture will completely display in the post list instead of just title and content.</li>
<li>If user choose to create a new post, there will be a editor for them to use, this editor is a HTML editor which provide strong function for people to decorate their content, they can also use emotion icon(emoticons) and upload picture. The title and content for this post will be shown in the community list. Noted that even user upload a picture in the content part, the picture will not be displayed in the list.</li><br>
    
    <div id="intro">
    <a href="development/commu2.png" data-lightbox="box1" data-title="Community - IMG2">
    <img class="thumbnail" src="development/commu2.png"/></a><br>
    A strong HTML editor - CKeditor
    </div><br>
    
<li>User MUST give a title to these two kinds of post in order to make them correctly display in the list.</li>
<li>In the post list, basic information - author, time, title, brief content, like and dislike, reply …show in each post.  If user click the content part, the pop-up window will be displayed and show the full content of post , like and dislike and also a button to go inside to the post. Noted that user are not allowed to click like and dislike button in this page, they must go inside to the post to do that.</li>
<li>User click every places except content part will link inside to the post detail page.</li>
<li>The post list will displayed as 10 posts per page , order by post time from latest to oldest.</li>
<li>In detail page, only the author of the post(or administrator) could see the "EDIT" icon, only author allowed to edit their post through the HTML editor.
</li>
<li>They are not allowed to edit the post which is share-picture post.</li>
<li>In left hand side, the box display author name, head image, star, point and their title. They can change their head image in member center(still developing...)</li> 
<li>The star represent the points that user owned. Here are the stardand : </li>
    <ul>
        <div id="definition">
            <li>Points => 600  : <img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"></li>
            <li>Points => 400  : <img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"></li>
            <li>Points => 200  : <img src="images/star-gold.png"><img src="images/star-gold.png"><img src="images/star-gold.png"></li>
            <li>Points => 100  : <img src="images/star-gold.png"><img src="images/star-gold.png"></li>
            <li>Points =>&nbsp; &nbsp;10  : <img src="images/star-gold.png"> ( This is the default start point ) </li>
        </div>
    </ul>
<li>User can gain points in either two ways : Open a post/share picture or reply others. The former gain 5 points and the latter gain 1 point.
</li>
<li>User title represent user class in the community, there are just two type of title now: administrator or member. </li>
<li>Everyone can click into the author image to open a pop-up window, User details will be displayed. </li><br>
    <div id="intro">
    <a href="development/commu3.png" data-lightbox="box1" data-title="Community - IMG3">
    <img class="thumbnail" src="development/commu3.png"/></a><br>
    Click into the profile picture.
    </div><br>
<li>After the content part, we can see like and dislike button, also the current value. Everyone can click like and dislike button to make the value higher.</li>
<li>The box below content part is a reply area. Same as post list, ten replies per one page, but order by post time from  oldest to latest. Also, everyone can click user image to watch their profile.</li>
<li>User can click "quote" button in the right-down hand side to reply someone and they will gain +1 point. In the quotation page, it will display the username and the words that user want to reply to.</li>
<li>Below reply area is a reply form, only logged user can use this form to reply other.</li>
<li>There are two button on the top of the whole post, user can click this shortcut to create new post, no need to back to main page.</li>
<br><hr><br>
<li>In the management center, all information display in the main page including the <i>post ID, username, title, content/photo, like and dislike value. </i> </li>
<li>Only administrator can view this information and do further action. They can create new post, delete post and modify post detail. They can search information in the search box. They can also sort the information by clicking the ROWS in the top of the table.</li>
<li>They are not allowed to modify post ID, because it has a risk to affect system.</li>    
    <br>
    <div id="intro">
    <a href="development/commu4.png" data-lightbox="box1" data-title="Community - IMG4">
    <img class="thumbnail" src="development/commu4.png"/></a><br>
    Very simple control of management center
    </div><br>
    
<li>However, the replies of the post are not allowed to add,delete and modify.</li> 
</ul>   
</div>  <br>
    
<br><b>Programming & Database </b><br><br>  
Let's talk about the database structure first. Before building the main part of community, i am thinking of the database structure first, like : <i>number of database, rows, rows types, default values, how to represent the type of post, how to uniquely identify the post and then store the reply on it, how to print out the content and the reply, how to like/dislike, how to quote, how to edit...etc.</i> I have a very long road to go and i did it step by step. <br><br>
    
First, i build two databases, one is used for storing the content of the post(called C-post), and the other one is used for storing the replies of the post(called C-reply). They are both using ID as a primary key to uniquely identify the columns of information. In the table C-reply, it has a rows call topic-id which is a foreign key , used for linking the information between C-post and C-reply. So, once any user reply something, the data will store in C-reply and the topic-id will be stored corresponding to the C-post ID, the primary key of the post. Therefore, every reply will tightly follow the topic, then i can output it very very easy by PHP. Noted that this primary key set as AUTO_INCREMENT in db, so it is impossible to overlap.<br><br>
    
In the table C-reply, there are two rows called quote and quote_ppl. If the quote values exist(not null), means that this reply is quoting someone speak, and the quote_ppl will be the one who is this reply quoting. If the values do not exist(null), the quoting box in detail page will not display, outputed as usual reply.<br><br>
    
We have been discussed above that the post in community will be divided into two type, share picture and usual post. In the table C-post, i need to make this work through database. There are two rows in C-post, photo and comment, when the user choose to share a picture, their uploaded path(included filename) will be stored in this rows, and then the row comment will remain blank. By same theory, the information for user who want to post a usual post will store in the row comment and then leave the row photo to blank.<br><br>
    
After building the database, I start to develop the main page. In order to separate all post in pages, I need to do the following things:
<br>
<div id="program">
<pre>$rowsPerPage = 10; //define(X)posts per page
$totalPages = ceil($totalRows / $rowsPerPage); //calculate total number of pages

$startRow = $page * $rowsPerPage;
$current_query = sprintf("%s LIMIT %d,%d",$query, $startRow,$rowsPerPage); 
                    //limit the original query.
</pre>
</div><br>
Then, use this script to printout the post.
<div id="program">
<pre>
&lt;?php if ($rowsOfCurrentPage)
{
    &lt;?php 
            if ($page > 0) {  //print the page button
    &lt;?php 
            Page-&lt;?php echo $page + 1; ?>
            if ($page &lt; $totalPages + 1)  //print page number and next page button
    &lt;?php 
            if ($page &lt; $totalPages - 1) //print previous page
} else { no post } ?>
</pre>    
</div><br><br>
Because of the editor,when the user input their content, modify it and then send in to our database, this content   should contains a ton of HTML entities and others styling characters. In order to make a preview box with brief information of the post, i need to use this script to 1. converts HTML entities to characters. 2.Strip HTML and PHP tags from a string.
<div id="program">
<pre>
$comment1 = strip_tags(html_entity_decode($row['comment'])) ;
</pre>
</div><br><br>
    
In order to classify the two type of post, I use PHP if/else to make a judgment.
<div id="program">
<pre>
&lt;?php if(empty($row['photo'])) {  output usual post content } else { output photo path}?>
</pre>
</div><br><br>
Of course, using this script to judge the length of a string(content).
<div id="program">
<pre>
&lt;?php echo substr(($comment1),0, 250); ?> //limit number of display words
&lt;?php if (strlen($comment1)>200){ echo "........" ;} ?> //count the number of words
</pre>
</div><br><br>    
    
I create a pop-up window by using JQuery. Because every post has their unique ID, so it is easy to create unique pop-up window by defining the DIV-id to the same as this unique ID(Primary key), like this:
<div id="program">
<pre>
&lt;div id="&lt;?php echo $row['id'] ?>">
        <I>POST CONTENT / PHOTO</I>
&lt;/div>
</pre>
</div><br><br> 
    
In order to accomplish the adding points function while posting reply, I put this script when the form submitted:
<div id="program">
<pre>
$query = sprintf("INSERT INTO .......
            ...............
            ...............);
$result = mysql_query($query, $connection);
$newpoint = $row['point'] + 1 ;
$query2 = sprintf("UPDATE member SET point=%s, %s=$newpoint);
$result2 = mysql_query($query2, $connection);

if (($result) and ($result2)) {   DONE;   };     
</pre>
</div><br><br>     
    
We talked above that how to link between C-reply and C-post by using foreign key, here is the actual script :
<div id="program">
<pre>
$query = sprintf("SELECT * FROM C-reply WHERE topic_id = $row['id'] ORDER BY datetime ASC);
</pre>
</div><br><br> 

And also, I created a like/dislike button, unfortunately,  this part is not designed in AJAX, so when user click the button, it requires to refresh page. The AJAX improvement is still studying. Here is the script when post form submitted to db.
<div id="program">
<pre>
$row['love'] =+ 1 ;   //$row['love'] = post current like(s)
</pre>
</div><br><br>     
    
For the user star, i try to use a very ridiculous method to do it, but this is the only way I know how to do it.
<div id="program">
<pre>
 &lt;?php if(($row['point']) >= "600" ) {  
           for ($x = 0; $x <= 4; $x++) { ?> 
                <I>PRINT GOLD STAR</I>
    &lt;?php ;  }  
    } else { ?>
        &lt;?php if(($row['point']) >= "400" ) {  
        for ($x = 0; $x <= 3; $x++) { ?> 
                <I>PRINT GOLD STAR</I>
    &lt;?php ;  }  
    } else { ?> .........
                ........
                ......
                ...
                }  }}}}?>
</pre>
</div><br><br>      
    
For the edit function, only author allowed to edit their post and see the edit icon behind the title.
<div id="program">
<pre>
&lt;?php 
        if (isset($_SESSION['Username'])){   //check login first
        if((($_SESSION['Username'])==($row['username'])) or  // logged user match the author 
            (($_SESSION['title'])=="admin")) {  //admin has full permission to control
        
        if (empty($row['photo'])) {  //photo is not allowed to edit.
        ?>
            <I>PRINT EDIT ICON</I>  //a href link into edit page.
            
    &lt;?php    }
            }   
        }
    ?>   </pre>
</div><br><br>    

The way to judge the type of post:
<div id="program">
<pre>
&lt;?php if(empty($row['photo'])) { ?>
            <I>PRINT USUAL POST CONTENT</I>
         } else { 
            <I>PRINT PHOTO PATH WITH IMG</I>
         } ;
</pre>
</div><br><br> 
    
Use this script to judge whether the reply is quoting someone or not.
<div id="program">
<pre>
&lt;?php if(!empty($row3['quote'])){ ?>  //not null = contain quotation
            &lt;?php echo $row3['quote']; ?> // printout what speak user want to quote
            &lt;?php echo $row3['quote_ppl']; ? //printout who are user quoting
            &lt;?php } ?>
</pre>
</div><br><br> 
    
If i need to apply reply segmentation with pages, i need to create virtual path of link. "?" is being used , so i need to use "&" to identify the pages number and their relative
url.
<div id="program">
<pre>
detail.php?id=<I>POST-ID</I>&page=<I>PAGE NUMBER</I>
</pre>
</div><br><br>

Always use this script to print out all reply and try to select table to match replier. 
<div id="program">
<pre>
&lt;?php  while ($row = mysql_fetch_array($result)) {
                    <i>ALL REPLY;</i>
    $query = sprintf("SELECT * FROM member WHERE username = %s", //match name,printout image
    }
</pre>
</div><br><br>
    
If user need to quote someone, I need to use GET function. This is how to select the quotation:
<div id="program">
<pre>
$query = sprintf("SELECT * FROM C-reply WHERE id = %s", GetSQLValue($_GET['id'], "int"));   
    //$_GET['id'] created when click quote in detail page.
</pre>
</div><br><br>

Of course, the rows quote and qoute_ppl need to store values, so make the judgement work in detail page. Here is a javascript function to ensure the user must enter some content in their reply.
<div id="program">
<pre>function CheckFields()
{
	var fieldvalue = document.getElementById("<I>CONTENT</I>").value;
	if (fieldvalue == "")   //means empty
	{
		alert("Please type a title !");
		document.getElementById("<I>CONTENT</I>").focus();
		return false;  //reject the submission
	} ;
    
}    
</pre>
</div><br><br> 

In quotation page, it will display the name of the person user want to quote.<br><br>
 <div id="intro">
    <a href="development/commu5.png" data-lightbox="box1" data-title="Community - IMG5">
    <img class="thumbnail" src="development/commu5.png"/></a><br>
    The quotation page.
    </div><br><br>
    
 In the edit page, just put the whole row of information into the textarea, then handled by the ckeditor.
 <div id="program">
<pre>&lt;textarea id="editor1" name="editor1">
&lt;?php echo $row['comment'] ?>
&lt;?php } ?>
&lt;/textarea></pre>
</div><br><br>    
    
In sharing-picture post, i need to ensure the uploaded format:
<div id="program">
<pre>$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp');</pre>
</div><br><br> 

Then ensure the picture with same filename will not been overlapped:
<div id="program">
<pre>$final_image = rand(1000,1000000).$img; //add a random number in front of the filename</pre>
</div><br><br> 

Finally, upload file to server and also insert the path to the database:
<div id="program">
<pre>If (uploaded) {
$query = sprintf("INSERT INTO C-post photo = $path ");
}</pre>
</div><br> 
For the search engine, We will discuss it in STORE part.

<br><br><b>Design</b><br><br>
Here are some of the early design of community.<br>

<div id="intro_inline_gallery">
 <div id="intro_inline">
    <a href="development/commu6.jpg" data-lightbox="box1" data-title="Community - IMG6">
    <img class="thumbnail" src="development/commu6.jpg"/></a><br>
    </div>
 <div id="intro_inline">
    <a href="development/commu7.jpg" data-lightbox="box1" data-title="Community - IMG7">
    <img class="thumbnail" src="development/commu7.jpg"/></a><br>
    </div>
 <div id="intro_inline">
    <a href="development/commu8.jpg" data-lightbox="box1" data-title="Community - IMG8">
    <img class="thumbnail" src="development/commu8.jpg"/></a><br>
    </div>
<div id="intro_inline">
    <a href="development/commu9.png" data-lightbox="box1" data-title="Community - IMG9">
    <img class="thumbnail" src="development/commu9.png"/></a><br>
    </div>
<div id="intro_inline">
    <a href="development/commu10.png" data-lightbox="box1" data-title="Community - IMG10">
    <img class="thumbnail" src="development/commu10.png"/></a><br>
    </div>
<div id="intro_inline">
    <a href="development/commu11.png" data-lightbox="box1" data-title="Community - IMG11">
    <img class="thumbnail" src="development/commu11.png"/></a><br>
    </div>
</div><br>

In developing community , I begin to study with the editor - i need a tools to let user to decorate their post content, to make the post more tidy and attractive. In this purpose, it is unavoidable to use HTML entities and others styling characters, but how does it work in client side? In order to achieve a "What You See Is What You Get"(WYSIWYG) enviornment for our user, I choose to apply CKeditor - a free, Open Source HTML text editor designed to simplify website content, and also providing WYSIWYG enviornment. It is very very helpful for those users who do not know anything about programming. Then, i study in this editor and try to install some userful plugin like use emotion icon, upload pciture etc... After many testing, the editor is work to input information to the database and upload picture to the host server.<br><br>

Then, I start to develop the main page, try to design the layout and interface. "color mixing" is a big big trouble for me, because I don't have knowledge with Visual Arts. I spend lots of time to mix color in order to totally match other objects in the website. Finally, I got a satisfactory result - What I think is the BEST box color in my website.<br></br>

 <div id="intro">
    <a href="development/commu12.png" data-lightbox="box1" data-title="Community - IMG12">
    <img class="thumbnail" src="development/commu12.png"/></a><br>
    The background color in post list in main page.
    </div><br>
    
After that, I develop the detail page. I design it to my own style, not even similar to the popular open source forum.(vbulletin,discuz etc...) I want to develop a member system therefore i create a member box including user points and title. Then, reply,edit,post,search.... I finish these functions one by one. Finally, I finish to develop the white box on the top of main page.
<br><br><b>Further Development</b><br><br>
When thinking about expand the community, the first thing I want to build is friends system. Social website is the most popular website nowadays, but playing and sharing are not the only reason, meeting new friends is the main point too. The community can go forward to this road, expand its member system, make user more easy to communicate and Interact with others. Yup, Stone is a online digital distribution platform, but  STORE is clearly not the most important element while community is.

There are so many things that community may need to improve and develop, I am not going to describe one by one here.

<br><br><b>Bugs</b><br><br>
<div id="mechanism">
<ul>
<li>There is no infinity quotation in reply page. User are only allowed to quote one times.</li>
<li>Not allowed to upload picture other than jpg, jpeg (still solving)</li>
<li>No limitation on size of uploaded picture.</li>
<li>Can not type chinese other than using ckeditor</li>
<li>The picture with very high height may affect the whole page because of the resize of picture.</li>
</ul>    
</div><br><br><br>
    
By apple0032 2017/02/10 19:06:00
<br>
    
     
</div>  
</div>  
    
    
    
<div id="chap3">


<div id="community_topbox1">
<div id="support">STONE STORE - The digital game shop<img src="images/burn.png" id="gotop"></div>
</div>
<div id="support_detail">    
    
<b>Introduction</b><br><br> 
    
STONE Gaming is a online digital distribution platform (eCommerce platform) which is a place for online user to browse, shop and purchase games. Store is the CORE section of stonesgaming.com as it provides a platform to our user to shop and read more about the game details. It is the most attractive part for user to stay in our website, and share the games or to discuss somethings in the forum.<br><br>
    
The Store is always under developing, there are still so many functions that i can apply it in the store, just like many popolar e-shop website, taobao or amazon etc.. There are so many companies using open source eCommerce platform to develop their own system, because these kinds of open source framework provide many functions and libraries for them to use, and also provide simple CMS  system(Content Management System) for them to manage thier website. The big feature of this open source framework is that the programmer may develop a new website very fast and effective, the code is maintainable and sustainable for further development.<br><br>
    
However, <p>Stonesgaming.com</p> programmed with native PHP and HTML, no any open source framework has been applied on it. (even bootstrap also not used in this website.)
<br><br>
    
<div id="intro">
    <a href="development/magento.jpg" data-lightbox="box1" data-title="Community - IMG12">
    <img class="thumbnail" src="development/magento.jpg"/></a><br>
    Simple eCommerce platform features.
</div><br>
    
<b>Mechanism</b><br><br>

Store is the core section of <p>Stonesgaming.com</p>, so it has a unique navigation bar in the category page for user to select different kinds of game type. Basically, when user click the "store" in menu, it will redirect to 'game' page in the nav bar by default.<br><br>
    
<div id="intro">
    <a href="development/navbar.png" data-lightbox="box1" data-title="Community - IMG12">
    <img class="thumbnail" src="development/navbar.png"/></a><br>
    The store unique nav bar.
</div>
    
<div id="mechanism"><br>
<ul>
    <li>'Home' button in navbar will redirect to index page, it means that the index page is a part of store. When user go into the main page, they are already inside in the store.</li>
    <br><hr>
    <li>'About' is a place which is used for publish any announcement, updates, new releases or Purchasing Details - a news publish center.</li>
    <li>When clicked into the news title, the details box will be displayed, and also the content, announcer and post time will displayed.</li>
    <li>The news can be CRUD in the CMS very effectively and easily.</li>
    <li>The news is arrayed order by datetime DESC and limit to display <b>six</b> of latest records. </li>
    <li>There is a button in the top of the list, this links will redirect to the CMS and request user to login, only administrator with suitable account and password that is stored in our DB may allowed to access the CMS.</li>
    <li>Below is three parts of game list: new releases, Pre-Purchasing and free to play,they are arrayed according to their details separately: publish-time and category.</li>
    <li>None of a game listed in this page is static. On the contrary, they are dynamically and automatically displayed according to the information in the db. Of course, we can control what we need to display by modified the inforamtion in CMS, rather than modify the database directly. </li>   
    <li>Configure and modify the structure,content for db is considered as finally method to control the content. For a good programming habits, CMS is the best way to control everything we need to show in our website.</li>
    <li>A small guide displayed in the last part of this page, it describes the simple step to purchase a product in the store.</li>
    <br><hr>
    <li>'News' page is a place to put RSS Feed -  a type of web feed which allows users to access updates to online content in a standardized, computer-readable format. (definition by wikipedia) </li>
    <li>It generated by some online RSS generator, and the news source is <p>gamespot.com</p>. When user click the title on the list, it will redirect this topic to <p>gamespot.com</p> and display the details.</li>
    <li>We can't control any content in this page in CMS, because the source we displayed are not stored in our DB, we just transfer the information through RSS.</li>
    <br><hr>
    <li>There is a unique navigation bar in each of the shopping pages and they will redirect the page according to their category respectively: ADVENTURE, ACTION,  STRATEGY, SPORTS and MULTIPLAY.</li>
    <li>The category for each of the game listed in the page has been stored into the database and the db field named as 'Category'. Each game can only belongs to <B>ONE</B> category, <B>NO</B> multiple category/tag are supported in the store. </li>
    <li>The slideshow widget only displayed in Adventure page, because this page is a default index of stone's store.</li>
    <li>There is a sidebar in the right hand side, displayed five icon and they redirect the page according to the category respectively.</li><br>
    <b>Algorithm Design</b><br><br>
    <div id="intro">
    <a href="development/flow.png" data-lightbox="box1" data-title="Community - IMG12">
    <img class="thumbnail" src="development/flow.png"/></a><br>
    Store's Shopping Cart workflow.
    </div><br>
</ul>
     
</div>  
    
    
</div>
</div>
<!-- ch3 -->
    
<h2 id="chap4"> 
    
<!-- PART4 -->  
    
</h2>
<!-- ch4 -->
    
    
</div>
     
</div>
   
</div>   

</section>     
        
    </div>
  </div>
  <div id="side-nav"> <a href="" id="close-slide-nav">Close</a>
    <div id="nav">
  <ul>
    <li>
        <a href="#chap1" id="link1">
<div id="category">Support Center</div></a>
    </li>
      
    <li><a href="#chap2" id="link2">
<div id="community">Community</div></a>
    </li>
      
    <li><a href="#chap3" id="link3">
<div id="store">Stone STORE</div></a>
    </li>
      
  </ul>
</div>
  </div>
</div>
    

   
    
    
<script type="text/javascript" src="jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var chap1_y = $('#chap1').offset().top;
		var chap2_y = $('#chap2').offset().top;
		var chap3_y = $('#chap3').offset().top;
		var chap4_y = $('#chap4').offset().top;
		var buffer = 50;
		$(window).scroll(function(event){
			var winPos = $(window).scrollTop();
			$('#link1').removeClass('scrolling');
			$('#link2').removeClass('scrolling');
			$('#link3').removeClass('scrolling');
			$('#link4').removeClass('scrolling');
			if(winPos>=(chap4_y-buffer)){
				$('#link4').addClass('scrolling');
			}else if(winPos>=(chap3_y-buffer)){
				$('#link3').addClass('scrolling');
			}else if(winPos>=(chap2_y-buffer)){
				$('#link2').addClass('scrolling');
			}else if(winPos>=(chap1_y-buffer)){
				$('#link1').addClass('scrolling');
			}
    });
		$('#link1').click(function(event){
			$('html,body').animate({scrollTop:(chap1_y)+'px'}, 800);
		});
		$('#link2').click(function(event){
			$('html,body').animate({scrollTop:(chap2_y)+'px'}, 800);
		});
		$('#link3').click(function(event){
			$('html,body').animate({scrollTop:(chap3_y)+'px'}, 800);
		});
		$('#link4').click(function(event){
			$('html,body').animate({scrollTop:(chap4_y)+'px'}, 800);
		});
	});
</script>
    
<script>$('#backtop,#gotop,#toptop').click(function(event){
   $('html, body').animate({ scrollTop: 0 }, 'slow');
});  
</script>     
<script type="text/javascript">
	$(document).ready(function() {
		$('#off-canvas-menu,#close-slide-nav,#side-nav').click(function(event) {
			event.preventDefault(); 
      $('#main,#side-nav').toggleClass('off-display');
    });
	});
</script>    

<script>
 $(window).scroll(function () {

        /* Check the location of each desired element */
        $('#toptop').each(function (i) {

            var bottom_of_object = $(this).position().top + $(this).outerHeight() + 2200;
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if (bottom_of_window > bottom_of_object) {

                $(this).animate({
                    'opacity': '1'
                }, 500);

            }

        });

    });    
</script>

    
</body>
</html>