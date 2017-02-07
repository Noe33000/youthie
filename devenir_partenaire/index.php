<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/youthie_form.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
	<script src="../js/mode.js"></script>
</head>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-87485637-1', 'auto');
	ga('send', 'pageview');

</script>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper raleway">
	<a href="../menumob/"><div class="nav-toggle"></div></a>
	<?php require '../navbar/navbar.php'; ?>
	<main style="width: 100%;">
		<div id="you_recrute" alt="Présentation partenariat">
			<img id="img_You_Recrute" src="../images/You_recrute.png">
		</div>
		<div id="inscrit_toi">
			<p>Youthie permet aux meilleurs étudiants indépendants de se voir proposer<br> et réaliser des missions rémunérées en 48h.</p>
			<h3 class="raleway" style="font-size: 2.5em;">Inscris toi <a href="#inscription"><img id="ici" src="../images/ici.png"></a></h3>
		</div>

		<div id="few_words">
			<div class="container" id="wrapper-ordi">
				<div class="row">
					<img id="ordi" class="col-sm-8" src="../images/ordi.png">
					<div id="txt_ordi" class="col-sm-4">
						<p id="txt-ordi">
							<span id="title-ord">Youthie en quelques mots</span><br><br>
							Créée en 2016 à Bordeaux, nous sommes <br>
							en voie d'implantation dans plusieurs <br>
							grandes villes de France.<br>
							<br>
							Youthie qu'est ce que c'est ?<br>
							<br>
							C'est une plateforme de mise en relation<br>
							des étudiants avec des entreprises pour <br>
							réaliser des missions freelance.<br> 
						</p>
					</div>					
				</div>
			</div>
			<div class="clear"></div>
			<div id="join" class="container">
				<div id="txt-join" class="left">
					<h4 class="raleway title-join">Tu veux nous rejoindre ?</h4><br>
					<p>	
					<div id="conditions">3 Conditions :</div><br>
					<div>
						<ul class="list-join raleway" style="color: black; padding-left: -5%;">
							<li><span style="color: white;">Avoir plus de 18 ans</span></li>
							<li><span style="color: white;">Etre disponible plusieurs jours/semaine</span></li>
							<li><span style="color: white;">Etre déclaré en tant qu'entrepreneur ou en devenir</span></li>
						</ul>
					</div>
					</p>
				</div>
				<div id="img-join" class="right">
					<img id="img-enfant" src="../images/enfant.jpg">
				</div>
			</div>
			<div class="clear"></div>
			<div id="offer">
				<div id="text-offer">
					<p class="uppercase">Offre pour les 10 premiers inscrits, déclaration statut entrepeneur offert</p>
				</div>
			</div>
			<div id="avantage" class="container">
				<div class="row">
					<div id="img-avantage" class="col-md-6">
						<img class="image-adv" src="../images/avantage.jpg" alt="image illustrant les avantages">
					</div>
					<div id="txt-avantage" class="col-md-6">
						<h4 class="title-advantage">Les avantages</h4>
						<ul class="list-advantage raleway">
							<li><span style="color: white;">10€ par apport et bonus</span></li><br>
							<li><span style="color: white;">Flexibilité  et indépendance dans les emplois du temps</span></li><br>
							<li><span style="color: white;">Gestion des paiements en ligne sécurisé</span></li><br>
							<li><span style="color: white;">Rentable en 3 missions par rapport au choix du statut d'entrepreneur</span></li><br>
						</ul>
					</div>
				</div>
			</div>
			<div id="inscription">
				<form>
					<h2>Inscris toi</h2>
					
				</form>
			</div>
			<div class="clear"></div>
		</div>
	</main>
</div>
<!-- jssor slider scripts-->
<!-- use jssor.js + jssor.slider.js instead for development -->
<!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jssor.slider.mini.js"></script>
<script>
	jQuery(document).ready(function ($) {

		var options = {
			$FillMode: 2,	//[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
			$AutoPlay: true,//[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
			$Idle: 4000,	//[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
			$PauseOnHover: 1,//[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

			$ArrowKeyNavigation: true,	 	//[Optional] Allows keyboard (arrow key) navigation or not, default value is false
			$SlideEasing: $JssorEasing$.$EaseOutQuint,//[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
			$SlideDuration: 800,	//[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
			$MinDragOffsetToSlide: 20,//[Optional] Minimum drag offset to trigger slide , default value is 20
//$SlideWidth: 600,//[Optional] Width of every slide in pixels, default value is width of 'slides' container
//$SlideHeight: 300,	//[Optional] Height of every slide in pixels, default value is height of 'slides' container
			$SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0
			$Cols: 1,//[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
			$ParkingPosition: 0,	//[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
			$UISearchMode: 1,//[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
			$PlayOrientation: 1,	//[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
			$DragOrientation: 1,	//[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)

			$BulletNavigatorOptions: {//[Optional] Options to specify and enable navigator or not
				$Class: $JssorBulletNavigator$,//[Required] Class to create navigator instance
				$ChanceToShow: 2,	//[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: 1,//[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
				$Steps: 1,	//[Optional] Steps to go for each navigation request, default value is 1
				$Rows: 1,	//[Optional] Specify lanes to arrange items, default value is 1
				$SpacingX: 8,//[Optional] Horizontal space between each item in pixel, default value is 0
				$SpacingY: 8,//[Optional] Vertical space between each item in pixel, default value is 0
				$Orientation: 1,	//[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
				$Scale: false//Scales bullets navigator or not while slider scale
			},

			$ArrowNavigatorOptions: {//[Optional] Options to specify and enable arrow navigator or not
				$Class: $JssorArrowNavigator$,//[Requried] Class to create arrow navigator instance
				$ChanceToShow: 1,	//[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: 2,//[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
				$Steps: 1	//[Optional] Steps to go for each navigation request, default value is 1
			}
		};

		var jssor_slider1 = new $JssorSlider$("slider1_container", options);

		//responsive code begin
		//you can remove responsive code if you don't want the slider scales while window resizing
		function ScaleSlider() {
			var bodyWidth = document.body.clientWidth;
			if (bodyWidth)
				jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
			else
				window.setTimeout(ScaleSlider, 30);
		}
		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
		//responsive code end
	});
</script>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>
