<?php
session_start();
if((isset($_POST['login'])) && (isset($_POST['password'])) && (isset($_POST['rpassword'])) && (isset($_POST['email'])) && (isset($_POST['akceptuje'])))
{
	require_once "connect.php";
	
	$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
	$connect -> exec("SET CHARACTER SET utf8");
	$login = $_POST['login'];
	$password = $_POST['password'];
	$rpassword = $_POST['rpassword'];
	$email= $_POST['email'];
	$hash = sha1(md5($password));
	$sql_login = "SELECT login FROM users WHERE login='$login'";
	$sql_email = "SELECT email FROM users WHERE email='$email'";

	
		//your site secret key
	$secret = '6Ld53SITAAAAAIu0mN9qKqak4OqZN1_Kf9zPej0o';
	//get verify response data
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
	$responseData = json_decode($verifyResponse);

	
	if($check_login = $connect->query($sql_login))
	{
		$rows_login = $check_login->rowCount();
		echo $rows_login;
	}
	
	if($check_email = $connect->query($sql_email))
	{
		$rows_email = $check_email->rowCount();
		echo $rows_email;
	}

	
	if($rows_login != 0)
	{
		$_SESSION["check"] = "login";
		header("Location: register.php?error=1");
		break;
	}
	
	else if($rows_email != 0)
	{
		$_SESSION["check"] = "email";
		header("Location: register.php?error=2");
		break;
	}
	
	if($responseData->success)
	{
		$register = "INSERT INTO users VALUES('','$login','$hash','$email')";
		if($exec = $connect->query($register))
		{
			
			$add_stats = "SET foreign_key_checks = 0;INSERT INTO `users_stats`(`id_stats`, `rank`, `last_login`, `reputation_points`) VALUES ('','Użytkownik',CURDATE(),'0');";
			
			if($exec2 = $connect -> query($add_stats))
			{
				$_SESSION["check"] = "registered";
				header("Location: register.php?success=1");
			}
		}
		else
		{
			$_SESSION["check"] = "error";
			header("Location: register.php?error=3");
			break;
		}
	}
	
}
$connect -> close();
?>