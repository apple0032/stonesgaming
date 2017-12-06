<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$id = $_POST['id'];
		$emp_username = $_POST['emp_username'];
		$emp_title = $_POST['emp_title'];
		$emp_content = $_POST['emp_content'];
        $emp_photo = $_POST['emp_photo'];
        $emp_like = $_POST['emp_like'];
        $emp_dislike = $_POST['emp_dislike'];
		
		$stmt = $db_con->prepare("UPDATE community SET username=:user, title=:title,comment=:content, photo=:photo,  love=:love, dislove=:dislove WHERE id=:id");
		$stmt->bindParam(":user", $emp_username);
		$stmt->bindParam(":title", $emp_title);
		$stmt->bindParam(":content", $emp_content);
        $stmt->bindParam(":photo", $emp_photo);
        $stmt->bindParam(":love", $emp_like);
        $stmt->bindParam(":dislove", $emp_dislike);
        $stmt->bindParam(":id", $id);
      
		
		if($stmt->execute())
		{
			echo "Successfully updated";
		}
		else{
			echo "Query Problem";
		}
	}

?>