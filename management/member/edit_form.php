<?php
include_once 'dbconfig.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * FROM member WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='id' value='<?php echo $row['id']; ?>' />
        <tr>
            <td>Username</td>
            <td><input type='text' name='emp_user' class='form-control' value='<?php echo $row['username']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Password</td>
            <td><input type='text' name='emp_pass' class='form-control' value='<?php echo $row['password']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Name</td>
            <td><input type='text' name='emp_name' class='form-control' value='<?php echo $row['name']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Sex</td>
            <td><input type='text' name='emp_sex' class='form-control' value='<?php echo $row['sex']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Birthday</td>
            <td><input type='text' name='emp_birth' class='form-control' value='<?php echo $row['birthday']; ?>' required></td>
        </tr>
        
        <tr>
            <td>E-mail</td>
            <td><input type='text' name='emp_mail' class='form-control' value='<?php echo $row['email']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Phone</td>
            <td><input type='text' name='emp_phone' class='form-control' value='<?php echo $row['phone']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Address</td>
            <td><input type='text' name='emp_address' class='form-control' value='<?php echo $row['address']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Photo</td>
            <td><input type='text' name='emp_photo' class='form-control' value='<?php echo $row['photo']; ?>' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Save Updates
			</button>
            </td>
        </tr>
 
    </table>
</form>
     
