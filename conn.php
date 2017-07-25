<?php


try
{
	$pass = '';
	$user = 'root';
	$host = 'localhost';
	$db = 'e-care';

	$conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

	echo $e->getMessage();
}



?>