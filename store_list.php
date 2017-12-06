<?php require_once('Connections/connection.php'); ?>
<?php require_once('Connections/function.php'); ?>

<?php 
if (!isset($SESSION)) {
    session_start();
}

$_SESSION['PrevPage'] = $_SERVER['REQUEST_URI']; 
$_SESSION['login_form_title'] = "HEY!  WHO ARE YOU?"
?>

<!-------- READ MEMBER TABLE FIRST -------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query5 = sprintf("SELECT * FROM member WHERE username=%s",
        GetSQLValue($_SESSION['Username'],"text"));

    $result5 = mysql_query($query5, $connection) or die(mysql_error());
    if ($result5)
    {$row5 = mysql_fetch_assoc($result5);} ;
?>

<?php if (!isset($_SESSION['Username']))  
    header('Location: login_form.php')  ?>
<?php if (($row5['unititle']) !== "admin")  
    header('Location: login_form.php')  ?>

<!---------------------------------------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query = sprintf("SELECT * FROM computer_books ORDER BY id DESC");

    $result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
    {   
        $totalRows = mysql_num_rows($result);  
    } ;
?>

<!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Store - Game List</title>
<script src="assets/js/jquery-3.1.1.min.js"></script>
<link href="CSS/store_db.css" rel="stylesheet" type="text/css" />
<link rel="icon" 
      type="image/png" 
      href="https://upload.cc/i/Y7tJi0.png">
</head>

<body>

    
<section id="detail">
    
<div id="community_main">
    <div id="title">
    <h3>Current Game List <i>- <?php echo $totalRows ?> Games in total </i> 
    <a href="management/control_center.php"><img src="images/previous.png" class="tooltip" title="Back to Center"></a>
    </h3>
    <div id="addgame"><a href="store_db.php"><img src="images/add.png"></a></div>
    </div>
    
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publishdate</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysql_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td>
            <a href="item_detail.php?pro_id=<?php echo $row['id'] ?>" target="_blank">
                <?php echo $row['title'] ?></a>
            </td>
            <td><?php echo $row['author'] ?></td>
            <td><?php echo $row['category'] ?></td>
            <td><?php echo $row['publishdate'] ?></td>
            <td>
            <div id="modify">
            <a href="store_modify.php?id=<?php echo $row['id']?>">
            <img src="images/modify.png">
            </a>
            </div>
            </td>
        </tr>
    <?php } ?> 
    </tbody>
</table>
    
    </div>
    
</section>

    
</body>
</html>
      
    