<?php
//**********************************//
// 建立cookie, 用來記住使用者填入的資料
//**********************************//

if (!isset($_COOKIE['username']))
	setcookie("username", "", time() + 3600);	
if (!isset($_COOKIE['password']))
	setcookie("password", "", time() + 3600);
if (!isset($_COOKIE['name']))
	setcookie("name", "", time() + 3600);
if (!isset($_COOKIE['sex']))
	setcookie("sex", "", time() + 3600);
if (!isset($_COOKIE['year']))
	setcookie("year", "", time() + 3600);
if (!isset($_COOKIE['month']))
	setcookie("month", "", time() + 3600);
if (!isset($_COOKIE['day']))
	setcookie("day", "", time() + 3600);
if (!isset($_COOKIE['email']))
	setcookie("email", "", time() + 3600);	
if (!isset($_COOKIE['phone']))
	setcookie("phone", "", time() + 3600);
if (!isset($_COOKIE['address']))
	setcookie("address", "", time() + 3600);
if (!isset($_COOKIE['uniform']))
	setcookie("uniform", "", time() + 3600);
if (!isset($_COOKIE['unititle']))
	setcookie("unititle", "", time() + 3600);
?>