<?php

	session_start();

		if((isset($_POST['login'])) && (isset($_POST['password'])))
		{
			require_once "connect.php";
			
			$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
			$connect -> exec("SET CHARACTER SET utf8");
			$login = $_POST['login'];
			$password = $_POST['password'];
			$hash = sha1(md5($password));
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			$password = htmlentities($hash, ENT_QUOTES, "UTF-8");
			
			
				$sql = "SELECT * FROM users u INNER JOIN users_stats s WHERE u.login='$login' AND u.password='$hash' AND u.id=s.id_stats";
				if($execute = @$connect->query($sql))
				{
					
					$count_users = $execute->rowCount();
					
					if($count_users > 0)
					{
						$update_l = "UPDATE users_stats s INNER JOIN users u SET s.last_login=CURDATE() WHERE u.login='$login' AND s.id_stats=u.id";
						$connect -> query($update_l);
						$_SESSION['zalogowanie']=true;
						$row = $execute->fetch();
						$_SESSION['id'] = $row['id'];
						$_SESSION['login'] = $row['login'];
						$_SESSION['password'] = $row['password'];
						$_SESSION['rank'] = $row['rank'];
						$_SESSION['reputation'] = $row['reputation_points'];
						$_SESSION['last_login'] = $row['last_login'];
						header("Location: index.php");
					}
					else
					{
						$_SESSION['blad'] = '<center><h3 style="color: red;">Nieprawidlowy login lub haslo !</h3></center>';
						header("Location: login.php");
					}
				}
		}
?>