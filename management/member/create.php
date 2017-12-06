<?php
require_once 'dbconfig.php';

	
	if($_POST)
	{
		$emp_user = $_POST['emp_user'];
		$emp_pass = $_POST['emp_pass'];
		$emp_name = $_POST['emp_name'];
        $emp_sex = $_POST['emp_sex'];
        $emp_birth = $_POST['emp_birth'];
        $emp_mail = $_POST['emp_mail'];
        $emp_phone = $_POST['emp_phone'];
        $emp_address = $_POST['emp_address'];
        $emp_photo = $_POST['emp_photo'];
		
		try{
			
			$stmt = $db_con->prepare("INSERT INTO member(username,password,name,sex,birthday,email,phone,address, photo) VALUES(:user, :password, :name, :sex, :birth, :mail, :phone, :address, :photo)");
			$stmt->bindParam(":user", $emp_user);
			$stmt->bindParam(":password", $emp_pass);
			$stmt->bindParam(":name", $emp_name);
            $stmt->bindParam(":sex", $emp_sex);
            $stmt->bindParam(":birth", $emp_birth);
            $stmt->bindParam(":mail", $emp_mail);
            $stmt->bindParam(":phone", $emp_phone);
            $stmt->bindParam(":address", $emp_address);
            $stmt->bindParam(":photo", $emp_photo);
			
			if($stmt->execute())
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>