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
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script src="jav/wow.js"></script>
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
			function addArticle(){
			var title = document.forms['formularz'].title.value;
			var category = document.forms['formularz'].category.value;
			var content = document.forms['formularz'].content.value;
			var image = document.forms['formularz'].image.value;
			
			if(title == "")
			{
				sweetAlert("Ups...", "Tytuł nie może być pusty!", "error");
				return false;
			}
			
			if(category == "")
			{
				sweetAlert("Ups...", "Kategoria nie może być pusta!", "error");
				return false;
			}
			
			if(content == "")
			{
				sweetAlert("Ups...", "Zawartość nie może być pusta!", "error");
				return false;
			}
			
			if(image == "")
			{
				sweetAlert("Ups...", "Artykuł musi mieć obrazek!", "error");
				return false;
			}
			
			swal({
				  title: "Potwierdzenie",
				  text: "Czy na pewno chcesz dodać artykuł?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					swal("Artykuł został dodany!");
				  }, 2000);
				  document.getElementById("formularz").submit();
				});
				
				
		}
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
				Dodaj artykuł
		</h1>
	</div>

	<br/>

	<div id="main">

		<div id="center">
			<h1 style="padding: 20px 0px;">Dodawanie artykułu</h1>
			
			<form id="formularz" action="add_article.php" method="POST" enctype="multipart/form-data" onSubmit="return addArticle()">
			Tytuł artykyłu: <input type="text" name="title"><br/>
			Kategoria: <select name="category">
								<option value=""></option>
							  <option value="Gry">Gry</option>
							  <option value="Filmy">Filmy</option>
							  <option value="Komputery">Komputery</option>
							</select><br/>
			Treść: <br/><textarea name="content" cols="100" rows="20"></textarea><br/><br/><br/>
			 <input type="file" name="image"><br/><br/>
			<br/> <button onClick="return addArticle()" type="button" >Dodaj</button>
			</form>
			<?php 
			if(isset($_SESSION['cant']))
			{
				unset($_SESSION['cant']);
				echo "<br/>Wystąpił błąd! Nie można wrzucać obrazków w innym formacie niż .jpg!";
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

		<?php
			if(isset($_POST['content']))
			{
				require "connect.php";
			
				$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
				$connect -> exec("SET CHARACTER SET utf8");
				
				$author=$_SESSION['login'];
				$category = $_POST['category'];
				$title=$_POST['title'];
				$content=$_POST['content'];
				
				
				$check = "SELECT * FROM posts";
				
				if($execute = $connect->query($check))
				{	
					while($wyniki2 = $execute -> fetch())
					{
						$id = $wyniki2['id'];
					}
					
					$name = $id+1;
					
					$dane='
					
					<?php session_start();?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="../css/posts.css" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/responsiveslides.css" type="text/css">
	<link rel="stylesheet" href="../css/animate.css" type="text/css">
	<script src="../jav/responsiveslides.min.js"></script>
	<script src="../jav/wow.js"></script>
	<script>
	    <script>
        wow = new WOW({
            boxClass:     "wow",      // default
            animateClass: "animated", // default
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
					<a class="menu-top-button" href="../index.php"><i style="margin-right:5px;"class="fa fa-home fa-1x" aria-hidden="true"></i>START</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="../newsy.php?page=1">NEWSY</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="../gallery.php?page=1">GALERIA</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="../downloads.php">POBIERALNIA</a>
				</li>
				<li class="menu-top-li">
					<a class="menu-top-button" href="../about.php">O MNIE</a>
				</li>
			</ul>
		</div>
		<div id="social-links">
			<ol class="social-menu">
			<?php
				if ((isset($_SESSION["zalogowanie"])) && ($_SESSION["zalogowanie"]==true))
				{
							echo <<<END
							<li class="social-button-li">
						<a class="sign-out-icon" href="../logout.php" onClick="return clickButton()">
							<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
						</a>
					</li>
					<li class="social-button-li">
						<a class="profile-icon" href="../profile.php">
							<i class="fa fa-user fa-2x" aria-hidden="true"></i>
						</a>
					</li>
END;
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


		<?php
			require_once "../connect.php";
			
			$connect = new PDO("mysql:host=".$host.";dbname=".$db_name."", $db_user,$db_password);
			$connect -> exec("SET CHARACTER SET utf8");
		
			$zap  = "SELECT * FROM posts WHERE id='.$name.'";
			
		if($wykonaj = $connect->query($zap))
			{
				$wiersze = $wykonaj->rowCount();
			
					$zap2  = "SELECT * FROM posts WHERE id='.$name.'";
					
					if($wykonaj2 = $connect->query($zap2))
					{
						while($wyniki2 = $wykonaj2->fetch())
						{
						
							$id = $wyniki2["id"];
							$title = $wyniki2["title"];
							$content = $wyniki2["content"];
							$author = $wyniki2["author"];
							$date = $wyniki2["date"];
							$modify = $wyniki2["modify"];
							$category = $wyniki2["category"];
														
							echo <<<END
						<div id="logo">
							<h1>
									$title
							</h1>
						</div>
						<br/>


						<br/>

						<div id="main">
							<div id="menu-left">
								<h1 class="menu-left-title">
									Informacje
								</h1>
								<hr class="style-two" style="margin-bottom:5px;"/>
								<p style="text-align:left;color:white;margin-left:5px;padding-top:20px;text-align:center;">Autor: $author</p>
								<p style="text-align:left;color:white;margin-left:5px;text-align:center;">Data: $date</p>
								<p style="text-align:left;color:white;margin-left:5px;text-align:center;">Kategoria: $category</p>
								<h1 style="color:white;margin-top:50px;">Obrazek</h1>
								<img class="post-image" src="../img/post/$id.jpg">
								<br/><br/>
								<p style="text-align:left;color:white;margin-left:5px;text-align:center;">Akutalizacja: $modify</p>
							</div>

							<div id="center">
							<h1 style="text-align:center;">
									$title
							</h1>
							<hr class="style-two" style="margin-bottom:5px;"/>
							$content
							</div>
							
							<div id="logo">
							<h1>
									Komentarze:
							</h1>
						</div>
							
									<div id="fb-root" style="float:left;"></div>
									<script>(function(d, s, id) {
									  var js, fjs = d.getElementsByTagName(s)[0];
									  if (d.getElementById(id)) return;
									  js = d.createElement(s); js.id = id;
									  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.6";
									  fjs.parentNode.insertBefore(js, fjs);
									}(document, "script", "facebook-jssdk"));</script>

									<div class="fb-comments" data-width="400" data-href="https://www.facebook.com/gamerscloud?=post'.$name.'" data-numposts="5"></div>
					
END;
						}
					}
				
			}
			else
			{
				echo "ERROR";
			}
			
			?>
			
			

			
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
				<img src="../img/main/logo-footer.png" alt="blog-logo" />
			</div>
		</div>
	</div>
</body>

</HTML>
						
';
					
						$file_tmp=$_FILES['image']['tmp_name'];
						$file_name=$_FILES['image']['name'];
						$file_size=$_FILES['image']['size'];
						$file_type=$_FILES['image']['type'];
						$location='./img/post/'.$name.".jpg";
						list($width, $height) = getimagesize($file_tmp);
						
						if($file_type!="image/jpeg")
						{
							$_SESSION['cant'] = true;
							header("Location: ./add_article.php?error=1");
							return false;
							exit;
						}
						function resizeImage($filename, $newwidth, $newheight,$name)
						
						{
							list($width, $height) = getimagesize($filename);
							if($width > $height || $newheight < $height)
							{
								$newheight = 200;
							} 
							else if ($width < $height || $newwidth < $width) 
							{
								$width = $newwidth / ($height / $newheight);    
							} 
							else 
							{
								$newwidth = $width;
								$newheight = $height;
							}
							$thumb = imagecreatetruecolor($newwidth, $newheight);
							$source = imagecreatefromjpeg($filename);
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
							imagejpeg($thumb, "./img/post/$name.jpg");
						}
							
						if($file_type=="image/jpeg")
						{
							$myimage = resizeImage("$file_tmp", '200', '200', $name);
							move_uploaded_file($myimage,'./img/post/'.$name.'.jpg');
							rename("./img/post/$file_name.jpg", "./img/post/$name.jpg");
						}
						
						$file_open= fopen("./posts/$name.php","x+");
						$file_name ="./posts/$name.php";
						chmod($file_name, 0777);
						fwrite($file_open,$dane);

						$datetime = date_create()->format('Y-m-d H:i:s');
						$add = "INSERT INTO posts VALUES('$name', '$title', '$content','$datetime', '$author','$datetime', '$category')";
						$connect -> query($add);
						
						header("location: ./posts/$name.php");
						
						ob_end_flush();
				}
				
				
			}
		?>
</body>
</HTML>