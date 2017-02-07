<?php session_start(); 
if(empty($_SESSION)){
	header('Location: ../connexion/');
}    
 else{

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../css/youthie_form.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<script src="../js/mode.js"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-87485637-1', 'auto');
		ga('send', 'pageview');

	</script>
	<script>
		(function( $ ) {

			//Function to animate slider captions
			function doAnimations( elems ) {
				//Cache the animationend event in a variable
				var animEndEv = 'webkitAnimationEnd animationend';

				elems.each(function () {
					var $this = $(this),
						$animationType = $this.data('animation');
					$this.addClass($animationType).one(animEndEv, function () {
						$this.removeClass($animationType);
					});
				});
			}

			//Variables on page load
			var $myCarousel = $('#carousel-example-generic'),
				$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

			//Initialize carousel
			$myCarousel.carousel();

			//Animate captions in first slide on page load
			doAnimations($firstAnimatingElems);

			//Pause carousel
			$myCarousel.carousel('pause');


			//Other slides to be animated on carousel slide event
			$myCarousel.on('slide.bs.carousel', function (e) {
				var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
				doAnimations($animatingElems);
			});
			$('#carousel-example-generic').carousel({
				interval:3000,
				pause: "false"
			});

		})(jQuery);

	</script>
</head>
<body style="font-family: 'Raleway'">
<div class="wrapper">
	<a href="../menumob/"><div class="nav-toggle"></div></a>
	<?php require '../navbar/navbar.php'; ?>
	<!-- GNU General Public License, version 3 (GPL-3.0) -->
	<section>



		<div id="first-slider">
			<div id="carousel-example-generic" class="carousel slide carousel-fade">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<!-- Item 1 -->
					<div class="item active slide1">
						<div class="row"><div class="container">
								<div class="col-md-9 text-left">
									<p data-animation="animated bounceInDown" style="text-align:center; color: white; font-size: 2.5em; font-weight: bold; ">Comment financer ses études<br> ou ses soirées étudiantes ?</p>
									<div style="text-align:center;font-weight:bold;font-size:38px;color:black;text-decoration:underline;padding-bottom:40px;x">
										<?php
										if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') {?>
											<a href="../annonces-etudiant/">
												<button class="btn-lg btn-default">Annonces en ligne !</button>
											</a>
											<?php
										}
										else {?>
											<a href="../inscription/">
												<button class="btn-lg btn-default">Je m'inscris !</button>
											</a>
											<?php
										} ?>
									</div>
								</div>
							</div></div>
					</div>
					<!-- Item 2 -->
					<div class="item slide2">
						<div class="row"><div class="container">
								<div class="col-md-7 text-left">
									<h3 data-animation="animated bounceInDown" style="text-align:center;margin-top:-180px">weworkin est votre espace de travail en équipe</h3>
									<div style="text-align:center;font-weight:bold;font-size:38px;color:black;text-decoration:underline;padding-bottom:40px;margin-top:200px">
										<button class="btn-lg btn-default">Bientôt disponible !</button>
									</div>
								</div>
							</div></div>
					</div>
					<!-- Item 3 -->
					<div class="item slide3">
						<div class="row"><div class="container">
								<div class="col-md-7 text-left">
									<h3 data-animation="animated bounceInDown" style="text-align:center;margin-top:-180px">youteam te permet de trouver des associés ou collaborateurs <span style="color:#3cb5e8">pour ton projet d'entreprise</span> </h3>
									<div style="text-align:center;font-weight:bold;font-size:38px;color:black;text-decoration:underline;padding-bottom:40px;margin-top:200px">
										<button class="btn-lg btn-default">Bientôt disponible !</button>
									</div>
								</div>
							</div></div>
					</div>

				</div>
				<!-- End Wrapper for slides-->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<i class="fa fa-angle-left"></i><span class="sr-only">Précédent</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<i class="fa fa-angle-right"></i><span class="sr-only">Suivant</span>
				</a>
			</div>
		</div>
	</section>

	<?php
	$conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
	//$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
	if($conn->connect_error) {
		die("Connection failed : " . $conn->connect_error);
	}
	if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') {
		$way = "../annonces-etudiant/";
	} else if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') {
		$way ="#";
	} else {
		$way = "../connexion/";
	}
	?>
	<section class="module content" id="offers" style="height:500px;display:block">
		<p style="text-align:center;font-size:36px;margin-bottom:100px">
			Dernières offres en ligne
		</p>
		<?php
		$nb = 0;
		$info = "SELECT * FROM youthie_mission WHERE EtapeMission = '0' ORDER BY STR_TO_DATE(DateParution, '%d/%m/%Y') DESC";
		$result = $conn->query($info);
		while ($nb < 4) {
			$row = $result->fetch_assoc();
			$remuneration = $row['BudgetMission'] / 100;
			$titre = $row['Titre'];
			if ($row['Marketing'] == "on") {
				$src = "../images/marketing.png";
			}
			if ($row['Droit'] == "on") {
				$src = "../images/droit.png";
			}
			if ($row['Finance'] == "on") {
				$src = "../images/finance.png";
			}
			if ($row['Audiovisuel'] == "on") {
				$src = "../images/audiovisuel.png";
			}
			if ($row['Evenementiel'] == "on") {
				$src = "../images/evenementiel.png";
			}
			if ($row['Informatique'] == "on") {
				$src = "../images/informatique.png";
			}
			if ($row['Communication'] == "on") {
				$src = "../images/communication.png";
			}
			if ($row['Graphisme'] == "on") {
				$src = "../images/graphisme.png";
			}
			?>
			<div style="text-align:center;margin-left:4%;width:20%;display:inline-block">
				<a href="<?php echo $way; ?>"><img src="<?php echo $src; ?>" style="width:30%;height:30%"/></a>
				<div >
					<p style="margin-top:10px;">
						<?php echo $titre; ?>
					</p>
				</div>
				<div >
					<p style="display:inline">
						Offre :
					</p>
					<p style="color:#5bcbf0;font-weight:bolder;display:inline">
						Disponible
					</p>
				</div>
				<div >
					<p style="margin-top:10px;display:inline">
						Rémunération :
					</p>
					<p style="color:#5bcbf0;font-weight:bolder;display:inline">
						<?php echo $remuneration; ?> €
					</p>
				</div>

			</div>
			<?php
			$nb++;
		}
		mysqli_close($conn);
		?>
	</section>

	<section class="module content" style="background-color:#5bcbf0;color:#fff;">
		<div class="container">
			<h2 style="color:#fff;text-align:center;margin-bottom:50px">Comment ça fonctionne ?</h2>
			<div class="row" style="text-align:center">
				<div class="col-md-3">
					<div class="circle" style="font-size:80px;margin:auto;margin-top:5px;opacity:0.7;color:white">1</div>
					<p style="text-align:center;font-size:20px;color:#ffffff">
						<br>Pas d’engagement<br>
						sur la durée mais <br>
						sur une mission
					</p>
				</div>
				<div class="col-md-3">
					<div class="circle" style="font-size:80px;margin:auto;margin-top:5px;opacity:0.7;color:white">2</div>
					<p style="text-align:center;font-size:20px;color:#ffffff">
						<br>Pour un travail dans<br>
						le domaine d’étude<br>
						qui te passionne
					</p>
				</div>
				<div class="col-md-3">
					<div class="circle" style="font-size:80px;margin:auto;margin-top:5px;opacity:0.7;color:white">3</div>
					<p style="text-align:center;font-size:20px;color:#ffffff">
						<br>Tu es rémunéré pour ton <br>
						travail et tu peux profiter<br>
						des fruits de ton labeur :)
					</p>
				</div>
				<div class="col-md-3">
					<div class="circle" style="font-size:80px;margin:auto;margin-top:5px;opacity:0.7;color:white">4</div>
					<p style="text-align:center;font-size:20px;color:#ffffff">
						<br>Et si tu en es satisfait,<br>
						tu peux recommencer <br>
						une autre mission
					</p>
				</div>
			</div>
		</div>
	</section>

	<section style="margin-bottom:25px;margin-top:25px">
		<div class="container">
			<div class='row'>
				<div class='col-md-offset-2 col-md-8'>
					<div class="carousel slide" data-ride="carousel" id="my_carousel">
						<!-- Bottom Carousel Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#my_carousel" data-slide-to="0" class="active"></li>
							<li data-target="#my_carousel" data-slide-to="1" ></li>
							<li data-target="#my_carousel" data-slide-to="2" ></li>
							<li data-target="#my_carousel" data-slide-to="3" ></li>
						</ol>

						<!-- Carousel Slides / Quotes -->
						<div class="carousel-inner">

							<!-- Quote 1 -->
							<div class="item active">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/maddyness.jpg" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>Les entreprises doivent être de plus en plus flexibles et les jeunes doivent<br> répondre au casse-­tête insoluble d’avoir déjà de l’expérience avant d’être embauché.<br> Et si l’auto-entrepreneuriat remplaçait le stage ?</p>
											<small>Maddyness</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 2 -->
							<div class="item ">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/leblogdudirigeant.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p> Créer une auto-entreprise peut constituer une aventure intéressante pour un étudiant.<br>
												Cette création doit faire l’objet d’une optimisation et d’une sécurisation susceptibles <br>
												d’être accomplies avec les conseils d’un professionnel.
												Fin de la discussion
											</p>
											<small>Le blog du dirigeant</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 3 -->
							<div class="item ">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/lesechos.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p> Le statut d'auto-entrepreneur (devenu micro-entrepreneur en 2016) a été créé<br> pour faciliter la tâche des personnes désireuses de lancer une activité<br> sans avoir trop de formalités à effectuer ni de charges à payer.
											</p>
											<small>Les echos</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 4 -->
							<div class="item ">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/bbusiness.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>Youthie est une promesse. Une vraie solution pour les étudiants et pour les entreprises.. Une réponse.<br>
												À des études, toujours (trop) longues mais qui s’avèrent encore nécessaires.<br>
												À un marché de l”’indépendant” qui ne cesse de croître. L’adaptation raisonnée à un monde du travail qui évolue.
											</p>
											<small>Bordeaux Business</small>
										</div>
									</div>
								</blockquote>
							</div>


						<!-- Carousel Buttons Next/Prev -->
						<a data-slide="prev" href="#my_carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
						<a data-slide="next" href="#my_carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>

	</section>

