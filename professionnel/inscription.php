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

	<main class="main fond3" style="min-height:700px;padding-top:50px;">

		<section class="main_section">
			<div class="container">
				<h1>Création de compte <br> professionnel</h1>
				<p style="color:black:text-align:center;font-size:18px;">
					L'inscription vous permet de poster vos missions.
				</p>
				<br><!--p>L'inscription vous donne accès à toutes les annonces de missions.</p--><br>
				<?php
				if(isset($_POST['email'])) {
					$Error = 0;

					$Email = base64_encode($_POST['email']);
					//$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
					$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
					if($_conn->connect_error) {
						die("Connection failed : ". $_conn->connect_error);
					}
					$_sql = "SELECT DISTINCT Email FROM youthie_professionnels";
					$_result = $_conn->query($_sql);
					if($_result->num_rows > 0) {
						while($_row = $_result->fetch_assoc()) {
							if($Email == $_row['Email']) {
								$Error=1;
								echo '<div style="text-align:center">Compte déjà enregistré</div>';
							}
						}
					}
					$_conn->close();
					if($Error == 0) {
						$id = uniqid();
						$DateInsc 	= date('d/m/Y');
						$_Utilisateur = $_POST['nom'].' '.$_POST['prenom'];
						$Utilisateur = $_Utilisateur;
						$DatedeNaissance = '01/Janvier/1900';
						$Email = $_POST['email'];
						$phone = $_POST['telephone'];
						$MotdePasse = base64_encode($_POST['motdepasse']);
						$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
						//$conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
						$sql = "INSERT INTO youthie_professionnels (id, DateInscription, Avatar, Utilisateur, DatedeNaissance, AdressePostale, Pays, Mobile, Email, MotdePasse, NomdEntreprise, PaysdEntreprise, SiteWeb) 
VALUES ('".$id."', '".$DateInsc."', '', '".$Utilisateur."', '".$DatedeNaissance."', '', '', '".$phone."', '".$Email."', '".$MotdePasse."', '', '', '')";
						if($conn->connect_error) { die("Connection failed : ". $conn->connect_error); }
						if($conn->query($sql) === TRUE) {
							echo '<br><div style="text-align:center;color:#3CB5E8;font-size:24px">Inscription réussie avec succès</div><br>';
							$_SESSION["statut"] = 'Professionnel';
							$_SESSION["id"] = $id;
							$connectOK=1;
							echo '<meta http-equiv="refresh" content="3; url=../mon-entreprise/">';
						} else {
							echo "Error : ". $sql ."<br>". $conn->error;
						}
						$conn->close();
					}
				}

				?>
				<div class="row">
					<form action="#" method="post">
						<input type="hidden" name="statut" id="statut" value="Etudiant" required>
						<input name="nom" id="nom" class="form-control width" required type="text" placeholder="Nom*" value="" maxlength="20" />
						<br>
						<input name="prenom" id="prenom" class="form-control width" required type="text" placeholder="Prénom*" value="" maxlength="20" />
						<br>
						<input name="telephone" id="telephone" class="form-control width" required type="text" placeholder="Numéro de téléphone*" value="" maxlength="20" />
						<br>
						<input name="email" id="email" class="form-control width" required type="email" placeholder="Adresse mail*" value="" />
						<br>
						<input id="motdepasse" name="motdepasse" class="form-control width" required type="password" placeholder="Mot de passe* (Mininum 8 caractères)" value="" />
						<br>
						<input type="checkbox" name="newsletter" value="news"> Je souhaite recevoir  la newsletter Youthie
						<p style="text-align:right">
							<a href="../pro-connexion/" style="color:#3cb5e8">Déjà inscrit ?</a>
						</p>
						<button class="btn btn-default" type="submit">Envoyez</button>
						<br>
						<br>
						En cliquant sur "Créer mon compte", j'accepte les<a class="link" style="color: #3cb5e8;" href="../cgu/"> Conditions Générales d'Utilisation</a> de Youthie
					</form>
				</div>
			</div>
		</section>

	</main>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>

