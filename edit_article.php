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
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
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
		function chooseArticle()
		{
			swal("Wykonano!", "Wybrano artykuł", "success");
			setTimeout(function(){ document.getElementById("formselect").submit(); }, 1500);
		}
		
		function editArticle(){
			var title = document.forms['form'].title.value;
			var category = document.forms['form'].category.value;
			var content = document.forms['form'].content.value;
			var image = document.forms['form'].image.value;
			
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
				  text: "Czy na pewno chcesz edytować ten obrazek?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					swal("Jeszcze chwilę...");
				  }, 1000);
				  setTimeout(function(){ document.getElementById("form").submit(); }, 2000);
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
				Edytuj artykul
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
					if(!isset($_POST['post_name']))
					{
					echo <<<END
					<h1 style="padding: 20px 0px;">Wybierz artykuł</h1>
					<form id="formselect" action="edit_article.php" method="POST" onSubmit="return chooseArticle()">
						<select name="post_name">
END;
					while($wyniki2 = $execute -> fetch())
					{
						$title = $wyniki2['title'];
						echo <<<END
						<option value="$title">$title</option>"
END;
					}

					echo <<<END

							</select><br/><br/>
							<button onClick="return chooseArticle()" type="button">Wybierz</button>
					</form>
					
END;

								
						if(isset($_SESSION['nope']))
						{
							unset($_SESSION['nope']);
							echo "<br/><br/>Wystapil blad! Nie mozna wrzucac obrazków w innym formacie niz .jpg!";
						}
			
					}
					if(isset($_POST['post_name']))
					{
						$post_name = $_POST['post_name'];
					
						$take = "SELECT * FROM posts WHERE title='$post_name'";
						
						
						if($exec = $connect -> query($take))
						{
							
							$dl = $exec -> fetch();
							$title = $dl['title'];
							$content = $dl['content'];
							$category = $dl['category'];
							$id = $dl['id'];
							
							echo <<<END
							<h1 style="padding: 20px 0px;">Edycja artykułu</h1>
							<h1>$title</h1><br/>
							<form id="form" action="edit_article.php" method="POST" enctype="multipart/form-data" onSubmit="return editArticle()">			
							Tytuł artykułu: <input type="text" name="title"><br/><br/>
							Kategoria: <select name="category">
									  <option value="Gry">Gry</option>
									  <option value="Filmy">Filmy</option>
									  <option value="Komputery">Komputery</option>
									</select><br/><br/>
								Treść: <br/><textarea name="content" cols="100" rows="20">$content</textarea><br/><br/><br/>
								<input type="file" name="image"><br/><br/>
								<input type="hidden" name="post_id" value="$id">
								<input type="hidden" name="post_title" value="$title">
							<button onClick="return editArticle()" type="button">Edytuj</button>
							</form>
							</div>
						
						
						
END;
						}
					}
				if(isset($_POST['title']))
				{
					
						$category = $_POST['category'];
						$title_check=$_POST['title'];
						$content=$_POST['content'];
						$name = $_POST['post_id'];
						$post_title = $_POST['post_title'];
						
						$file_tmp=$_FILES['image']['tmp_name'];
						$file_name=$_FILES['image']['name'];
						$file_size=$_FILES['image']['size'];
						$file_type=$_FILES['image']['type'];
						$location='./img/post/'.$name.".jpg";
						list($width, $height) = getimagesize($file_tmp);
						
						if($file_type!="image/jpeg")
						{
							$_SESSION['nope'] = true;
							header("Location: ./edit_article.php");
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
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth,  $newheight, $width, $height);
							imagejpeg($thumb, "./img/post/$name.jpg");
						}
							
						if($file_type=="image/jpeg")
						{
							$myimage = resizeImage("$file_tmp", '200', '200', $name);
							move_uploaded_file($myimage,'./img/post/'.$name.'.jpg');
							rename("./img/post/$file_name.jpg", "./img/post/$name.jpg");
						}

						$datetime = date_create()->format('Y-m-d H:i:s');
						$update = "UPDATE posts SET title='$title_check', content='$content', modify='$datetime' WHERE title='$post_title'";
						$connect -> query($update);
						header("location: ./posts/$name.php");
						
						ob_end_flush();
						
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