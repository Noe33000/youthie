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
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
	<script src="../js/mode.js"></script>
	<script src="../js/jquery-1.8.3.min.js"></script>
	<script src="../js/responsiveslides.min.js"></script>
	<script src="../js/rslides.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/jquery.fullPage.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery.fullPage.js"></script>
<script>
	$(document).ready(function() {
		$('#fullpage').fullpage();
	});
</script>
	<style>
		.testla {
			background-image:url("../images/fond/1.jpg");
			width:100%;
			height:100%;
			background-repeat: no-repeat;
			background-size: 100%;
		}
	</style>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">
	<a href="../menumob/"><div class="nav-toggle"></div></a>
	<div class="info-bar" style="z-index:4;">
		<div class="container"><a href="../accueil/"><img title="Faire d'une mission un succès" src="../images/logo_nav.png" style="float:left;margin-top:5px;" /></a>
			<ul id="navbar" style="margin-top:15px;">
				<?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') { ?>
					<li><a href="../annonces-etudiant/" title="ANNONCES EN LIGNE"><span style="color:#79b6e4;">ANNONCES EN LIGNE</span></a></li>
				<?php } ?>
				<?php if((isset($_SESSION["statut"]) && $_SESSION["statut"] != 'Etudiant') || (!(isset($_SESSION["statut"]))) || (isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel')) {?>
					<li><a href="../qui-sommes-nous/">QUI SOMMES-NOUS</a></li>
				<?php } ?>
				<?php if(!(isset($_SESSION["statut"]))) {?>
					<li><a href="../espace-etudiants/"><span style="color:#79b6e4;">ESPACE ÉTUDIANTS</span></a></li>
				<?php } ?>
				<?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') { ?>
					<li><a href="#"><span style="color:#79b6e4;">MON ENTREPRISE</span></a></li>
				<?php } ?>
				<?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') { ?>
					<li><a href="../etudiant/"><span style="color:#79b6e4;">MON PROFIL</span></a></li>
				<?php } ?>
				<?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') { ?>
					<li><a href="../professionnel/"><span style="color:#79b6e4;">MON PROFIL</span></a></li>
				<?php } ?>
				<?php if(isset($_SESSION["statut"])) { ?>
					<li><a href="../deconnexion/?quit=oui">SE DÉCONNECTER</a></li>
				<?php } else { ?>
					<li><a href="../connexioncx">SE CONNECTER</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div id="fullpage" style="background-color:#D7EAF1">
		<div class="section " id="section0">
			<div class="col-md-2">

			</div>
			<div class="col-md-8">
				<p style="font-size:52px;color:#000000;text-align:center">
					Comment financer ses études (ou ses soirées<br> étudiantes) tout au long de l’année ?
				</p>
			</div>
		</div>

		<div class="section " id="section1">
			<div class="col-md-4">

			</div>
			<div class="col-md-4" style="border:1px solid #000000;border-radius:20px">
				<div class="circle" style="font-size:80px;margin:auto;margin-top:5px">1</div>
				<p style="text-align:center;font-size:18px;color:#000000">
					<br>Pas d’engagement<br>
					sur la durée mais <br>
					sur une mission
				</p>
			</div>
			<div class="col-md-4">

			</div>
			<div class="col-md-6" style="border-width:1px;border-color:#3CB5E8;margin-bottom:15px;margin-left:25%">
				<p class="espace-etudiant-content" style="margin-top:50px;color:#000000;text-align:center">
					Avoir un contrat étudiant, faire du baby-sitting c’est bien, mais il peut s’avérer difficile de gérer
					les horaires de travail avec l’emploi du temps scolaire qui varie d’une semaine à une autre.
					Tu te sens concerné(e) ? parfait ! <br><br>
				</p>
			</div>
		</div>
		<div class="section" id="section2">
			<div class="col-md-4">

			</div>
			<div class="col-md-4" style="border:1px solid #000000;border-radius:20px">
				<div class="circle" style="font-size:80px;margin:auto;margin-top:5px">2</div>
				<p style="text-align:center;font-size:18px;color:#000000">
					<br>Pour un travail dans<br>
					ton domaine d’étude
				</p>
			</div>
			<div class="col-md-4">

			</div>
			<div class="col-md-6" style="border-width:1px;border-color:#3CB5E8;margin-bottom:15px;margin-left:25%">
				<p class="espace-etudiant-content" style="margin-top:50px;color:#000000;text-align:center">
					Chez Youthie on l’a bien compris, c’est la raison pour laquelle nous proposons une alternative moins contraignante :
					les missions ponctuelles sous le statut d’autoentrepreneur.
					Travailles quand ça t’arrange et dans le domaine qui te correspond !<br><br>
				</p>
			</div>
		</div>
		<div class="section" id="section3">
			<div class="col-md-4">

			</div>
			<div class="col-md-4" style="border:1px solid #000000;border-radius:20px">
				<div class="circle" style="font-size:80px;margin:auto;margin-top:5px">3</div>
				<p style="text-align:center;font-size:18px;color:#000000">
					<br>Tu es rémunéré pour ton <br>
					travail et tu peux profiter<br>
					des fruits de ton labeur :)
				</p>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-6" style="border-width:1px;border-color:#3CB5E8;margin-bottom:15px;margin-left:25%">
				<p class="espace-etudiant-content" style="margin-top:50px;color:#000000;text-align:center">
					On te met en relation avec des entreprises qui recherchent des profils
					universitaires ciblés afin de répondre à un besoin précis, en
					contrepartie d’une rémunération. Il peut s’agir de
					développement front-end, de participer à l’organisation d’un
					événement, de faire des études de marché, de faire de la création
					d’infographie, de photographies ou encore de montages vidéo par
					exemple. <br><br>
				</p>
			</div>
		</div>
		<div class="section" id="section4">
			<div class="col-md-4">

			</div>
			<div class="col-md-4" style="border:1px solid #000000;border-radius:20px">
				<div class="circle" style="font-size:80px;margin:auto;margin-top:5px">4</div>
				<p style="text-align:center;font-size:18px;color:#000000">
					<br>Et si tu en es satisfait,<br>
					tu peux recommencer <br>
					une autre mission
				</p>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-6" style="border-width:1px;border-color:#3CB5E8;margin-bottom:15px;margin-left:25%">
				<p class="espace-etudiant-content" style="margin-top:50px;color:#000000;text-align:center">
					Seule condition nécessaire pour pouvoir bénéficier des offres, c’est
					l’enregistrement au statut d’autoentrepreneur accessible de
					manière gratuite et très rapide au lien suivant :
					<a href="https://www.cfe.urssaf.fr/autoentrepreneur/CFE_Declaration">https://www.cfe.urssaf.fr/autoentrepreneur/CFE_Declaration</a>. Petite
					précision, munis-toi de ta carte d’identité et de ta carte vitale ! <br><br>
				</p>
			</div>
		</div>
	</div>




	<footer>
		<div style="text-align:center;color:#fff;">
			<div style="text-align:right;margin-right:40px;">
				<ul id="footer_menu">
					<li><a href="../nous-contacter/">Nous contacter</a></li>
					<li><a href="../cgu/">CGU</a></li>
					<li><a href="#">Nous connaître</a></li>
					<li><a href="../inscriptioncx/">S'inscrire</a></li>
				</ul>
			</div>
			<h1 style="color:white">Youthie</h1>
			<h3 style="color:white">Faire d'une mission un succès</h3>
			<a href="https://www.facebook.com/helloyouthie/">
				<img title="Facebook" src="../images/facebook.png" />
			</a>
			<a href="https://twitter.com/helloyouthie">
				<img title="Twitter" src="../images/twitter.png" />
			</a>
			<a href="#">
				<img title="Linkdin" src="../images/linkdin.png" />
			</a>
			<a href="#">
				<img title="Viadeo" src="../images/viadeo.png" />
			</a>
			<p style="color:#1A1A1A;">© 2016 Youthie.io, tous droits réservés</p>
		</div>
	</footer>

</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
</html>
