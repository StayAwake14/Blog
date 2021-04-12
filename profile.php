﻿<?php session_start();
	if (!(isset($_SESSION['zalogowanie'])) && (!$_SESSION['zalogowanie']==true))
	{
		header("Location: index.php");
		exit();
	}
	else
	{
		require "connect.php";
		
		$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
		$connect -> exec("SET CHARACTER SET utf8");
					
		$id = $_SESSION['id'];
		$login = $_SESSION['login'];
		$rank = $_SESSION['rank'];
		//$reputation = $_SESSION['reputation_points'];
		$last_login = $_SESSION['last_login'];
								
		$update_data = "SELECT * FROM users u INNER JOIN users_stats s WHERE u.login='$login' AND s.id_stats=u.id";

		if($execute = @$connect->query($update_data))
		{
			$row = $execute->fetch();
			$id = $row['id'];
			$login = $row['login'];
			$rank = $row['rank'];
			$reputation = $row['reputation_points'];
		}
		
		
	}
?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="css/profile.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" href="css/responsiveslides.css" type="text/css">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<script src="jav/responsiveslides.min.js"></script>
	<script src="jav/wow.js"></script>
	<script>
		$(function() {
			// Slideshow 4
			$("#slider4").responsiveSlides({
				auto: true,
				pager: false,
				nav: true,
				speed: 500,
				namespace: "callbacks",
				before: function() {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function() {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	    <script>
        wow = new WOW({
            boxClass:     'wow',      // default
            animateClass: 'animated', // default
            offset:       100,        // 0 is default
            mobile:       true,       // default
            live:         true        // default
         })
        wow.init();
    </script>
</head>

<body>
	<!-- MENU-GÓRNE -->
	<div id="top-menu" class="wow animated fadeInDown">
		<div id="menu-area">
			<ul class="menu-settings">
				<li class="menu-top-li">
					<a class="menu-top-button" href="index.php"><i style="margin-right:5px;"class="fa fa-home fa-1x" aria-hidden="true"></i>START</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="newsy.php?page=1">NEWSY</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="gallery.php?page=1">GALERIA</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="downloads.php">POBIERALNIA</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="about.php">O MNIE</a>
				</li>
			</ul>
		</div>
		<div id="social-links">
			<ol class="social-menu">
			<?php
				if ((isset($_SESSION['zalogowanie'])) && ($_SESSION['zalogowanie']==true))
				{
					echo '<li class="social-button-li">
						<a class="sign-out-icon" href="logout.php" onClick="return clickButton()">
							<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
						</a>
					</li>';
					echo '<li class="social-button-li">
						<a class="profile-icon" href="profile.php">
							<i class="fa fa-user fa-2x" aria-hidden="true"></i>
						</a>
					</li>';
				}
					?>
					<li class="social-button-li">
						<a class="social-gg" href="http://google.pl" target="_blank">
							<i class="fa fa-google fa-2x" aria-hidden="true"></i>
						</a>
					</li>
				<li class="social-button-li">
					<a class="social-fb" href="http://facebook.com" target="_blank">
						<i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
					</a>
					</li>
					<li class="social-button-li">
					<a class="social-yt" href="http://youtube.com" target="_blank">
						<i class="fa fa-youtube fa-2x" aria-hidden="true"></i>
					</a>
				</li>
			</ol>
		</div>
	</div>

	<!-- KONIEC MENU-GÓRNE -->

	<br/>

	<div id="logo"><h1><?php echo $login; ?> - Profil</h1></div>

	<br/>

	<div id="main">

		<div id="center">
		<h1 style="padding-top:20px;">Informacje o koncie</h1>
			<div id="profile-info">
				<center><h1>Avatar:</h1>
				<img src="./img/avatar/<?php echo $id; ?>.jpg"/></center><br/>
				<h2 style="margin: 10px 0px;"><i class="fa fa-user-secret" aria-hidden="true"></i> Użytkownik: <?php echo $login; ?> </h2>
				<h2 style="margin: 10px 0px;"><i class="fa fa-shield" aria-hidden="true"> </i>  Ranga: <?php echo $rank; ?> </h2>
				<h2 style="margin: 10px 0px;"><i class="fa fa-trophy" aria-hidden="true"></i> Reputacja: <?php echo $reputation; ?> </h2>
				<h2 style="margin: 10px 0px;"><i class="fa fa-calendar-o" aria-hidden="true"></i> Logowanie: <?php echo $last_login; ?> </h2>
				<?php 
				
				if(isset($_SESSION['zalogowanie']))
				{
					if($rank=="Administrator")
					{
						echo "<h1 style='text-align:center;padding-top:20px;'>Panel Administratora</h1>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='add_article.php'><i class='fa fa-plus' aria-hidden='true'></i> Dodaj artykuł</a><br/>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='edit_article.php'><i class='fa fa-pencil' aria-hidden='true'></i> Edytuj artykuł</a><br/>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='delete_article.php'><i class='fa fa-minus' aria-hidden='true'></i> Usuń artykuł</a><br/>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='add_image.php'><i class='fa fa-plus' aria-hidden='true'></i> Dodaj obraz do galerii</a><br/>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='delete_image.php'><i class='fa fa-minus' aria-hidden='true'></i> Usuń obraz z galerii</a><br/>";						
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='add_files.php'><i class='fa fa-plus' aria-hidden='true'></i> Dodaj plik do pobrania</a><br/>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='delete_files.php'><i class='fa fa-minus' aria-hidden='true'></i> Usuń plik do pobrania</a><br/>";		
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='change_avatar.php'><i class='fa fa-picture-o' aria-hidden='true'></i> Zmień avatar</a><br/>";
					}
					else if($rank=="Użytkownik")
					{
						echo "<h1 style='text-align:center;padding-top:20px;'>Panel Użytkownika</h1>";
						echo "<a class='panel-link' style='display:inline-block;font-size:20px;text-decoration:none;' href='change_avatar.php'><i class='fa fa-picture-o' aria-hidden='true'></i> Zmień avatar</a><br/>";
					}
					
				}	
			
				?>
			</div>
		</div>

		<div id="footer-down" class="wow animated fadeIn" data-wow-delay="0.2s">
			<div id="cp">
				<h2>WYKONANIE</h2>
				<hr class="line-cp" />
				<ul>
					<li>KOD: Jula Dudzińska</li>
					<li>WYGLĄD: Jula Dudzińska</li>
					<h2 style="margin-top:15px;">ALL RIGHTS RESERVED &copy 2016</h2>
				</ul>
			</div>
			<div id="fast-links">
				<h2>KONTAKT</h2>
				<hr class="line-cp2" />
				<ul>
					<li>E-MAIL: juladudzinska@gmail.com <i class="fa fa-envelope-o" aria-hidden="true"></i></li>
					<li>Skype: jjula <i class="fa fa-skype" aria-hidden="true"></i></li>
					<li>Telefon: +48739281732 <i class="fa fa-mobile" aria-hidden="true"></i></li>
				</ul>
			</div>
			<div id="logo-footer" class="wow animated slideInRight" data-wow-delay="0.2s">
				<img src="img/main/logo-footer.png" alt="blog-logo" />
			</div>
		</div>
	</div>
</body>

</HTML>