<section>
		<a href="https://www.cfe.urssaf.fr/autoentrepreneur/CFE_Bienvenue">
			<img src="../images/esp_etudiant_auto.jpg" style="width:100%;height:1000px">
		</a>


</section>

	<section>
		<div class="container">
			<div class='row'>
				<div class='col-md-offset-2 col-md-8'>
					<div class="carousel slide" data-ride="carousel" id="quote-carousel">
						<!-- Bottom Carousel Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#quote-carousel" data-slide-to="1"></li>
							<li data-target="#quote-carousel" data-slide-to="2"></li>
							<li data-target="#quote-carousel" data-slide-to="3"></li>
						</ol>

						<!-- Carousel Slides / Quotes -->
						<div class="carousel-inner">

							<!-- Quote 1 -->
							<div class="item active">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/car1.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>Youthie, est une belle famille que j’ai eu le plaisir d’integrer en tant qu’Ambassadrice après avoir realiser diverses missions rémunérées en Marketing sur la plateforme.
												L’objectif premier en tant qu’Ambassadrice Youthie dans mon établissement est de participer à l’agrandissement de celle ci et permettre à chaque étudiants inscrit  d’être rémunéré et d’évoluer en mettant en avant leurs competences.</p>
											<small>Aude - BBA INSEEC</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 2 -->
							<div class="item">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/car2.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>"Grace a Youthie, en un clic je m'implique ! Je peux désormais agrémenter mon CV de véritables expériences professionnelles en lien avec mes études, grâce à des missions ponctuelles très bien rémunérées.</p>
											<br><br><small>Sarah Vélard - EFAP</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 3 -->
							<div class="item">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/car3.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>Avec Youthie, plus besoin de chercher un job étudiant à longueur de journée !</p><br><br><br><br>
											<small>Christian - INSEEC</small>
										</div>
									</div>
								</blockquote>
							</div>
							<!-- Quote 4 -->
							<div class="item">
								<blockquote>
									<div class="row">
										<div class="col-sm-3 text-center">
											<img class="img-circle" src="../images/car4.png" style="width: 100px;height:100px;">
										</div>
										<div class="col-sm-9">
											<p>Youthie pour moi, c'est une plateforme qui nous permet en tant qu'étudiants de trouver du travail bien plus facilement et surtout dans le secteur qui nous intéresse. Cette plateforme nous permet de construire un cv riche et valorisant. Je le conseille à tous mes amis en recherche de travail.</p><br><br>
											<small>Marie - KEDGE</small>
										</div>
									</div>
								</blockquote>
							</div>
						</div>

						<!-- Carousel Buttons Next/Prev -->
						<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
						<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="module content">
		<div class="container">
			<h2 class="title">Ils nous soutiennent</h2>
			<p style="text-align:center">
				<img style="margin-right:40px" src="../images/confiance1.png" />
				<img style="margin-right:40px" src="../images/confiance2.png" />
				<img style="margin-right:40px" src="../images/confiance3.png" />
				<img style="margin-right:40px" src="../images/CA.jpg" />
				<img style="margin-right:40px;height:160px;" src="../images/ubeelab.jpg" />
				<img style="height:160px;" src="../images/confiance4.jpg" />
			</p>
		</div>
	</section>

	<script>
		// When the DOM is ready, run this function
		$(document).ready(function() {
			//Set the carousel options
			$('#quote-carousel').carousel({
				pause: true,
				interval: 8000
			});
		});
	</script>
	<script>
		// When the DOM is ready, run this function
		$(document).ready(function() {
			//Set the carousel options
			$('#my_carousel').carousel({
				pause: true,
				interval: 8000
			});
		});
	</script>

</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>
<?php } ?>