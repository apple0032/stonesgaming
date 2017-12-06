<?php
//**********************************//
// 建立cookie, 用來記住使用者填入的資料
//**********************************//

if (!isset($_COOKIE['item_index']))
	setcookie("item_index", "", time() + 3600);
if (!isset($_COOKIE['title']))
	setcookie("title", "", time() + 3600);	
if (!isset($_COOKIE['author']))
	setcookie("author", "", time() + 3600);
if (!isset($_COOKIE['translator']))
	setcookie("translator", "", time() + 3600);
if (!isset($_COOKIE['contents']))
	setcookie("contents", "", time() + 3600);
if (!isset($_COOKIE['feature']))
	setcookie("feature", "", time() + 3600);
if (!isset($_COOKIE['price']))
	setcookie("price", "", time() + 3600);
if (!isset($_COOKIE['discount']))
	setcookie("discount", "", time() + 3600);
if (!isset($_COOKIE['saleprice']))
	setcookie("saleprice", "", time() + 3600);	
?>