<?php 
require_once "../inc/connect.php";
session_start();
//var_dump($_SESSION); 

$exist = false;
$msgConfirm = false;
$showErr = false;
$errors = array();
$post = array();
$idUser = $_SESSION['user']['id'];
$etapeInscription = '2';
var_dump($_POST);

//Si la personne n'est pas connecté, on l'envoie vers la première partie de l'inscription.
if(!isset($_SESSION) || empty($_SESSION)){
	header('Location: inscription.php');
}
//Si la personne a déjà remplis cette partie, on l'envoie vers
if(isset($_SESSION['user']) && $_SESSION['user']['inscription'] == 2){
	header('location: mes_missions.php');
}

if(!empty($_POST)){
	//pour chaques $_POST
	foreach($_POST as $key => $value){
		//Si l'entrée est 'studies et que c'est un tableau (içi on veut nétoyer les entrées, les tableaux posaient problème)
		if($key == 'studies' && is_array($value)){
			// pour chaque entrée
			foreach ($value as $key2 => $value2) {
				// on la nétoie et on l'ajoute
				$post['studies'][] = trim(strip_tags($value2));
			}
		}
		//Si l'entrée est mission et que c'est un tableau
		elseif($key == 'missions' && is_array($value)){
			// pour chaque entrée
			foreach ($value as $key2 => $value2) {
				// on la nétoie et on l'ajoute
				$post['missions'][] = trim(strip_tags($value2));
			}
		}
		//Sinon c'est que ce n'est pas un tableau, on fait normalement
		else{
			$post[$key] = trim(strip_tags($value));
		}
	}	
	// Ici les données sont nétoyées, on vérifie donc les réponses fournies
	if(!isset($post['qualifications']) || empty($post['qualifications'])){
		$errors[] = 'Veuillez indiquer votre niveau de qualifications.';
	}
	if(!isset($post['studies']) || empty($post['studies'])){
		$errors[] = 'Veuillez indiquer votre ou vos domaine(s) d\'étude(s).';
	}
	if(!isset($post['english']) || empty($post['english'])){
		$errors[] = 'Veuillez indiquer votre niveau d\'anglais.';
	}
	if(!isset($post['missions']) || empty($post['missions'])){
		$errors[] = 'Veuillez indiquer une ou plusieurs types de missions.';
	}
	if(!isset($post['discover']) || empty($post['discover'])){
		$errors[] = 'Merci de nous indiquer comment vous nous avez découvert.';
	}
	//On vérifie que nous avons toutes les informations
	if(count($errors) === 0){
		//On prépare la mise à jour du profile 'studients' avec ces informations
		$res = $conn->prepare('UPDATE studients SET 
			`qualifications` = :qualifications,
			`tools` = :tools,
			`english` = :english,
			`discover` = :discover,
			`inscription` = :inscription
			WHERE id = :idUser
		');
		$res->bindValue(':idUser', $idUser, PDO::PARAM_INT);
		$res->bindValue(':qualifications', $post['qualifications']);
		$res->bindValue(':tools', $post['tools']);
		$res->bindValue(':english', $post['english']);
		$res->bindValue(':discover', $post['discover']);
		$res->bindValue(':inscription', $etapeInscription, PDO::PARAM_INT);

		
		if ($res->execute()) {
			// On prépare l'insertion des 'studies'
			foreach ($post['studies'] as $key => $value) {
				//On va cherché dans la table si cette entrée existe déjà
				$studieExist = $conn->prepare('SELECT * FROM studies WHERE id_user = :idUser AND domain = :domain');

				$studieExist->bindValue(':idUser', $idUser, PDO::PARAM_INT);
				$studieExist->bindValue(':domain', $value, PDO::PARAM_INT);

				if($studieExist->execute()){
					$stExist = $studieExist->fetchAll(PDO::FETCH_ASSOC);
				}
				// Si $stExist est vide on ajoute l'entrée dans la base de donnée
				if(empty($stExist)){
					$stu = $conn->prepare('INSERT INTO studies (
						`id_user`,
						`domain`)
						VALUES (
						:idUser,
						:domain)
					');

					$stu->bindValue(':idUser', $idUser, PDO::PARAM_INT);
					$stu->bindValue(':domain', $value);
					// On insère les informations
					if($stu->execute()){
						echo 'ok '.$value;
					}
					
				}
			}

			//On prépare l'insertion des 'missions'
			foreach ($post['missions'] as $key => $value) {
				//On va cherché dans la table si cette entrée existe déjà
				$missExist = $conn->prepare('SELECT * FROM missions_search WHERE id_user = :idUser AND domain = :domain');

				$missExist->bindValue(':idUser', $idUser, PDO::PARAM_INT);
				$missExist->bindValue(':domain', $value, PDO::PARAM_INT);

				if($missExist->execute()){
					$miExist = $missExist->fetchAll(PDO::FETCH_ASSOC);
				}
				// Si $miExist est vide on ajoute l'entrée dans la base de donnée
				if(empty($miExist)){
					$miss = $conn->prepare('INSERT INTO missions_search (
						`id_user`,
						`domain`)
						VALUES (
						:idUser,
						:domain)
					');
					$miss->bindValue(':idUser', $idUser, PDO::PARAM_INT);
					$miss->bindValue(':domain', $value);
					// On insère les informations
					if($miss->execute()){
						
					}
					else{
						
					}
				}
			}
			// Ici toutes les informations ont été ajouté, on met à jour l'étape inscription de $_SESSION
			$_SESSION['user']['inscription'] = $etapeInscription;
			// Puis on redirige vers les annonces
			header('Location: annonces-etudiant.php');
		}
		else{
			$errors[] = 'Erreur lors de l\'insertion des informations.';
		}
	}
	if(!empty($errors)){
		$showErr = true;
	}
}
?>

	<?php require '../inc/header.php'; ?>

	<main class="main fond3">

		<section id="wrapInscrip2" class="main_section">
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
							<option value="BAC/BAC PRO" <?php if($showErr == true && $post['qualifications'] == 'BAC/BAC PRO'){echo 'selected';}?>>BAC/BAC PRO</option>
							<option value="BAC +1" <?php if($showErr == true && $post['qualifications'] == 'BAC +1'){echo 'selected';}?>>BAC +1</option>
							<option value="BAC +2" <?php if($showErr == true && $post['qualifications'] == 'BAC +2'){echo 'selected';}?>>BAC +2</option>
							<option value="BAC +3" <?php if($showErr == true && $post['qualifications'] == 'BAC +3'){echo 'selected';}?>>BAC +3</option>
							<option value="BAC +4"<?php if($showErr == true && $post['qualifications'] == 'BAC +4'){echo 'selected';}?>>BAC +4</option>
							<option value="BAC +5" <?php if($showErr == true && $post['qualifications'] == 'BAC +5'){echo 'selected';}?>>BAC +5</option>
							<option value="BAC +5+" <?php if($showErr == true && $post['qualifications'] == 'BAC +5+'){echo 'selected';}?>>> BAC +5</option>
						</select>
						<label id="domainsStudies" class="titleForm" for="studies">Domaines d'études :</label>
						<br>
						<div class="textLeft row wrapMulti">
							<div class="col-md-4">
								<input name="studies[]" id="studies1" type="checkbox" value="commerce">
								<label for="studies1">
									 Commerce
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies2" type="checkbox" value="communication">
								<label for="studies2">	
									 Communication
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies3" type="checkbox" value="evenementiel">
								<label for="studies3">	
									 Evènementiel
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies4" type="checkbox" value="publicity">
								<label for="studies4">	
									 Publicité
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies5" type="checkbox" value="artCulture">
								<label for="studies5">	
									 Art - Culture
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies6" type="checkbox" value="audiovisuel">
								<label for="studies6">	
									 Audiovisuel
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies7" type="checkbox" value="designGraphism">
								<label for="studies7">	
									 Design - Graphisme
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies8" type="checkbox" value="informatique">
								<label for="studies8">
									 Informatique
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies9" type="checkbox" value="architectury">
								<label for="studies9">
									 Architecture
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies10" type="checkbox" value="engineer">
								<label for="studies10">
									 Engineer
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies11" type="checkbox" value="compatibilityGestionFinance">
								<label for="studies11">
									 Comptabilité - Gestion - Finance
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies12" type="checkbox" value="law">
								<label for="studies12">
									 Droit
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies13" type="checkbox" value="hr">
								<label for="studies13">
									 Sciences humaines et sociales
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies14" type="checkbox" value="hotel">
								<label for="studies14">
									 Hôtellerie	
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies15" type="checkbox" value="politicsSiences">
								<label for="studies15">
									 Sciences économiques et poilitiques
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies16" type="checkbox" value="banking">
								<label for="studies16">
									 Banque assurance
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies17" type="checkbox" value="realEstate">
								<label for="studies17">	
									 Immobilier
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies18" type="checkbox" value="tourism">
								<label for="studies18">
									 Tourisme
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies19" type="checkbox" value="secretariat">
								<label for="studies19">
									 Secrétariat administration
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies20" type="checkbox" value="transport">
								<label for="studies20">
									 Transport Logistique
								</label>
							</div>
							<div class="col-md-4">
								<input name="studies[]" id="studies21" type="checkbox" value="other">
								<label for="studies21">
									 Autre	
								</label>
							</div>
						</div>
						<br>
						<br>
						<input type="text" id="tools" class="form-control width" name="tools" placeholder="Outils techniques maîtrisés ( Type suite Adobe, pack office, logiciel 3D , ETC )" value="<?php if($showErr == true){echo $post['tools'];} ?>">
						<br>
						<select name="english" class="form-control grey">
							<option class="grey" value="" selected disabled>Niveau d'anglais</option>
							<option value="beginner" <?php if($showErr == true && $post['english'] == 'beginner'){echo 'selected';}?>>Débutant</option>
							<option value="intermediate" <?php if($showErr == true && $post['english'] == 'intermediate'){echo 'selected';}?>>Intermédiaire</option>
							<option value="confirmed" <?php if($showErr == true && $post['english'] == 'confirmed'){echo 'selected';}?>>Confirmé</option>
							<option value="bilingual" <?php if($showErr == true && $post['english'] == 'bilingual'){echo 'selected';}?>>Bilingue</option>
						</select>
						<br>
						<input type="text" id="otherLanguages" class="form-control width" name="otherLanguages" placeholder="Autres langues" value="<?php if($showErr == true){echo $post['otherLanguages'];} ?>">
						<br>
						<label id="domainMissions" class="titleForm" for="missions">Quel type de missions recherchez-vous ?</label>
						<br>
						<div class="textLeft">
							<div class="col-md-4">
								<input name="missions[]" id="missions1" type="checkbox" value="administration">
								<label for="missions1">
									 Administration - Secrétariat
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions2" type="checkbox" value="law">
								<label for="missions2">	
									 Juridique - Consulting
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions3" type="checkbox" value="bussiness">
								<label for="studies3">	
									 Business development 
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions4" type="checkbox" value="art">
								<label for="missions4">	
									 Art - Mode
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions5" type="checkbox" value="events">
								<label for="missions5">	
									 Evénementiel
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions6" type="checkbox" value="audiovisuel">
								<label for="missions6">	
									 Audiovisuel
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions7" type="checkbox" value="designGraphism">
								<label for="missions7">	
									 Design - Graphisme
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions8" type="checkbox" value="finance">
								<label for="missions8">
									  Finance - Comptabilité
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions9" type="checkbox" value="informatique">
								<label for="missions9">
									 Informatique
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions10" type="checkbox" value="marketing">
								<label for="missions10">
									 Marketing
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions11" type="checkbox" value="communication">
								<label for="missions11">
									 Communication
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions12" type="checkbox" value="publicity">
								<label for="missions12">
									 Publicité
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions13" type="checkbox" value="pr">
								<label for="missions13">
									 Relations publique
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions14" type="checkbox" value="digitalMarketing">
								<label for="missions14">
									 Marketing digital	
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions15" type="checkbox" value="e-commerce">
								<label for="missions15">
									 e-commerce
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions16" type="checkbox" value="internet">
								<label for="missions16">
									 Internet
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions17" type="checkbox" value="prospection">
								<label for="missions17">	
									 Prospection
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions18" type="checkbox" value="sales">
								<label for="missions18">
									 Force de vente
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions19" type="checkbox" value="hr">
								<label for="missions19">
									 Ressources humaines
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions20" type="checkbox" value="recrutement">
								<label for="missions20">
									 Recrutement
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions21" type="checkbox" value="traduction">
								<label for="missions21">
									 Traduction - Langues
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions22" type="checkbox" value="transport">
								<label for="missions22">
									 transport
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions23" type="checkbox" value="driver">
								<label for="missions23">
									 Chauffeur
								</label>
							</div>
							<div class="col-md-4">
								<input name="missions[]" id="missions24" type="checkbox" value="sales">
								<label for="missions24">
									 Commerce / Distribution
								</label>
							</div>
						</div>
						<br>
						<label id="discover" class="titleForm" for="discover">Comment avez-vous découvert Youthie ?</label>
						<br>
						<div class="col-md-4">
							<input name="discover" id="discover1" type="radio" value="social" <?php if($showErr == true && $post['discover'] == 'social'){echo 'checked';}?>>
							<label for="discover1">
								 Réseaux sociaux
							</label>
						</div>
						<div class="col-md-4">
							<input name="discover" id="discover2" type="radio" value="webSite" <?php if($showErr == true && $post['discover'] == 'webSite'){echo 'checked';}?>>
							<label for="discover2">
								 Site Web
							</label>
						</div>
						<div class="col-md-4">
							<input name="discover" id="discover3" type="radio" value="saloon" <?php if($showErr == true && $post['discover'] == 'saloon'){echo 'checked';}?>>
							<label for="discover3">
								 Salon
							</label>
						</div>
						<div class="col-md-6">
							<input name="discover" id="discover4" type="radio" value="friends" <?php if($showErr == true && $post['discover'] == 'friends'){echo 'checked';}?>>
							<label for="discover4">
								 Bouche à oreilles
							</label>
						</div>
						<div class="col-md-6">
							<input name="discover5" id="discover5" type="radio" value="school" <?php if($showErr == true && $post['discover'] == 'school'){echo 'checked';}?>>
							<label for="discover5">
								 Via ton école
							</label>
						</div>
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