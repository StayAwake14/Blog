<?php session_start();ob_start();?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="css/add_image.css" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/animate.css" type="text/css">
	<script src="sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
	<script>
		function checkUpload(){
			var title = document.forms['form'].title.value;
			var image = document.forms['form'].image.value;
			
			
			if(title == "")
			{
				sweetAlert("Ups...", "Tytuł nie może być pusty!", "error");
				return false;
			}
			
			if(image == "")
			{
				sweetAlert("Ups...", "Wybierz obrazek do wrzucenia!", "error");
				return false;
			}
			
			swal({
				  title: "Potwierdzenie",
				  text: "Czy na pewno chcesz dodać obrazek do galerii?",
				  type: "info",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
				},
				function(){
				  setTimeout(function(){
					swal("Przesyłanie obrazka powiodło się!");
				  }, 2000);
				  document.getElementById("form").submit();
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
				Dodaj obrazek do galerii
		</h1>
	</div>

	<br/>

	<div id="main">

		<div id="center">
		<h1>Wybierz obrazek do wrzucenia</h1><br/><br/>
			<form id="form" action="add_image.php" method="POST" enctype="multipart/form-data" onSubmit="return checkUpload()" >
					Tytuł obrazka: <input type="text" name="title"><br/><br/>
				    <input type="file" name="image"><br/><br/>
					<button onClick="return checkUpload()" type="button" id="button-upload" data-wow-delay="1.0s">Wrzuć</button>
			</form>
		
		<?php
		if(isset($_POST['title']))
		{
			
			require_once "connect.php";
			require_once './phpthumb/ThumbLib.inc.php';
			
			$connect = new PDO('mysql:host='.$host.';dbname='.$db_name.'', $db_user,$db_password);
			$connect -> exec("SET CHARACTER SET utf8");
			$options = array('resizeUp' => true,);
 
			$title = $_POST['title'];
			$sql = "SELECT * FROM gallery";
			
			
			if($wykonaj = $connect->query($sql))
			{
				
				while($wyniki2 = $wykonaj -> fetch())
				{
					$id = $wyniki2['id_gallery'];
				}
				
				$name=$id+1;
					
				
				$file_tmp=$_FILES['image']['tmp_name'];
				$file_name=$_FILES['image']['name'];
				$file_size=$_FILES['image']['size'];
				$file_type=$_FILES['image']['type'];
				$location='./img/gallery/min/gallery'.$name.".jpg";
				list($width, $height) = getimagesize($file_tmp);
				
				if($width < 450)
				{
					echo "<br/><br/>Wystąpił błąd! Szerokość pliku nie może być mniejsza niż 450px!";
					return false;
					exit;
				}
				
				if($height < 400)
				{
					echo "<br/><br/>Wystąpił błąd! Wysokość pliku nie może być mniejsza niż 400px!";
					return false;
					exit;
				}
					
				if($file_type=="image/jpeg")
				{
					$img = @PhpThumbFactory::create("$file_tmp", $options);
					$img->save("./img/gallery/gallery$name.jpg");
					$img_min = @PhpThumbFactory::create("$file_tmp", $options);
					$img_min->resize(450, 400)->save("./img/gallery/min/gallery$name.jpg");
					echo "<br/><br/>Obrazek gallery".$name." został przesłany do galerii!";
				}
				else
				{
					echo "<br/><br/>Wystąpił błąd! Nie można wrzucać obrazków w innym formacie niż .jpg!";
					return false;
					exit;
				}
				
				$add_image = "INSERT INTO gallery VALUES('$name','$title')";
				
				@$connect -> query($add_image);
				
				header("location: gallery.php?page=1");
						
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