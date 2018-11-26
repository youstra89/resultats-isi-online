<?php
	define("HOST", "localhost");
	define("DBNAME", "drdiallo_whatsapp");
	define("USER", "drdiallo_whuser9");
	define("PWD", "m@rkaz#8989");
	$pdo_option[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	try{
		//On se connecte à Mysql
		$query = new PDO("mysql:host=localhost;dbname=markaz", "root", "l@note20$", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$query->exec('SET NAMES utf8');
		//$link = mysql_connect("localhost","root");
		//mysql_query("SET CHARACTER SET 'utf8';", $link);
	}
	catch(Exception $e){
		//Message en cas d'erreur
		die("Erreur : ". $e->getMessage());
	}
?>