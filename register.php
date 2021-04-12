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
	<link href="css/register.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script>
		wow = new WOW({
			boxClass: 'wow', // default
			animateClass: 'animated', // default
			offset: 100, // 0 is default
			mobile: true, // default
			live: true // default
		})
		wow.init();
		
		function checkRegistration(){
			var login_znaki = document.forms['form'].login.value.length;
			var password_znaki = document.forms['form'].password.value.length;
			var password = document.forms['form'].password.value;
			var rpassword = document.forms['form'].rpassword.value;
			var login = document.forms['form'].login.value;
			var password = document.forms['form'].password.value;
			var email = document.forms['form'].email.value;
			var rules = document.getElementById('box');
			var v = grecaptcha.getResponse();
			
			
			if(login == "")
			{
				sweetAlert("Ups...", "Login nie może być pusty", "error");
				return false;
			}
			
			if(login == password)
			{
				sweetAlert("Ups...", "Login i hasło nie mogą być takie same!", "error");
				return false;
			}
			
			if(login_znaki < 8)
			{
				sweetAlert("Ups...", "Login nie może mieć mniej niż 8 znaków!", "error");
				return false;
			}
			
			if(password_znaki < 8)
			{
				sweetAlert("Ups...", "Hasło nie moze mieć mniej niż 8 znaków!", "error");
				return false;
			}
			
			if(password != rpassword)
			{
				sweetAlert("Ups...", "Podane hasła różnią się do siebie!", "error");
				return false;
			}
			
			if(email == "")
			{
				sweetAlert("Ups...", "Email nie może być pusty!", "error");
				return false;
			}
			
			if(v.length == 0)
			{
				sweetAlert("Ups...", "Musisz udowodnić, że nie jesteś robotem!", "error");
				return false;
			}

			if (!rules.checked)
			{
				sweetAlert("Ups...", "Nie zaakceptowałeś regulaminu serwisu!", "error");
				return false;
			}
			
			swal({
				  title: "Potwierdzenie",
				  text: "Czy na pewno chcesz się zarejestrować?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					swal("Dziękujemy za rejestrację!");
				  }, 2000);
				  document.getElementById("form").submit();
				});
				
		}
		
		function resetForm()
		{
			swal("Wykonano!", "Pomyślnie wyczyściłeś pola formularza!", "success");
			grecaptcha.reset();
		}
		
	</script>
</head>

<body>
	<div id="register" class="wow animated slideInUp">
		<h1 class="reg-title">Panel Rejestracyjny</h1>
		<hr class="style-one">
<?php
session_start();
if(!isset($_SESSION["check"]))
{
	echo "<center><h1 class='instr' style='color:white;'>Wypełnij pola formularza</h1></center>";
	echo '<form id="form" class="wow animated zoomInDown" action="check_reg.php" onSubmit="return checkRegistration()" method="POST">
			<input class="input" type="text" name="login" placeholder="Login" maxlength="26" minlength="8"/>
			<br/><input class="input" type="password" name="password" placeholder="Hasło" maxlength="26" minlength="8"/>
			<br/><input class="input" type="password" name="rpassword" placeholder="Powtórz Hasło"  maxlength="26" minlength="8"/>
			<br/><input class="input" type="email" name="email" placeholder="E-mail" />
			<br/><div id="captcha" class="g-recaptcha" data-sitekey="6Ld53SITAAAAAMN790ixO2V5oqnA3wdjPNrOTgfX"></div>
			<br/><label><input id="box" type="checkbox" name="akceptuje"><p class="regulamin" >Zapoznałem się i akceptuje regulamin serwisu.</p></label>
			<br/><button  onClick="return checkRegistration()" type="button" class="wow animated fadeInRight" id="button-reg" data-wow-delay="1.0s">Zarejestruj</button>
			<input type="reset" value="Wyczyść" class="wow animated fadeInLeft" id="button-reset" data-wow-delay="1.0s"  onClick="return resetForm()"/>
		</form>
	</div>';
}
if(isset($_SESSION["check"]))
{
	$state = $_SESSION["check"];
	switch ($state)
	{
		case "login":
			echo "<center><h1 class='instr' style='color:#D13E34;text-shadow: 2px 2px 10px red;'>Konto o podanym loginie już istnieje!</h1></center>";
			header("Refresh: 3; url=register.php");
			session_unset("$state");
			break;
		case "email":
			echo "<center><h1 class='instr' style='color:#D13E34;'>Do tego adresu email jest już przypisane konto!</h1></center>";
			header("Refresh: 3; url=register.php");
			session_unset("$state");
			break;
		case "registered":
			echo "<center><h1 class='instr' style='color:green;'>Twoje konto zostało założone! Możesz przejsć do <a style='color:Orange;text-decoration:none;'href='login.php'>logowania</a></h1></center>";
			header("Refresh: 10; url=index.php");
			session_unset("$state");
			break;
		case "error":
			echo "<center><h1 class='instr' style='color:#D13E34;'>Tworzenie konta nie powiodło się!</h1></center>";
			header("Refresh: 3; url=register.php");
			session_unset("$state");
			break;
	}	session_unset("$state");
	//	echo "<a id='button-reset'  style='width:50%; margin:0 auto; height:200px;text-decoration:none;'href='register.php'>Wróć</a>";

}
?>
</body>

</html>