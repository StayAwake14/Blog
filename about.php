<?php session_start();?>
<!DOCTYPE HTML>
<HTML lang="PL">

<head>
	<title>JULA - BLOG</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" title="main" href="css/about.css" type="text/css">
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
		<h1 class="wow animated rubberBand">
				O Mnie
		</h1>
	</div>

	<br/>

	<div id="main">

		<div id="about-me">
		<h1 style="padding-top:20px;" class="wow animated fadeIn">Kilka słów o mnie</h1>
		<img id="autor" class="wow animated bounceInLeft" src="img/about/autor.jpg" alt="autor Jula Blog"/>
		<p id="about-me-text" class="wow animated slideInRight">
Przedewszystkim witam cie na moim blogu. Nazywam sie Julia Dudzinska. Tak naprawdę nigdy nie lubiłam kotów. Miałam patyczaki, miałam królika, miałam cudownego psa, drugiego, rąbniętego, mam do dzisiaj. Koty były zwierzętami, które niekoniecznie mnie pociągały. Nie kycikiciałam przy każdym napotkanym futrze (co robię teraz), nie wydawałam ostatnich pieniędzy na Gourmeta (co robię teraz), nie planowałam przemeblowania mieszkania pod kątem – tej szafki tu nie może być, bo przecież drapak trzeba postawić (co robię teraz). Po jakimś czasie zrozumiałam – żeby mieszkać z kotem, trzeba do tego dorosnąć. No i dorosłam. Do dzisiaj pamiętam tą radość pomieszaną z przerażeniem kiedy wiozłam z hodowli rozkoszne wszędzie włażące rude kocię. To był William. William – prekursor Pazura. Przeszliśmy razem wiele. Sinusoida uczuć jak z każdym facetem. Tyle, że Will, mimo wszystko, jest stały w uczuciach. Później pojawiła się Milou, rozkoszna trzykolorka znaleziona na śmietniku, odratowana przez sąsiadkę. Niestety jej panowanie w naszym mieszkaniu nie trwało długo. Mając jednak wewnętrzne przekonanie, że mimo braku kocurowatości William potrzebuje jednak kobiety, pojawiła się Lasia z Trójmiasia, najcudowniejsza pod słońcem kotka brytyjska – Gandzia (to ona wpadła na pomysł skręta z kocimiętki). William przeżył, bo to w końcu arystokratka i koty się dotarły, a blog zyskał nową bohaterkę. Doszłam wówczas do wniosku, że dwa koty to ilość kotów optymalna. Jakże się jednak myliłam. Optymalna ilość kotów to trzy o czym przekonał mnie Mefisto, który wylazł z piekieł i rozłożył się na naszej zielonej kanapie. Blog zatem zrobił się rudo-szaro-czarny. 		</p>
		
		</div>
		
		<div id="interests">
		<h1 class="wow animated fadeIn">Moje ulubione rasy:</h1>
		<p style="text-align:justify;padding:15px;" class="wow animated slideInLeft">
Istnieje ponad 100 ras i odmian barwnych kota domowego. Pojęcie kota rasowego pojawiło się wraz z kocimi wystawami. Pierwsza odbyła się w roku 1871 w Pałacu Kryształowym w Londynie. Zaprezentowano wówczas brytyjskie koty krótkowłose i koty perskie. W tym samym czasie odbyła się pierwsza wystawa amerykańska, poświęcona tylko jednej rasie kotów - maine coon. Jest to jedna z moich ulubionych ras kotow.maine cooin jest jednym z największych kotów domowych. Kocury ważą do 10 kg. Rasa występuje w wielu odmianach kolorystycznych. Mainkun jest łagodny, bardzo przywiązuje się do właścicieli, ale potrzebuje dużej przestrzeni. Uwielbia siedziec na balkonie lub w ogrodzie. Znany jest z tego, że zasypia w dziwacznych miejscach przybierając oryginalne pozy. Druga moja ulubiona rasa ktoe jest kot Rosyjski. Cechą charakterystyczną kotów tej rasy jest niezwykle gęsta, przypominająca plusz, sierść. Składa się ona z dwóch rodzajów włosa. Kot ma bardzo zróżnicowane usposobienie - zależnie od tego, który z przodków da o sobie znać. Najczęściej jest nieśmiałym domatorem i raczej nie wybiera się na dłuższe wycieczki. Kolejna ras, ktora wywarla na mnie duze wrazenie jest Amerykański curl. Ma on charakterystyczne zagięte chrząski uszu. Rasa wcale nie jest pomysłem hodowców. Tę spontaniczną krzyżówkę zauważono po raz pierwszy w 1981r w Kalifornii. niestety nie ma jeszcze hodowli w Polsce.		</p>
		<br/>
		<h1 class="wow animated fadeIn">Dlaczego kochamy koty??</h1>
		<br/>
		<div style="display:block;text-align:center;width:100%;" >
			<img style="border-radius:300px;display:inline-block;"  src="img/about/cat1.jpg"  width="25%"  alt="Jula Blog gra" class="wow animated bounceInLeft"/>
			<img style="border-radius:300px;display:inline-block;margin-right:100px;margin-left:100px;"  src="img/about/cat2.jpg"  width="25%" width="25%" alt="Jula Blog gra" class="wow animated bounceInUp"/>
			<img style="border-radius:300px;display:inline-block;"  src="img/about/cat3.jpg" width="25%" alt="Jula Blog gra" class="wow animated bounceInRight"/>
		</div>
		<br/><br/>
		<p style="clear:both;display:block;text-align:justify;padding:15px;" class="wow animated bounceInUp">
