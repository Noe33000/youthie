<?php
session_start();
if(isset($_POST['email'])) {
	$connectOK 	= 0;
	$Email = $_POST['email'];
	$MotdePasse = base64_encode($_POST['motdepasse']);
	//$mysqli = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
	$mysqli = new mysqli("localhost","root", "", "arkamitcjfefedb3");
	if($mysqli->connect_error) { die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); }
	$results = $mysqli->query("SELECT id, Avatar, Utilisateur, Email, MotdePasse FROM youthie_etudiants WHERE Email='".$Email."' AND MotdePasse='".$MotdePasse."' ");
/*echo $Email;
var_dump($results);*/
	while($row = $results->fetch_object()) {
		$_SESSION["statut"] = 'Etudiant';
		$_SESSION["id"] 	= $row->id;
		$_SESSION["avatar"] = $row->Avatar;
		$_Utilisateur 		= $row->Utilisateur;
		$Utilisateur 		= explode(" ", $_Utilisateur);
		$_SESSION["nom"] 	= $Utilisateur[0];
		$_SESSION["prenom"] = $Utilisateur[1];
		$connectOK=1;
	}
	$mysqli->close();
	if($connectOK <> 0) {
		sleep(2); header("Location: ../annonces-etudiant/");
	} else {
		echo '<div style="text-align:center">Compte inexistant, veuillez-vous inscrire</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
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
<div class="wrapper">

	<a href="../menumob/"><div class="nav-toggle"></div></a>

	<?php require '../navbar/navbar.php'; ?>

	<main class="main fond5" style="min-height:700px;padding-top:150px;">

		<section class="main_section">
			<div class="container">
				<h3>Étudiant : Se connecter</h3>
				<div class="container login">
					<div class="row">
						<form action="#" method="post">
							<input class="form-control width" type="text" id="email" name="email" placeholder="Adresse mail" required />
							<br>
							<input class="form-control width" type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required />
							<br>
							<p>
								<a style="float:left" href="../resetting/">Mot de passe perdu ?</a>
								<a style="color:#3CB5E8;float:right;font-size:18px" href="../inscription/">S'inscrire</a><br>
							</p>

							<button class="btn btn-default" type="submit">Envoyez</button>
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>

