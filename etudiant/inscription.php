<?php 
require_once "../inc/connect.php";
//include_once "../inc/fonctions.php";
session_start();

/*Définition des variables*/
$exist = false;
$msgConfirm = false;
$showErr = false;
$errors = array();


if(isset($_SESSION) && !empty($_SESSION)){
	header('Location: ../accueil');
}

if(!empty($_POST)){
	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	}	

	if(strlen($post['firstname']) < 2 || strlen($post['firstname']) > 15){
		$errors[] = 'Votre prénom doit contenir entre 2 et 15 caractères';
	}

	if(strlen($post['lastname']) < 2 || strlen($post['lastname']) > 20){
		$errors[] = 'Votre nom doit contenir entre 2 et 20 caractères';
	}

	if(strlen($post['password']) < 8){
		$errors[] = 'Votre mot de passe doit contenir au moins 5 caractères';
	}

	if(strlen($post['phone']) < 10){
		$errors[] = 'Votre numéro de télphone doit être valide.';
	}

	if($post['password'] != $post['password_confirm']){
		$errors[] = 'Votre mot de passe n\'est pas identique';
	}
	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Votre adresse email n\'est pas valide';
	}
	if(!isset($post['day']) || !isset($post['month']) || !isset($post['year'])){
		$errors[] = 'Veuillez indiquer votre date de naissance.';
	}
	else{
		if($post['day'] < 10){
			$day = '0'.$post['day'];
		}
		else{
			$day = $post['day'];
		}
		$birthdate = date_create($post['year'].'-'.$post['month'].'-'.$day);
		$birthdate = $birthdate->format('Y-m-d');
	}
	if(count($errors) === 0){
		
		// On va chercher l'adresse mail dans la bbd pour voir si un compte existe déjà
		$req = $conn->prepare('SELECT * FROM studients WHERE email = :email');
		$req->bindParam(':email', $post['email']);

		if($req->execute()){
			$exist = $req->fetchAll(PDO::FETCH_ASSOC);
		}
		if(!empty($exist)){
			$errors[] = 'Ce compte existe déjà.';
		}
		// Ici l'adresse mail n'existe pas, on peut donc créer le compte
		else{
			
			$res = $conn->prepare('INSERT INTO studients (`firstname`, `lastname`, `password`, `email`, `phone`, `birthdate`, `date_inscription`, `inscription`)
				VALUES (:firstname, :lastname, :password, :email, :phone, :birthdate, NOW(), :inscription)');
			$res->bindParam(':firstname', $post['firstname']);
			$res->bindParam(':lastname', $post['lastname']);
			$res->bindParam(':password', $password);
			$res->bindParam(':email', $post['email']);
			$res->bindParam(':phone', $post['phone']);
			$res->bindParam(':birthdate', $birthdate);
			$res->bindParam(':inscription', '1', PDO::PARAM_INT);

			// Si l'inscription s'est bien déroulé
			if ($res->execute()) {
				$msgConfirm = true;

				// S'il a accepté la newsletter, on l'ajoute dans la table Newsletter
				if($post['newsletter'] == 'news'){
					$news = $conn->prepare('INSERT INTO newsletter (email, date_inscription) VALUES (:email, NOW())');

					$news->bindParam(':email', $post['email']);
					$news->execute();
				}

				// On connect ce nouvel utilisateur
				$req = $conn->prepare('SELECT id FROM studients WHERE email = :email');

				$req->bindParam(':email', $post['email']);
				if($req->execute()){
					$infoUser = $req->fetch(PDO::FETCH_ASSOC);
					echo $infoUser['id'];
				}
				$_SESSION['user'] = [
					'id' 		=> $infoUser['id'],
					'firstname' => $post['firstname'],
					'lastname' 	=> $post['lastname'],
					'email' 	=> $post['email'],
				];
				// Puis on le redirige vers la deuxième page de connexion
				header('Location: ../accueil');
			}
			else{
				$errors[] = 'Erreur lors de l\'inscription';
			}
		}
	}
	if(!empty($errors)){
		$showErr = true;
		if(!isset($post['newsletter'])){
			$post['newsletter'] = flase;
		}
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
	<link rel="stylesheet" href="../css/youthie_form.css">
	<link rel="stylesheet" href="../css/newStyle.css">
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

	<?php require '../inc/navbar/navbar.php'; ?>

	<main class="main fond3">

		<section class="main_section">
			<div class="container">
				<h1>Création de compte <br> étudiant</h1>
				<br><p>L'inscription vous donne accès à toutes les annonces de missions.</p><br>
				<?php if ($msgConfirm == true) {
					echo '<div class="alert alert-success">Inscription OK !!</div>';
				}
				if($showErr == true){
					echo '<div class="errConnect alert alert-danger" >';
					foreach ($errors as $err => $value) : ?>
						<ul>
							<li><?php echo $value; ?></li>
						</ul>
					<?php endforeach;
					echo '</div>';
				}
				?>

				<div class="row">
					<form action="#" method="post">

						<input name="lastname" id="lastname" class="form-control width" required placeholder="Nom*" value="<?php if($showErr == true){echo $post['lastname'];} ?>" maxlength="20">
						<br>
						<input name="firstname" id="firstname" class="form-control width" required placeholder="Prénom*" value="<?php if($showErr == true){echo $post['firstname'];} ?>" maxlength="20">
						<br>
						<div class="col-md-4 form-date">
							<select name="day" class="form-control grey">
								<option class="grey" value="" selected disabled>Jour</option>
								<?php
									for ($i= 1; $i < 31; $i++) {
										if($post['day'] == $i){
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										}
										else{
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="col-md-4 form-date">
							<select name="month" class="form-control grey">
								<option class="grey" value="" selected disabled>Mois</option>
								<option value="01" <?php if($showErr == true && $post['month'] == '01'){echo 'selected';}?> >Janvier</option>';
								<option value="02" <?php if($showErr == true && $post['month'] == '02'){echo 'selected';}?>>Février</option>';
								<option value="03" <?php if($showErr == true && $post['month'] == '03'){echo 'selected';}?>>Mars</option>';
								<option value="04" <?php if($showErr == true && $post['month'] == '04'){echo 'selected';}?>>Avril</option>';
								<option value="05" <?php if($showErr == true && $post['month'] == '05'){echo 'selected';}?>>Mai</option>';
								<option value="06" <?php if($showErr == true && $post['month'] == '06'){echo 'selected';}?>>Juin</option>';
								<option value="07" <?php if($showErr == true && $post['month'] == '07'){echo 'selected';}?>>Juillet</option>';
								<option value="08" <?php if($showErr == true && $post['month'] == '08'){echo 'selected';}?>>Août</option>';
								<option value="09" <?php if($showErr == true && $post['month'] == '09'){echo 'selected';}?>>Septembre</option>';
								<option value="10" <?php if($showErr == true && $post['month'] == '10'){echo 'selected';}?>>Octobre</option>';
								<option value="11" <?php if($showErr == true && $post['month'] == '11'){echo 'selected';}?>>Novembre</option>';
								<option value="12" <?php if($showErr == true && $post['month'] == '12'){echo 'selected';}?>>Décembre</option>';
							</select>
						</div>
						<div class="col-md-4 form-date">
							<select name="year" class="form-control grey">
								<option value="" selected disabled>Année</option>
								<?php
									for ($i= 1950; $i < 2005; $i++) {
										if($post['year'] == $i){
											echo '<option value="'.$i.'" selected>'.$i.'</option>';
										}
										else{
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
									}
								?>
							</select>
						</div>
						<br>						
						<br>						
						<br>
						<input name="phone" id="phone" class="form-control width" required type="text" placeholder="Numéro de téléphone*" value="<?php if($showErr == true){echo $post['phone'];} ?>" maxlength="20">
						<br>
						<input name="email" id="email" class="form-control width" required type="email" placeholder="Adresse mail*" value="<?php if($showErr == true){echo $post['email'];} ?>">
						<br>
						<input id="password" name="password" class="form-control width" required type="password" placeholder="Mot de passe* (Mininum 8 caractères)">
						<br>
						<input id="password_confirm" name="password_confirm" class="form-control width" required type="password" placeholder="Confirmez votre mot de passe* ">
						<br>
						<label for="license">Avez vous le permis de conduire ?</label>
						<input type="radio" name="driver_license" value="yes" > Oui
						<input type="radio" name="driver_license" value="no" > Non
						<br>
						<label for="license">Avez vous une voiture ?</label>
						<input type="radio" name="car" value="yes" > Oui
						<input type="radio" name="car" value="no" > Non
						<br>

						<input type="checkbox" name="newsletter" value="news" <?php if($showErr == true && $post['newsletter'] == 'news'){echo 'checked="checked"';} ?>> Je souhaite recevoir  la newsletter Youthies
						<br>
						<p class="linkConnecInscri">
							<a href="../connexion/" class="colorLink right blue">Déjà inscrit ?</a>
						</p>
						<button class="btn btn-default" type="submit">Créer mon compte</button>
						<br>
						<br>
						En cliquant sur "Créer mon compte", j'accepte les<a class="link" href="../cgu/"> Conditions Générales d'Utilisation</a> de Youthie
					</form>
				</div>
			</div>
		</section>

	</main>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../inc/footer/footer.php'; ?>
</html>