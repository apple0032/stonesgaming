<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$id = $_POST['id'];
		$emp_user = $_POST['emp_user'];
		$emp_pass = $_POST['emp_pass'];
		$emp_name = $_POST['emp_name'];
        $emp_sex = $_POST['emp_sex'];
        $emp_birth = $_POST['emp_birth'];
        $emp_mail = $_POST['emp_mail'];
        $emp_phone = $_POST['emp_phone'];
        $emp_address = $_POST['emp_address'];
        $emp_photo = $_POST['emp_photo'];
		
		$stmt = $db_con->prepare("UPDATE member SET username=:user, password=:password, name=:name, sex=:sex, birthday=:birth, email=:mail, phone=:phone, address=:address, photo=:photo WHERE id=:id");
		$stmt->bindParam(":user", $emp_user);
		$stmt->bindParam(":password", $emp_pass);
		$stmt->bindParam(":name", $emp_name);
        $stmt->bindParam(":sex", $emp_sex);
        $stmt->bindParam(":birth", $emp_birth);
        $stmt->bindParam(":mail", $emp_mail);
        $stmt->bindParam(":phone", $emp_phone);
        $stmt->bindParam(":address", $emp_address);
        $stmt->bindParam(":photo", $emp_photo);
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