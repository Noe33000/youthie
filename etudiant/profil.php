
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
	<main class="main fond4" style="min-height:600px;padding-top:20px;">
		<section class="main_section">
			<div class="container">
				<h3>ÉTUDIANT</h3>
				<p class="profil-specialtext">Remplir vos informations est indispensable pour pouvoir postuler aux missions</p>
				<?php
				if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Etudiant') {

# Etudiant Select 
					$id 	= $_SESSION["id"];
					//$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
					$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
					if($_conn->connect_error) {
						die("Connection failed : ". $_conn->connect_error);
					}
					$_sql = "SELECT DISTINCT * FROM youthie_etudiants WHERE id='$id' ";
					$_result = $_conn->query($_sql);
					if($_result->num_rows > 0) {
						while($_row = $_result->fetch_assoc()) {
							if($id == $_row['id']) {
								/*$GLOBALS['Avatar'] = $_row['Avatar']; */
								$_Utilisateur 		= $_row['Utilisateur'];
								$Utilisateur 		= explode(" ", $_Utilisateur);
								$GLOBALS['Nom'] = $Utilisateur[0];
								$GLOBALS['Prenom'] = $Utilisateur[1];
								$_DatedeNaissance = $_row['DatedeNaissance'];
								$DatedeNaissance 	= explode("/", $_DatedeNaissance);
								$GLOBALS['Jour'] = $DatedeNaissance[0];
								$GLOBALS['Mois'] = $DatedeNaissance[1];
								$GLOBALS['Annee'] = $DatedeNaissance[2];
								$GLOBALS['AdressePostale'] = $_row['AdressePostale'];
								$_Pays = $_row['Pays'];
								if (!(empty($_Pays))) {
									$Pays 	= explode(";", $_Pays);
									$GLOBALS['CodePostal'] = $Pays[0];
									$GLOBALS['Ville'] = $Pays[1];
									$GLOBALS['Pays'] = $Pays[2]; }
								$avatar = "";
								if (isset($_row['Avatar'])) {
									$avatar = $_row['Avatar'];
								}
								if (isset($_row['cv'])) {
									$cv = $_row['cv'];
								}
								if (isset($_row['cvOriginal'])) {
									$cv_original = $_row['cvOriginal'];
								}
								$GLOBALS['Mobile'] = $_row['Mobile'];
								$GLOBALS['Email'] = $_row['Email'];
								$GLOBALS['MotdePasse'] 	= base64_decode($_row['MotdePasse']);
								$GLOBALS['NiveaudeFormation']	= $_row['NiveaudeFormation'];
								$GLOBALS['UniversiteEcole'] 	= $_row['UniversiteEcole'];
								$GLOBALS['Competences'] = $_row['Competences'];
								$GLOBALS['Marketing'] 	= $_row['Marketing'];
								$GLOBALS['Communication'] = $_row['Communication'];
								$GLOBALS['Evenementiel'] = $_row['Evenementiel'];
								$GLOBALS['Graphisme'] 	= $_row['Graphisme'];
								$GLOBALS['Informatique'] = $_row['Informatique'];
								$GLOBALS['Audiovisuel'] = $_row['Audiovisuel'];
								$GLOBALS['Droit'] = $_row['Droit'];
								$GLOBALS['Finance'] = $_row['Finance'];
							}
						}
					}
					$_conn->close();
					# Etudiant Edit
					if(isset($_POST['email'])) {
						$id = $_SESSION["id"];
						$_Utilisateur = $_POST['nom'].' '.$_POST['prenom'];
						$Utilisateur = $_Utilisateur;
						$DatedeNaissance 	= $_POST['jour'] .'/'. $_POST['mois'] .'/'. $_POST['annee'];
						$AdressePostale 	= $_POST['adressepostale'];
						$Pays = $_POST['codepostal'].';'.$_POST['ville'].';'.$_POST['pays'];
						$Mobile 	= $_POST['mobile'];
						$Email = $_POST['email'];
						$MotdePasse = base64_encode($_POST['motdepasse']);
						$NiveaudeFormation	= $_POST['niveaudeformation'];
						$UniversiteEcole 	= $_POST['universiteecole'];
						$Competences = $_POST['competences'];
						$Marketing 	= $_POST['marketing'];
						$Communication = $_POST['communication'];
						$Evenementiel = $_POST['evenementiel'];
						$Graphisme 	= $_POST['graphisme'];
						$Informatique = $_POST['informatique'];
						$Droit = $_POST['droit'];
						$Finance = $_POST['finance'];
						$Audiovisuel = $_POST['audiovisuel'];
						$Description = $_POST['description'];
						if ($_FILES['cv']['error'] > 0) {
							$erreur = "Erreur lors du transfert";
						}
						if ($_FILES['cv']['size'] > 1000000) {
							$erreur = "Le fichier est trop gros";
						}
						if(!empty($_FILES['cv']) && $_FILES['cv']['name'] != "") {
							if($_FILES['cv']['error'] == 0 && is_uploaded_file($_FILES['cv']['tmp_name'])) {
								$code_user = $id; // code de l'utilisateur enregistré dans le formulaire.
								$file_name = $_FILES['cv']['name']; //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.pdf).
								$type_fichier = $_FILES['cv']['type']; //Le type du fichier. Par exemple, cela peut être « image/png ».
								$size = $_FILES['cv']['size'] ; //La taille du fichier en octets.
								$extension = strtolower(substr(strrchr($_FILES['cv']['name'], '.'), 1));
								if(move_uploaded_file($_FILES['cv']['tmp_name'], "../cv/$code_user.$extension")) {
									echo 'Fichier enregistré';
									$cv = $code_user;
									$cv_original = $_FILES['cv']['name'];
								} else {
									exit('Erreur lors de l\'enregistrement');
								}
							} else {
								exit('CV non uploadé');
							}
						}
						if ($_FILES['avatar']['error'] > 0) {
							$erreur = "Erreur lors du transfert";
						}
						if ($_FILES['avatar']['size'] > 1000000) {
							$erreur = "Le fichier est trop gros";
						}
						if(!empty($_FILES['avatar']) && $_FILES['avatar']['name'] != "") {
							if($_FILES['avatar']['error'] == 0 && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
								$code_user = $id; // code de l'utilisateur enregistré dans le formulaire.
								$extension_avatar = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
								if(move_uploaded_file($_FILES['avatar']['tmp_name'], "../avatar/$code_user.$extension_avatar")) {
									echo 'Fichier enregistré';
									$avatar = $code_user;
								} else {
									exit('Erreur lors de l\'enregistrement');
								}
							} else {
								exit('Fichier non uploadé');
							}
						}
						//$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
						$conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
						if(mysqli_connect_errno()) { printf("Connect failed : %s\n", mysqli_connect_error()); }
						$Description = htmlspecialchars(mysqli_real_escape_string($conn, $Description));
						$sql = "UPDATE youthie_etudiants SET Utilisateur='$Utilisateur', DatedeNaissance='$DatedeNaissance', Avatar='$avatar', AdressePostale='$AdressePostale', Pays='$Pays', Mobile='$Mobile', Email='$Email', MotdePasse='$MotdePasse', NiveaudeFormation='$NiveaudeFormation', UniversiteEcole='$UniversiteEcole', Competences='$Competences', Marketing='$Marketing', Communication='$Communication', Evenementiel='$Evenementiel', Droit='$Droit', Finance='$Finance', Graphisme='$Graphisme', Informatique='$Informatique', Audiovisuel='$Audiovisuel', Description='$Description', cv='$cv', cvOriginal='$cv_original' WHERE id='$id' ";
						if(mysqli_query($conn, $sql)) {
							echo '<br><div style="text-align:center">Fiche mise à jour avec succès</div><br>';
							echo '<meta http-equiv="refresh" content="2; url=https://www.youthie.io/etudiant/">';
						} else {
							echo "Error updating record : " . mysqli_error($conn);
						}
						mysqli_close($conn);
					}
				}
				?>
				<div class="row">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4">
								<?php
								if (isset($avatar) && $avatar != "") {
									?> <img src="../avatar/<?php echo $avatar ?>" height="128" width="128" /> <?php
								} else {
									?> <img src="../images/icon.png" height="128" width="128" /><?php
								}
								?>
							</div>
							<div class="col-md-8">
								<input name="nom" id="nom" class="form-control width" required type="text" placeholder="Nom*" value="<?php if(isset($Nom)) { echo $Nom; } ?>" maxlength="20" />
								<br>
								<input name="prenom" id="prenom" class="form-control width" required type="text" placeholder="Prénom*" value="<?php if(isset($Prenom)) { echo $Prenom; } ?>" maxlength="20" />
								<br>
							</div>
						</div>
						<label>Date de naissance:</label>
						<select style="cursor:pointer;padding:6px;border-radius:5px;" name="jour" id="jour" style="cursor:pointer;" placeholder="JJ" >
							<?php if(isset($DatedeNaissance)) {
								echo '<option selected="selected" value="'.$DatedeNaissance[0].'">'.$DatedeNaissance[0].'</option>';
								echo '<option disabled="disabled">Jour</option>';
							} else {
								echo '<option selected="selected" disabled="disabled">Jour</option>';
							} ?>
							<?php for ($i=01; $i <32 ; $i++) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}?>
						</select>
						<select style="cursor:pointer;padding:6px;border-radius:5px;" name="mois" id="mois" style="cursor:pointer;" placeholder="MM" >
							<?php if(isset($DatedeNaissance)) {
								echo '<option selected="selected" value="'.$DatedeNaissance[1].'">'.$DatedeNaissance[1].'</option>';
								echo '<option disabled="disabled">Mois</option>';
							} else {
								echo '<option selected="selected" disabled="disabled">Mois</option>';
							} ?>
							<option value="Janvier">Janvier</option>
							<option value="Février">Février</option>
							<option value="Mars">Mars</option>
							<option value="Avril">Avril</option>
							<option value="Mai">Mai</option>
							<option value="Juin">Juin</option>
							<option value="Juillet">Juillet</option>
							<option value="Août">Août</option>
							<option value="Septembre">Septembre</option>
							<option value="Octobre">Octobre</option>
							<option value="Novembre">Novembre</option>
							<option value="Décembre">Décembre</option>
						</select>
						<select style="cursor:pointer;padding:6px;border-radius:5px;" name="annee" id="annee" style="cursor:pointer;" placeholder="AAAA" >
							<?php if(isset($DatedeNaissance)) {
								echo '<option selected="selected" value="'.$DatedeNaissance[2].'">'.$DatedeNaissance[2].'</option>';
								echo '<option disabled="disabled">Année</option>';
							} else {
								echo '<option selected="selected" disabled="disabled">Année</option>';
							} 
							for ($i=2000; $i >1929 ; $i--) { 
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
							?>
						</select>
						<br><br>
						<input name="email" id="email" class="form-control width" required type="email" placeholder="Adresse mail*" value="<?php if(isset($Email)) { echo $Email; } ?>" required/>
						<br>
						<input id="motdepasse" name="motdepasse" class="form-control width" required type="text" placeholder="Mot de passe* (Mininum 8 caractères)" value="<?php if(isset($MotdePasse)) { echo $MotdePasse; } ?>" required/>
						<br>
						<input name="mobile" id="mobile" class="form-control width" type="tel" placeholder="Numéro de portable*" value="<?php if(isset($Mobile)) { echo $Mobile; } ?>" maxlength="10" required/>
						<br>
						<input name="adressepostale" id="adressepostale" class="form-control width" type="text" placeholder="Adresse postale*" value="<?php if(isset($AdressePostale)) { echo $AdressePostale; } ?>" required/>
						<br>
						<div class="row">
							<div class="col-md-8" style="padding-left:0px">
								<input name="ville" id="ville" class="form-control width" type="text" placeholder="Ville*" value="<?php if(isset($Ville)) { echo $Ville; } ?>" required/>
							</div>
							<div class="col-md-4" style="padding-right:0px">
								<input name="codepostal" id="codepostal" class="form-control" required type="text" placeholder="Code postal*" value="<?php if(isset($CodePostal)) { echo $CodePostal; } ?>" maxlength="5" />
							</div>
						</div>
						<br>
						<input name="pays" id="pays" class="form-control width" type="text" placeholder="Pays*" value="<?php if(isset($Pays)) { echo $Pays; } ?>" required/>
						<br>
						<label>Niveau de formation*</label>
						<select style="cursor:pointer;padding:6px;border-radius:5px;" id="niveaudeformation" name="niveaudeformation" required>
							<?php if(isset($NiveaudeFormation)) {
								echo '<option selected="selected" value="'.$NiveaudeFormation.'">'.$NiveaudeFormation.'</option>';
								echo '<option disabled="disabled">Niveau de formation</option>';
							} else {
								echo '<option selected="selected" disabled="disabled">Niveau de formation</option>';
							} ?>
							<option value="Bac pro, BEP, CAP">Bac pro, BEP, CAP</option>
							<option value="DUT, BTS, BAC +2">DUT, BTS, BAC +2</option>
							<option value="Licence, BAC +3">Licence, BAC +3</option>
							<option value="Master, BAC +5">Master, BAC +5</option>
						</select>
						<br><br>
						<input name="universiteecole" id="universiteecole" class="form-control width" type="text" placeholder="Université/école*" value="<?php if(isset($UniversiteEcole)) { echo $UniversiteEcole; } ?>" required/>
						<br><textarea style="margin-bottom:20px;margin-top:5px;resize:none;float:left;border-radius:5px" rows="4" cols="70%" name="description" id="description" required>Description*</textarea><br>
						<input name="competences" id="competences" class="form-control width" type="text" placeholder="Compétences" value="<?php if(isset($Competences)) { echo $Competences; } ?>" />
						<br>
						<style>
							table, th, td {
								border: 0px solid black;
								border-collapse: collapse;
							}
							th, td {
								padding: 15px;
							}
							th {
								text-align: center;
							}
						</style>
						<table style="width:100%">
							<tr>
								<th style="text-align:left;">Vos domaines</th>
								<th>Débutant</th>
								<th>Intermédiaire</th>
								<th>Expert</th>
								<th>Sans avis</th>
							</tr>
							<tr>
								<td style="text-align:left;">Marketing</td>
								<td><input type="radio" name="marketing" <?php if(isset($Marketing) && $Marketing == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="marketing" <?php if(isset($Marketing) && $Marketing == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="marketing" <?php if(isset($Marketing) && $Marketing == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="marketing" <?php if(isset($Marketing) && $Marketing == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Communication</td>
								<td><input type="radio" name="communication" <?php if(isset($Communication) && $Communication == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="communication" <?php if(isset($Communication) && $Communication == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="communication" <?php if(isset($Communication) && $Communication == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="communication" <?php if(isset($Communication) && $Communication == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Événementiel</td>
								<td><input type="radio" name="evenementiel" <?php if(isset($Evenementiel) && $Evenementiel == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="evenementiel" <?php if(isset($Evenementiel) && $Evenementiel == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="evenementiel" <?php if(isset($Evenementiel) && $Evenementiel == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="evenementiel" <?php if(isset($Evenementiel) && $Evenementiel == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Graphisme</td>
								<td><input type="radio" name="graphisme" <?php if(isset($Graphisme) && $Graphisme == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="graphisme" <?php if(isset($Graphisme) && $Graphisme == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="graphisme" <?php if(isset($Graphisme) && $Graphisme == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="graphisme" <?php if(isset($Graphisme) && $Graphisme == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Informatique</td>
								<td><input type="radio" name="informatique" <?php if(isset($Informatique) && $Informatique == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="informatique" <?php if(isset($Informatique) && $Informatique == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="informatique" <?php if(isset($Informatique) && $Informatique == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="informatique" <?php if(isset($Informatique) && $Informatique == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Audiovisuel</td>
								<td><input type="radio" name="audiovisuel" <?php if(isset($Audiovisuel) && $Audiovisuel == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="audiovisuel" <?php if(isset($Audiovisuel) && $Audiovisuel == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="audiovisuel" <?php if(isset($Audiovisuel) && $Audiovisuel == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="audiovisuel" <?php if(isset($Audiovisuel) && $Audiovisuel == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Droit</td>
								<td><input type="radio" name="droit" <?php if(isset($Droit) && $Droit == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="droit" <?php if(isset($Droit) && $Droit == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="droit" <?php if(isset($Droit) && $Droit == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="droit" <?php if(isset($Droit) && $Droit == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
							<tr>
								<td style="text-align:left;">Finance</td>
								<td><input type="radio" name="finance" <?php if(isset($Finance) && $Finance == "debutant") { echo 'checked value="debutant"'; } else { echo 'value="debutant"'; } ?> ></td>
								<td><input type="radio" name="finance" <?php if(isset($Finance) && $Finance == "intermediaire") { echo 'checked value="intermediaire"'; } else { echo 'value="intermediaire"'; } ?> ></td>
								<td><input type="radio" name="finance" <?php if(isset($Finance) && $Finance == "expert") { echo 'checked value="expert"'; } else { echo 'value="expert"'; } ?> ></td>
								<td><input type="radio" name="finance" <?php if(isset($Finance) && $Finance == "sansavis") { echo 'checked value="sansavis"'; } else { echo 'value="sansavis"'; } ?> ></td>
							</tr>
						</table>
						<div style="text-align:right">
							<span style="font-size:10px;">*Champs obligatoires</span>
						</div>
						<p style="float:left">Votre CV : </p><input style="display:inline;float:left" type="file" name="cv" id="cv" accept="media_type"><br><br>
						<p style="float:left">Votre photo : </p><input style="display:inline;float:left" type="file" name="avatar" id="avatar">
						<br><br><br />
						<button class="btn btn-default" type="submit">Valider</button>
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
