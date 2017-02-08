<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/youthie_form.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<script src="../js/mode.js"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-87485637-1', 'auto');
		ga('send', 'pageview');

	</script>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">

	<a href="../menumob/"><div class="nav-toggle"></div></a>

	<?php require 'inc/headerIndex.php'; ?>

	<section>
		<div class="container">
				<div class="img-qui-sommes-nous">
					<p id="txtImgWho">
						Une équipe aux multiples compétences,<br>
						&nbsp un défi: simplifier le freelance étudiant.
					</p>
					<img id="imgWho" src="images/qui-sommes-nous.jpg">
					<a href="#" data-width="700" data-rel="popup1" class="poplight">
						<div id="linkVideo"></div>
					</a>
				</div>
				<div id="popup1" class="popup_block">
					<iframe width="100%" height="500px" src="https://www.youtube.com/embed/V_6oSSyERWo" frameborder="0" allowfullscreen ></iframe>
				</div>
				<div id="ourVision">
					<h2 id="titleNotreVision">Notre <span class="yellow">Vision</span></h2>
					<p id="txtVision">
						Youthie vient d’une idée de deux étudiants en Droit, ils
						travaillent depuis plusieurs mois pour aider les étudiants à
						devenir auto-entrepreneur. Leur objectif est de maximiser
						le nombre d’offre de mission pour que chaque étudiant
						puisse mettre en pratique ses compétences déjà acquises
						et les perfectionner. Pour les entreprises il s'agit de
						satisfaire rapidement leurs besoins en compétences sans 
						avoir la nécessité de faire appel à un salarié ou de passer
						par une agence d’intérim.<br><br>
						Faire de YOUTHIE la plateforme de référence du freelance étudiant est notre objectif !<br>
					</p>
				</div>
			<div class="row">
				<div id="ourTeam">
					<h2 id="titleOurTeam">Notre équipe</h2>
					<div class="col-md-2"></div>
					<div class="col-md-4 wrap-img">
						<img class="imgTeam" src="images/Nicolas.jpg" alt="Photo présentation Nico">
						<a href="https://www.linkedin.com/in/nicolas-ella-10821390" target="_blank">
							<img title="Linkdin" src="images/linkdin.png" />
						</a>
						<br><br><br>
						<p style="line-height: 1.5em" class="name">
							Nicolas Ella<br>
							<span style="font-weight: bold;">COO & Cofounder</span>

						</p>
					</div>
					<div class="col-md-4 wrap-img">
						<img class="imgTeam" src="images/cyril.jpg" alt="Photo présentation Cyril">
						<a href="https://www.linkedin.com/in/cyrilblatha" target="_blank">
							<img title="Linkdin" src="images/linkdin.png" />
						</a>
						<br><br><br>
						<p style="line-height: 1.5em" class="name">
							Cyril B. Latha<br>
							<span style="font-weight: bold;">CEO & Cofounder</span>
						</p>
					</div>
					<div class="col-md-2"></div>
					
					<div class="col-md-4 wrap-img">
						<img class="imgTeam" src="images/Noé.jpg" alt="Photo présentation Noé">
						<a href="https://www.linkedin.com/in/no%C3%A9-champigny-289770124" target="_blank">
							<img title="Linkdin" src="images/linkdin.png" />
						</a>
						<br><br><br>
						<p style="line-height: 1.5em" class="name">
							Noé Champigny<br>
							<span style="font-weight: bold;">CTO</span>
						</p>
					</div>
					<div class="col-md-4 wrap-img">
						<img class="imgTeam" src="images/jade.jpg" alt="Photo présentation Jade">
						<a href="https://www.linkedin.com/in/jade-p-3953b5a3?trk=hp-identity-name" target="_blank">
							<img title="Linkdin" src="images/linkdin.png" />
						</a>
						<br><br><br>
						<p style="line-height: 1.5em" class="name">
							Jade Périer<br>
							<span style="font-weight: bold;">HR & communication manager</span>
						</p>
					</div>
					<div class="col-md-4 wrap-img">
						<img class="imgTeam" src="images/Mohammed.jpg" alt="Photo présentation Mohammed">
						<a href="https://www.linkedin.com/in/mohamed-guelai-382816109" target="_blank">
							<img title="Linkdin" src="images/linkdin.png" />
						</a>
						<br><br><br>
						<p style="line-height: 1.5em" class="name">
							Mohammed Guelai<br>
							<span style="font-weight: bold;">Digital Marketing Consultant</span>
						</p>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row">
				<div id="soutient">
					<h2 id="titleSoutient">Ils nous soutiennent</h2>
					<div class="col-md-4 wrap-img-soutient">
						<img class="imgSoutient" src="images/al.jpg">
						<br><br>
						<h4>Alexandre Savin</h4>
						<p>Chargé de mission entrepreneuriat Ubeelab</p>
					</div>
					<div class="col-md-4 wrap-img-soutient">
						<img class="imgSoutient" src="images/cr.png">
						<br><br>
						<h4>Christophe Riba</h4>
						<p>Fondateur Ulinkoo</p>
					</div>
					<div class="col-md-4 wrap-img-soutient">
						<img class="imgSoutient" src="images/la.jpg">
						<br><br>
						<h4>Laetitia Blondeau</h4>
						<p>Coordinatrice d'entrepreneuriat ECA-PEPITE</p>
					</div>
				</div>
			</div> <!-- FERMETURE ROW -->
		</div> <!-- FERMETURE CONTAINER -->
	</section>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require 'inc/footerIndex.php'; ?>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
	
jQuery(function($){
						   		   
	//Lorsque vous cliquez sur un lien de la classe poplight
	$('a.poplight').on('click', function() {
		var popID = $(this).data('rel'); //Trouver la pop-up correspondante
		var popWidth = $(this).data('width'); //Trouver la largeur

		//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"></a>');
		
		//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		//Apply Margin to Popup
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
		$('body').append('<div id="fade"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
		
		return false;
	});
	
	
	//Close Popups and Fade Layer
	$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});

	
});
</script>
</html>