Historia nagromadziła mnóstwo przesądów, legend, dziwacznych opowieści, których rodowód sięga pierwotnch wierzeń o charakterze religijnym. W historii Europy kot dość długo był uważany za zwierzę magiczne. Podczas gdy pies dość długo należał do naszego otoczenia jako wierny i wypróbowany przyjaciel, kot pojawił się jako usposobienie niezależności. Przez wieki symbolizaował tajemniczość natury, niekiedy także jej groźne obszary, nie poddajace się woli ludzkiej.
Kot nie bez racji nazywany była samotnikiem chodzącym własnymi drogami. W tym sensie niezależność kota wydaje się oczywista. Człowiek, który chciałby naruszyć integralność kociej natury i postępować z kotem tak, jak sie zwykło postępować z psem, napotka opór i nie zdobedzie przyjaźni.
Niektórzy ludzie powtarzają niedorzeczne sądy, że pies jest wierny, kot natomiast fałszywy. Jest to oczywiście bezzasadne przenoszenie na zwierzęcie ludzkich sposobów postępowania. Z tego należy sobie zdawać sprawę.
Człowiek ruchliwy, dynamiczny znajdzie idealnego przyjaciela wśród nieprzeliczonej rzeszy psów, zarówno rasowych jak i mieszańców.
Natomiast człowiekowi o skłonnościach domatorskich, spragnionemu równego, spokojnego rytmu życia, kochającemu piękno, a także wyposażonemu w pewne cechy refleksyjne, lepiej będzie odpowiadał kot, bez względu na to, czy to będzie kot rasowy, czy też pospolity dachowiec.
Bo przecież najzwyklejszy buras żyjący w piwnicy ma w swej naturze wszystkie skarby owej niezależności i wyniosłości, która tak ogromnie pociąga ludzi.		</p>
		<br/>
		<h1 style="padding-top:20px;" class="wow animated fadeIn">Zakończenie</h1>
		<img style="float:left;display:block;border-radius:300px;margin-right:25px;margin-left: 25px;" height="200" width="200"src="img/about/smile.jpg" alt="smile Jula Blog"/>
		<p style="display:block;text-align:justify;padding:15px;" class="wow animated slideInRight">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tincidunt risus ut arcu imperdiet, eu pharetra dolor vulputate. Nulla facilisi. Morbi convallis massa tellus, sed tempus nulla congue ut. Fusce ac luctus massa, a volutpat libero. Mauris diam urna, lacinia non dictum sed, pulvinar convallis odio. Donec tortor leo, tincidunt quis condimentum vel, facilisis ut enim. Cras porta, nulla ac pulvinar consectetur, magna leo cursus nunc, in pharetra magna purus in neque. Nulla at odio non neque tempor tincidunt. Pellentesque at dui at justo accumsan laoreet. Sed mollis lectus eu orci egestas, id vulputate orci feugiat. Suspendisse ullamcorper feugiat dolor, eget bibendum augue finibus vehicula. Suspendisse pellentesque metus augue, nec ullamcorper nibh pellentesque at. 
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tincidunt risus ut arcu imperdiet, eu pharetra dolor vulputate. Nulla facilisi. Morbi convallis massa tellus, sed tempus nulla congue ut. Fusce ac luctus massa, a volutpat libero. Mauris diam urna, lacinia non dictum sed, pulvinar convallis odio. Donec tortor leo, tincidunt quis condimentum vel, facilisis ut enim. Cras porta, nulla ac pulvinar consectetur, magna leo cursus nunc, in pharetra magna purus in neque. Nulla at odio non neque tempor tincidunt. Pellentesque at dui at justo accumsan laoreet. Sed mollis lectus eu orci egestas, id vulputate orci feugiat. Suspendisse ullamcorper feugiat dolor, eget bibendum augue finibus vehicula. Suspendisse pellentesque metus augue, nec ullamcorper nibh pellentesque at. 	
		</p>
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