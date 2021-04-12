<?php session_start(); ob_start() ;?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="css/downloads.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
	<script>
		function deleteArticle(){
			var post_name = document.forms['form'].post_name.value;
			
			if(post_name == "")
			{
				sweetAlert("Ups...", "Tytuł nie może być pusty!", "error");
				return false;
			}
					
			swal({
				  title: "Potwierdzenie",
				  text: "Czy na pewno chcesz usunąć artykuł?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					swal("Artykuł został skasowany!");
				  }, 2000);
				  document.getElementById("form").submit();
				});
		}
		
	</script>
</head>

<body>
	<!-- MENU-G�RNE -->
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

	<!-- KONIEC MENU-G�RNE -->

	<br/>

		<div id="logo">
		<h1>
				Usuń artukułu
		</h1>
	</div>

	<br/>

	<div id="main">

		<div id="center">
		
				<?php
				require "connect.php";
			
				$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
				$connect -> exec("SET CHARACTER SET utf8");
				
				$check = "SELECT * FROM posts";
			
			if($execute = $connect->query($check))
			{	
					$name = $execute->rowCount();
					if(!isset($_POST['send']))
					{
					echo <<<END
					<h1 style="padding: 20px 0px;">Wybierz artykuł</h1>
					<form id="form" action="delete_article.php" method="POST" onSubmit="return deleteArticle()" >
						<select name="post_name">
END;
					while($wyniki2 = $execute -> fetch())
					{
						$title = $wyniki2['title'];
						echo <<<END
						<option value="$title">$title</option>";
END;
					}

					echo <<<END
							</select><br/><br/>
							<button onClick="return deleteArticle()" type="button">Usuń</button>
					</form>
					
END;
					}
					
					if(isset($_POST['post_name']))
					{
						$title=$_POST['post_name'];
						
						$sql_for_id = "SELECT * FROM posts WHERE title='$title'";
						
						if($exec = $connect -> query($sql_for_id))
						{
							
							$rows = $exec->fetch();
							$id = $rows['id'];
						
							unlink('./img/post/' . $id . '.jpg');
							unlink('./posts/' . $id . '.php');
							$delete = "DELETE FROM posts WHERE title='$title'";
							$connect -> query($delete);
							
							header("location: ./delete_article.php");
							
							echo "<br/>Usuwanie postu powiodło się!";
						
							ob_end_flush();
						}
					}
						
						
			}
			
		?>
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