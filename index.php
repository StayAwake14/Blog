﻿<?php session_start();?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="css/styles.css" type="text/css">
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

	<div id="logo">
		<h1>
				Jula Blog - dzielmy się wspólnie codziennymi wydarzeniami!
		</h1>
	</div>
	<br/>

	<!-- Slideshow 4 -->
	<div class="callbacks_container">
		<ul class="rslides" id="slider4">
			<li>
				<img src="img/slider/1.jpg" alt="Jula-Blog">
				<p class="caption">Witaj na stronie mojego bloga!</p>
			</li>
			<li>
				<img src="img/slider/2.jpg" alt="Jula-Blog">
				<p class="caption">Przeżyj razem ze mną wydarzenia z życia codziennego!</p>
			</li>
			<li>
				<img src="img/slider/3.jpg" alt="Jula-Blog">
				<p class="caption">Odwiedź również moje social strony.</p>
			</li>
		</ul>
	</div>

	<br/>

	<div id="main">
		<div id="menu-left">
			<h1 class="menu-left-title">
				MENU
			</h1>
			<hr class="style-two" />
			<ul class="menu-left-settings">
				<li class="menu-left-li"><a class="menu-left-button" href="index.php">START</a></li>
				<li><a class="menu-left-button" href="gallery.php?page=1">GALERIA</a></li>
				<li><a class="menu-left-button" href="downloads.php">POBIERALNIA</a></li>
				<li><a class="menu-left-button" href="login.php">LOGOWANIE</a></li>
				<li><a class="menu-left-button" href="register.php">REJESTRACJA</a></li>
				<li><a class="menu-left-button" href="about.php">O MNIE</a></li>
			</ul>
		</div>

		<div id="center">
			<h1 class="center-title">
				NAJNOWSZE NEWSY
			</h1>
		<?php
			require_once "connect.php";
			
			$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
			$connect -> exec("SET CHARACTER SET utf8");
			
			$limit = 10;
		
			$zap  = 'SELECT * FROM posts LIMIT '.$limit.'';
			
		if($wykonaj = $connect->query($zap))
			{
				$wiersze = $wykonaj->rowCount();
			
					$zap2  = 'SELECT * FROM posts order by id DESC  LIMIT '.$limit.'';
					
					if($wykonaj2 = $connect->query($zap2))
					{
						while($wyniki2 = $wykonaj2->fetch())
						{
						
							$id = $wyniki2['id'];
							$title = $wyniki2['title'];
							$content = $wyniki2['content'];
														
							echo <<<END
								<div id="post" class="wow animated fadeIn" data-wow-delay="0.1s">
									<img class="post-image" src="img/post/$id.jpg">
									<a class="post-link" href="posts/$id.php"><h1 class="post-title">$title</h1></a>
									<hr class="style-two" style="margin:10px 0px;" />
									<p class="post-content">
										$content
									</p>
								</div>
END;
						}
					}
				
			}
			else
			{
				echo "ERROR";
			}
			
			?>
		</div>

		<div id="menu-right">

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