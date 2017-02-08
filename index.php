<?php 
	session_start(); 
	/*if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    if (!isset($_SESSION['user'])) {
        echo '<br>';
        echo "<div class='alert alert-danger' style='color:red; font-size: 60px;'><center><strong>Vous n'avez pas le droit d'accéder a cette page !</strong></center></div>";
        echo '<br>';
        echo '<br>';
        echo '<center><img src="https://media.giphy.com/media/14fs128vvqge3e/giphy.gif"></center>';
      /*  header('Location: ../index.php');

    }
      */

	require_once "inc/connect.php";
	
	//On définie les liens des boutons en fonction de l'état de connexion
	if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') {
		$way = "etudiant/annonces-etudiant.php";
	} else if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') {
		$way ="#";
	} else {
		$way = "etudiant/connexion.php";
	}

	// On instancie les variables qu'on utilisera plus tard
	$isMobile = false;
	$isStudient = false;	
	$isPro = false;
	$link = "../inscription/";
	$error = array();
	$lastAnnonces = array();


	// On vérifie si l'utilisateur est sur mobile.
	require_once 'Mobile-Detect-2.8.24/Mobile_Detect.php';
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) {
		$isMobile = true;	
	}

	// On véfifie si l'utilisateur connecté est un professionnel
	if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') {
		$isPro = true;
		$link = "../mon-entreprise/";
	}elseif (isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') {
		$isStudient = true;	
		$link = "../annonces-etudiant/";
	}

	//On récupère les 4 dernière annonces disponibles
	$req = $conn->prepare('SELECT * FROM youthie_mission ORDER BY STR_TO_DATE(DateParution, "%d/%m/%Y") DESC LIMIT 4');

	if($req->execute()){
		$lastAnnonces = $req->fetchAll(PDO::FETCH_ASSOC);

	}
	else{
		$error[] = 'Impossible de trouver les dernières offres.';
	}
