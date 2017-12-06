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
    $query = sprintf("SELECT * FROM order_list ORDER BY id DESC");

    $result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
    {   
        $totalRows = mysql_num_rows($result);  
    } ;
?>

<!---------------------------------------->
<!---------------------------------------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query2 = sprintf("SELECT DISTINCT(username) FROM order_list ORDER BY id DESC");

    $result2 = mysql_query($query2, $connection) or die(mysql_error());
    if ($result2)
    {   
        $totalRows2 = mysql_num_rows($result2);  
    } ;
?>

<!---------------------------------------->

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Store - Order List</title>
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
    <h3>Order list <i>- <?php echo $totalRows ?> orders in total </i> 
    <a href="management/control_center.php"><img src="images/previous.png" class="tooltip" title="Back to Center"></a>
    </h3>
    </div>
    
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Order - ID (↑) </th>
            <th>Total Price</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $sum=0;
    while ($row = mysql_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['order_index'] ?></td>
            <td><?php echo $row['order_price'] ?></td>
            <td><?php echo $row['payment'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td>
            <div id="modify">
            <a href="deliver_detail.php?id=<?php echo $row['id']?>">
            <img src="images/modify.png">
            </a>
            </div>
            </td>
        </tr>
    <?php 
        $value = $row['order_price'];                   
        $sum += $value;                                                     } ?> 
    </tbody>
</table>
    
    <div id="summary_list">
   
    Total purchasing member : <i><?php echo $totalRows2 ?></i> <br>
    Total purchasing action: <i><?php echo $totalRows ?></i> <br>
    Total Profit : $ <i><?php echo $sum ?></i> <br>
 
    </div>
    
    
    </div>
    
</section>

    
</body>
</html>
      
    