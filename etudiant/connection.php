<?php
require_once "../inc/connect.php";
session_start();
var_dump($_SESSION);
var_dump($_POST);

// SI on est déjà connecté
if(!empty($_SESSION)){
	// En tant qu'étudiant
	if($_SESSION['user']['statut'] == 'etudiant'){
		//on est redirigé vers la liste des annonces étudiant
		header('Location: annonces-etudiant.php');
	}
	// En tant que professionel
	if($_SESSION['user']['statut'] == 'entreprise'){
		//On est redirigé vers la liste des missions proposées
		header('Location: ../professionel/mes_missions.php');
	}
}

$errors = [];
$post = [];
$showErrors = false;

if(!empty($_POST)){
	// Permet de nettoyer les données du formulaire. Équivalent à notre foreach() habituel
	$post = array_map('strip_tags', $_POST);
	$post = array_map('trim', $post);

	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre adresse email est invalide';
	}
	if(empty($post['password'])){
		$errors[] = 'Vous devez saisir un mot de passe';
	}
	if(count($errors) == 0){ // Aucune erreur
		// Je récupère l'utilisateur correspondant à l'adresse email
		$select = $conn->prepare('SELECT * FROM studients WHERE email = :email');
		$select->bindValue(':email', $post['email']);
		if($select->execute()){
			$user = $select->fetch(); // Contient notre utilisateur relatif à l'adresse email

			// Si $user n'est pas vide, c'est qu'il y a un utilisateur
			if(!empty($user)){
				// On vérifie le mot de passe saisi et le mot de passe hashé
				var_dump($post['password']);
				var_dump($user['password']);
				var_dump(password_verify($post['password'], $user['password']));
				if(password_verify($post['password'], $user['password'])){
					// Ici le mot de passe est valide donc je stocke mes infos en sessions
					$_SESSION['user'] = [
						'id' 			=> $user['id'],
						'firstname' 	=> $user['firstname'],
						'lastname' 		=> $user['lastname'],
						'email' 		=> $user['email'],
						'statut'		=> $user['statut'],
						'inscription'	=> $user['inscription']
					];

					//Si l'étape inscription est encore sur 1 cad qu'il n'a pas fini de remplir son profile
					if($_SESSION['user']['inscription'] == '1'){
						// Je redirige vers la page "inscription2.php"
						header('Location: inscription2.php');
					}
					else{
						header('Location: annonces-etudiant.php');
					}
					die;
				}
				else {
					// Le mot de passe est invalide
        			$showErrors = true;
					$errors[] = 'Le couple identifiant/mot de passe est invalide1';
				}
			}
			else {
				// Utilisateur inconnu
        		$showErrors = true;
				$errors[] = 'Le couple identifiant/mot de passe est invalide2';
			}
		}
	}
    else {
        $showErrors = true;
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

	<?php require '../inc/header.php'; ?>

	<main class="main fond5" style="min-height:700px;padding-top:150px;">

		<section class="main_section">
			<div class="container">
				<h3>Étudiant : Se connecter</h3>
				
				<?php if($showErrors == true){
					echo '<div class="errConnect alert alert-danger" >';
					foreach ($errors as $err => $value) : ?>
						<ul>
							<li><?php echo $value; ?></li>
						</ul>
					<?php endforeach;
					echo '</div>';
				} ?>
				<div class="container login">
					<div class="row">
						<form action="#" method="post">
							<input class="form-control width" type="text" id="email" name="email" placeholder="Adresse mail" required>
							<br>
							<input class="form-control width" type="password" id="password" name="password" placeholder="Mot de passe" required>
							<br>
							<p>
								<a style="float:left" href="../resetting/">Mot de passe perdu ?</a>
								<a style="color:#3CB5E8;float:right;font-size:18px" href="inscription.php">S'inscrire</a><br>
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
<?php require '../inc/footer.php'; ?>
</html>