?>
<!-- HEADER -->
<?php include_once 'inc/headerIndex.php'; ?>
<!-- END OF HEADER -->
		<?php if($isMobile == true) : ?>
			<section id="wrapMobile">
				<div id="wrapImgMobile">
					<img id="imgMobile" src="../images/student/7.jpg">
				</div>
				<div class='content'>
					<div >
						<div id="wrapTextImgMobile">
							<p id="textMobile">
								Youthie, la première plateforme de mise en relation directe entre étudiants et professionnels
							</p>
							<?php if($isPro == true){ ?>
								<a href="../mon-entreprise/">
									<div class="rectangle">Publier une mission</div>
								</a>
							<?php } else {?>
								<a href="../pro-inscription/">
									<div class="rectangle">Publier une mission</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
		<?php else :?>
			<section id="SecVideoAcc" class="module content">
				<div id="wrapVideoAcc">

					<video id="videoAcc" width="100%" height="90%" src="../images/Youthie%20-%20Grande.mov" autoplay loop muted></video>
				</div>
				<div class='content'>
					<div >
						<div id="wrapTextVideoAcc">
							<p id="textVideoAcc">
								Youthie, la première plateforme de mise en relation directe entre étudiants et professionnels
							</p>
							<?php if($isPro == true){ ?>
								<a href="../mon-entreprise/">
									<div class="rectangle">Publier une mission</div>
								</a>
							<?php } else { ?>
								<a href="../pro-inscription/">
									<div class="rectangle">Publier une mission</div>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif ?>

		<section class="module content">
			<div class="container">
				<h3 class="title">LA PLATEFORME DE RÉFÉRENCE POUR CONFIER VOS MISSIONS À DES ÉTUDIANTS TALENTUEUX</h3>
				<div id="wrapDomainsAcc">
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/communication.png" height="84px" width="84px" />
								<br><br>COMMUNICATION<br>
							</p>
							<p class="niveau2">
								Interprétation / traduction <br>
								Créations de supports <br>
								Élaboration de stratégie de communication <br>
								Gestion du contenu du site internet <br>
								Référencement / optimisation SEO <br>
								Community management
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine center">
							<p>
								<img src="../images/marketing.png" height="84px" width="84px" />
								<br><br>MARKETING<br>
							</p>
							<p class="niveau2">
								Étude et analyse du marché <br>
								Élaboration d'un plan marketing <br>
								Création campagnes promotionnelles <br>
								Marketing opérationnel - application de la stratégie <br>
								Démarchage commercial <br>
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/evenementiel.png" height="84px" width="84px" />
								<br><br>ÉVÉNEMENTIEL<br>
							</p>
							<p class="niveau2">
								Communication événementielle <br>
								Gestion des relations presse/ publiques <br>
								Organisation d'événements <br>
								Création de décors <br>
								Logistique <br>
								Hôtesse d’accueil <br>
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/finance.png" height="84px" width="84px" />
								<br><br>FINANCE<br>
							</p>
							<p class="niveau2">
								Business plan <br>
								Saisie de pièces comptables <br>
								Analyse financière <br>
								Déclaration de TVA/IS <br>
								Bilan et compte de résultat <br>
								Liasse fiscale
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/audiovisuel.png" height="84px" width="84px" />
								<br><br>AUDIOVISUEL<br>
							</p>
							<p class="niveau2">
								<br>
								Photographies <br>
								Organisation de tournages <br>
								Gestion logistique des équipes <br>
								Préparation de commissions audiovisuelles <br>
								Montages vidéo <br>
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/informatique.png" height="84px" width="84px" />
								<br><br>INFORMATIQUE<br>
							</p>
							<p class="niveau2">
								<br>
								Développement Web <br>
								Développement Mobile <br>
								Administration Base de données <br>
								Automatisation de Tests <br>
								Administration Système <br>
								Administration Réseau <br>
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/graphisme.png" height="84px" width="84px" />
								<br><br>GRAPHISME<br>
							</p>
							<p class="niveau2">
								<br>
								Création de logo <br>
								Charte graphique <br>
								Réalisation d’infographies <br>
								Flyers, bannières publicitaires <br>
								Retouches photos <br>
								Webdesign <br>
							</p>
						</div></a>
					<a href="<?php  echo $link; ?>"><div class="niveau1 domaine">
							<p>
								<img src="../images/droit.png" height="84px" width="84px" />
								<br><br>DROIT<br>
							</p>
							<p class="niveau2">
								Informations juridiques  <br>
								Recherches jurisprudentielles <br>
								Rédaction de conclusion <br>
							</p>
						</div></a>
				</div>
			</div>
		</section>
		<section id="wrapFonctionAcc" class="module content">
			<div class="container">
				<h2 class="title colorWhite">Comment ça fonctionne ?</h2>
				<div class="row center">
					<div class="col-md-3">
						<div class="circle">1</div>
						<div>
							<h2 class="titleCircleAcc">DÉPOSEZ</h2>
							<p>votre mission détaillée <br>
								ainsi que vos attentes <br>
								sur notre plateforme</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="circle">2</div>
						<h2 class="titleCircleAcc">RECEVEZ</h2>
						<p>des profils d'étudiants <br>
							qualifiés, gratuitement <br>
							et sous 48h</p>
					</div>
					<div class="col-md-3">
						<div class="circle">3</div>
						<h2 class="titleCircleAcc">CHOISISSEZ</h2>
						<p>le candidat qui répond <br>
							le mieux à vos attentes <br>
							parmi notre sélection</p>
					</div>
					<div class="col-md-3">
						<div class="circle">4</div>
						<h2 class="titleCircleAcc">PAYEZ</h2>
						<p>uniquement la prestation <br>
							avec le budget prédéfini, <br>
							incluant notre commission</p>
					</div>
				</div>
			</div>
		</section>

		<?php
		
		
		
		?>
		<section id="wrapOffersAcc" class="module content">
			
			<h2 id="titleOffersAcc" class="title">
				Dernières offres en ligne
			</h2>
			<?php

			foreach ($lastAnnonces as $key => $row) {
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
				<div class="annoncesAcc">
					<a href="<?php echo $way; ?>"><img class="imgsAnnoncesAcc" src="<?php echo $src; ?>"></a>
					<div >
						<p class="titleAnnoncesAcc">
							<?php echo $titre; ?>
						</p>
					</div>
					<div >
						<p class="offerAnnoncesAcc">
							Offre :
						</p>
						<p class="dispoAnnoncesAcc">
							Disponible
						</p>
					</div>
					<div >
						<p class="remunAnnoncesAcc">
							Rémunération :
						</p>
						<p class="priceAnnoncesAcc">
							<?php echo $remuneration;?> €
						</p>
					</div>
				</div>
				<?php
			}
			
			?>
		</section>

		<section>
			<div id="wrapperWhy" class="container">
				<div id="wrapperPlus" class="row">
					<h3 id="titleHands">Pourquoi les entreprises passent par <span class="yellow">youthie</span> ?</h3>
					<p id="txt-hands">
						Faire confiance à Youthie c'est confier vos missions au freelance étutiant de votre choix et procéder à un gain de temps et d'argent considérable. 
					</p>
					<div class="col-md-3 wrapPlus">
						<img class="plus_hands" src="../images/plus_blue.png"><br>
						<h3 class="titleCroix">
							Besoin :<br>
						</h3>
						<p class="txtCroix">
							Répondre à une demande effective des start-up, TPE et PME et ed'entreprises en formation.
						</p>	
					</div>
					<div class="col-md-3 wrapPlus">
						<img class="plus_hands" src="../images/plus_blue.png"><br>
						<h3 class="titleCroix">
							Flexibilité :<br>
						</h3>
						<p class="txtCroix">
						Assurer une fléxibilité maximal pour les entreprises dans la mise en relation avec les jeunes.
						</p>
					</div>
					<div class="col-md-3 wrapPlus">
						<img class="plus_hands" src="../images/plus_blue.png"><br>
						<h3 class="titleCroix">
							Coût :<br>
						</h3>
						<p class="txtCroix">
						Minimiser les frais des entreprises pour le permettre de se développer rapidement.
						</p>
					</div>
					<div class="col-md-3 wrapPlus">
						<img class="plus_hands" src="../images/plus_blue.png"><br>
						<h3 class="titleCroix">
							Opportunité :<br>
						</h3>
						<p class="txtCroix">
							Donner la chance aux étudiants talentueux et motivés d'acquérir de l'éxpérience et de financer leur vie étudiante.
						</p>
					</div>
				</div>
			</div>
		</section>
		
		<section id="wrapSoutient" class="module content">
			<div class="container">
				<h2 id="titleSout">Ils nous soutiennent</h2>
				<div class="row">
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/confiance1.png" />
					</div>
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/confiance2.png" />
					</div>
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/confiance3.png" />
					</div>
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/CA.jpg" />
					</div>
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/ubeelab.jpg" />
					</div>
					<div class="col-xs-2 wrapLogoSout">
						<img class="logoSout" src="../images/confiance4.jpg" />
					</div>
				</div>
			</div>
		</section>
	</main> <!-- Fin de  -->
</div>
<?php include_once '../footer/footer.php'; ?>
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
</html>
