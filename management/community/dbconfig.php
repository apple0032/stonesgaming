<?php

	$db_host = "localhost";
	$db_name = "stonesga_ch30";
	$db_user = "root";
	$db_pass = "Tyk27a726KX";
	
	try{
		
		$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}


?>