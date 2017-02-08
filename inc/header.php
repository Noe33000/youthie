<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/youthie_form.css">
	<link rel="stylesheet" href="../css/newStyle.css">
	<script src="../js/mode.js"></script>
	<link rel="stylesheet" href="../css/newStyle.css">
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
<div class="wrapper">

<div class="info-bar" style="z-index:10">
    <div class="container">
        <a href="../accueil/"><img title="Faire d'une mission un succès" src="../images/logo_nav.png" style="float:left;margin-top:5px;margin-left: 2.5%;position:relative" /></a>
        <ul id="navbar" style="margin-top:15px;">
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel' && $is_admin == 1) { ?>
                <li><a href="../profil_youthie/" title="PROFIL YOUTHIE"><span style="color:#79b6e4;">PROFIL YOUTHIE</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') { ?>
                <li><a href="../annonces-etudiant/" title="ANNONCES EN LIGNE"><span style="color:#79b6e4;">ANNONCES EN LIGNE</span></a></li>
            <?php } ?>
            <?php if((isset($_SESSION["statut"]) && $_SESSION["statut"] != 'Etudiant') || (!(isset($_SESSION["statut"]))) || (isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel')) {?>
                <li><a href="../qui-sommes-nous/"><span style="color:#79b6e4;">QUI SOMMES-NOUS ?</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') { ?>
                <li><a href="../mission_etudiant/"><span style="color:#79b6e4;">MES MISSIONS</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') { ?>
                <li><a href="../mission_pro/"><span style="color:#79b6e4;">MES MISSIONS</span></a></li>
            <?php } ?>
            <?php if(!(isset($_SESSION["statut"])) || $_SESSION["statut"] == 'Etudiant') {?>
                <li><a href="../espace-etudiants/"><span class="M_con" style="color:#79b6e4;">ESPACE ÉTUDIANTS</span></a></li>
            <?php } ?>
            <?php if(!(isset($_SESSION["statut"]))) {?>
                <li><a href="../pro-connexion/">
                    <div class="rectangle" style="display:inline-block; margin-top: -0.75em;">ESPACE PRO</div>
                </a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') { ?>
                <li><a href="../mon-entreprise/">
                    <div class="rectangle" style="display:inline-block; margin-top: -0.75em;">AJOUTER UNE OFFRE</div>
                </a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') { ?>
                <li><a href="../etudiant/"><span style="color:#79b6e4;">MON PROFIL</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') { ?>
                <li><a href="../professionnel/"><span style="color:#79b6e4;">MON PROFIL</span></a></li>
            <?php } ?>
            <?php if(isset($_SESSION["statut"])) { ?>
                <li><a href="../deconnexion/?quit=oui"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
            <?php } else { ?>
                <!-- <li><a href="../connexioncx">
                        <div class="rectangle" style="display:inline-block;">CONNEXION</div>
                        </a></li> -->
            <?php } ?>
        </ul>
    </div>
</div>
<main>