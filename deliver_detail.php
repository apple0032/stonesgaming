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
    $query = sprintf("SELECT order_index FROM order_list WHERE id=%s",
    GetSQLValue($_GET['id'], "int"));

    $result = mysql_query($query, $connection) or die(mysql_error());
    if ($result)
    {   
        $row = mysql_fetch_assoc($result);
        $totalRows = mysql_num_rows($result);  
    } ;
?>

<!---------------------------------------->
<!---------------------------------------->
<?php 
    mysql_select_db('stonesga_ch30', $connection) or die('database error'); 
    $query2 = sprintf("SELECT * FROM order_detail WHERE order_index=%s ORDER BY id DESC",
    GetSQLValue($row['order_index'], "text"));

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
<title>Store - Order Detail</title>
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
    <h3>Order ID - <i>- <?php echo $row['order_index'] ?>  </i> 
    <a href="deliver_list.php"><img src="images/previous.png" class="tooltip" title="Back to Center"></a>
    </h3>
    </div>
    
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>(↑) Order - ID*</th>
            <th>Item Code</th>
            <th>Item (s)</th>
            <th>Quantity</th>
            <th>Price (USD)</th>
            
        </tr>
    </thead>
    <tbody>
    <?php 
    $sum=0; $total=0;
        while ($row2 = mysql_fetch_assoc($result2)) { ?>
        <tr>
            <td><?php echo $row2['id'] ?></td>
            <td><?php echo $row2['username'] ?></td>
            <td><?php echo $row2['order_index'] ?></td>
            <td><?php echo $row2['item_index'] ?></td>
            <td><?php echo $row2['item_name'] ?></td>
            <td><?php echo $row2['quantity'] ?></td>
            <td>$ <?php echo $row2['single_price'] ?></td>
        </tr>
    <?php 
           $value = $row2['quantity'];                   $sum += $value;
           $value2 = $row2['single_price'];
           $total += $value2;                                          
                                                    } ?> 
    </tbody>
</table>
    
    <div id="summary">
   
    Total of items : <i><?php echo $totalRows2 ?></i> <br>
    Total of Quantity : <i><?php echo $sum ?></i> <br>
    Total of Price : <i> $ <?php echo $total ?></i> <br>
 
    </div>
    
    </div>
    
</section>

    
</body>
</html>
      
    