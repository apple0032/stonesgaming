<?php
include_once 'dbconfig.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * FROM community WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
    
     $content = strip_tags(html_entity_decode($row['comment']));
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>

<style>
    
</style>

	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='#'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='id' value='<?php echo $row['id']; ?>' />
 
        <tr>
            <td>Username</td>
            <td><input type='text' name='emp_username' class='form-control' value='<?php echo $row['username']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='emp_title' class='form-control' value='<?php echo $row['title']; ?>' required></td>
        </tr>
        
        <tr>
            <td>Content</td>
            <td><textarea rows="30" cols="150" name='emp_content' id='emp_content' class='form-control'> 
            <?php echo $row['comment']; ?>    
            </textarea></td>
            <script type="text/javascript">
				CKEDITOR.replace( 'emp_content' );
			</script>
        </tr>
        
        <tr>
            <td>Photo</td>
            <td><input type='text' name='emp_photo' class='form-control' value='<?php echo $row['photo']; ?>'></td>
        </tr>
        
        <tr>
            <td>Like</td>
            <td><input type='text' name='emp_like' class='form-control' value='<?php echo $row['love']; ?>'></td>
        </tr>
        
        <tr>
            <td>Dislike</td>
            <td><input type='text' name='emp_dislike' class='form-control' value='<?php echo $row['dislove']; ?>'></td>
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
     
