<?php 
session_start();
var_dump($_SESSION); 
$exist = false;
$msgConfirm = false;
$showErr = false;
$errors = array();
$post = array();
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

	<?php require '../inc/header.php'; ?>

	<main class="main fond3">

		<section class="main_section">
			<div class="container">
				<h1>Création de compte <br> étudiant</h1>
				<br><p>Merci de rempir ce formulaire pour pouvoir postuler aux offres</p><br>
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
						<select name="qualifications" class="form-control grey">
							<option class="grey" value="" selected disabled>Niveau d'étude</option>
							<option value="BAC/BAC PRO">BAC/BAC PRO</option>
							<option value="BAC +1">BAC +1</option>
							<option value="BAC +2">BAC +2</option>
							<option value="BAC +3">BAC +3</option>
							<option value="BAC +4">BAC +4</option>
							<option value="BAC +5">BAC +5</option>
							<option value="BAC +5+">> BAC +5</option>
						</select>
						<label for="studies">Domaines d'étude :</label>
						<input name="studies" type="radio" value="commerce">Commerce
						<input name="studies" type="radio" value="communication">Communication
						<input name="studies" type="radio" value="evenementiel">Evènementiel
						<input name="studies" type="radio" value="publicity">Publicité
						<input name="studies" type="radio" value="artCulture">Art - Culture
						<input name="studies" type="radio" value="audiovisuel">Audiovisuel
						<input name="studies" type="radio" value="designGraphism">Design - Graphisme
						<input name="studies" type="radio" value="informatique">Informatique
						<input name="studies" type="radio" value="architectury">Architecture
						<input name="studies" type="radio" value="engineer">Engineer
						<input name="studies" type="radio" value="compatibilityGestionFinance">Comptabilité - Gestion - Finance
						<input name="studies" type="radio" value="">Comptabilité - Gestion
						<br>
						<button class="btn btn-default" type="submit">Créer mon compte</button>
					</form>
				</div>
			</div>
		</section>

	</main>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../inc/footer.php'; ?>
</html>