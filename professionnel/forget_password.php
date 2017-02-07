<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Youthie : Faire d'une mission un succès</title>
	<link rel="icon" type="image/png" href="../images/favicon.png" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/style.css">
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

	<?php require '../navbar/navbar.php'; ?>

	<main>

		<section id="contact" class="module content" style="height:500px;">
			<div class="container">
				<section class="register-section">
					<div class="title-section">
						<div class="container">
							<div style="margin:0 auto;width: 300px;"><h3>Mot de passe perdu ?</h3></div>
						</div>
					</div>
					<?php
					if(isset($_POST['email'])) {
						$Email = $_POST['email'];
						//$mysqli = new mysqli("localhost","root", "", "arkamitcjfefedb3");
						$mysqli = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
						if($mysqli->connect_error) { die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); }
						$results = $mysqli->query("SELECT id, Avatar, Utilisateur, Email, MotdePasse FROM youthie_professionnels WHERE Email='".$Email."' ");
						while($row = $results->fetch_object()) {
							$_nom = $row->Nom;
							$_prenom 	= $row->Prenom;
							$_email 	= $row->Email;
							$_mot2pass 	= base64_decode($row->MotdePasse);
						}
						$from	   = 'ne-pas-repondre@youthie.io';
						$to		   = $_POST['email'];
						$message   = "Bonjour ".$_prenom." \n\n Voici votre mot de passe de connection à Youthie : ".$_mot2pass."\n";
						$subject   = 'Youthie - Mot de passe';
						$headers   = "From: <".$from.">\n";
						$headers  .= "Reply-To: ".$from."\n";
						$headers  .= 'Content-Type: text/plain; charset="UTF-8"';
						$mail_sent = mail($to, $subject, $message, $headers);
						if($mail_sent) {
							echo '<br><div style="text-align:center">Consultez votre messagerie mail pour réinitialisé votre mot de passe</div><br>';
						}
						$mysqli->close();
					}
					?>
					<form action="#" method="post">
						<div style="margin:0 auto;width:300px;">
							<label for="email">Email*</label>
							<input type="text" name="email" id="email" class="form-control" style="width:300px;" required />
							<br>
							<button style="width: 300px;" class="btn btn-default" type="submit">Réinitialiser le mot de passe</button>
						</div>
					</form>
				</section>
				<br><br><span style="font-size:10px;">Les champs requis sont indiqués *</span>
			</div>
		</section>

	</main>

</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>
