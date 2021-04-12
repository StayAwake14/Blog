<?php 

	session_start(); 	

	if ((isset($_SESSION['zalogowanie'])) && ($_SESSION['zalogowanie']==true))
	{
		header("Location: index.php");
		exit();
	}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>JULA - BLOG</title>
	<script src="jav/wow.js"></script>
	<link href="css/login.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script>
			function checkLogin(){
			var login = document.forms['form'].login.value;
			var password = document.forms['form'].password.value;
			
			if(login == "")
			{
				sweetAlert("Ups...", "Login nie może być pusty!", "error");
				return false;
			}
			
			if(password=="")
			{
				sweetAlert("Ups...", "Hasło nie może być puste!", "error");
				return false;
			}
			
			document.getElementById("form").submit();
				
		}
	</script>
</head>

<body>
	<div id="login" class="wow animated tada">
		<h1 class="logowanie">Panel Logowania</h1>
		<h2 class="zaloguj-sie">Podaj swoje dane, aby się zalogować.</h2>
		<hr class="style-one">
		<?php
			if(isset($_SESSION['blad']))
			{
				echo $_SESSION['blad'];
				$_SESSION['blad']=false;
			}
		
		?>
		<form style="margin-top:30px;" id="form"  action="zaloguj.php" method="POST" onSubmit="return checkLogin()" class="wow animated fadeIn">
			<input class="input" type="text" name="login" placeholder="Login">
			<br/> <input class="input" type="password" name="password" placeholder="Hasło">
			<br/>
			<!--<center><input class="box" type="checkbox">
				<h2 class="remember">Zapamiętaj mnie!</h2></center>-->
			<h3 class="suggest">Nie posiadasz jeszcze konta? <a class="clean" href="register.php">Zarejestruj się!</a></h3>
			<br/> <button  onClick="return checkLogin()" id="zaloguj" type="button" >Zaloguj</button>
		</form>
	</div>
</body>

</html>