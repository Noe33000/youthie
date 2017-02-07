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

	<main class="main fond4" style="min-height:600px;padding-top:20px;">

		<section class="main_section">
			<div class="container">
				<h3>PROFESSIONNEL</h3>
				<?php
				if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') {

# Professionnel Select 
					$id 	= $_SESSION["id"];

//	$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
					$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
					if($_conn->connect_error) {
						die("Connection failed : ". $_conn->connect_error);
					}
					$_sql = "SELECT DISTINCT * FROM youthie_professionnels WHERE id='$id' ";
					$_result = $_conn->query($_sql);
					if($_result->num_rows > 0) {
						while($_row = $_result->fetch_assoc()) {
							if($id == $_row['id']) {
								#$GLOBALS['Avatar'] 	= $_row['Avatar'];
								$_Utilisateur 	= $_row['Utilisateur'];
								$Utilisateur = explode(" ", $_Utilisateur);
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
									$Pays = explode(";", $_Pays);
									$GLOBALS['CodePostal'] = $Pays[0];
									$GLOBALS['Ville'] = $Pays[1];
									$GLOBALS['Pays'] = $Pays[2];
								}
								$GLOBALS['Mobile'] 	= $_row['Mobile'];
								if (!(empty($_row['Fixe'])))
									$GLOBALS['Fixe'] = $_row['Fixe'];
								$GLOBALS['Email'] = $_row['Email'];
								$GLOBALS['MotdePasse'] = base64_decode($_row['MotdePasse']);
								$GLOBALS['NomdEntreprise'] = $_row['NomdEntreprise'];
								$GLOBALS['PaysdEntreprise'] = $_row['PaysdEntreprise'];
								$GLOBALS['SiteWeb'] = $_row['SiteWeb'];
							}
						}
					}
					$_conn->close();
# Professionnel Edit
					if(isset($_POST['email'])) {
						$id = $_SESSION["id"];
						$_Utilisateur = $_POST['nom'].' '.$_POST['prenom'];
						$Utilisateur = $_Utilisateur;
						$DatedeNaissance = $_POST['jour'] .'/'. $_POST['mois'] .'/'. $_POST['annee'];
						$AdressePostale = $_POST['adressepostale'];
						$Pays = $_POST['codepostal'].';'.$_POST['ville'].';'.$_POST['pays'];
						$Mobile = $_POST['mobile'];
						if (!(empty($Fixe)))
							$Fixe = $_POST['fixe'];
						$Email = $_POST['email'];
						$MotdePasse = base64_encode($_POST['motdepasse']);
						$NomdEntreprise 	= $_POST['nomdentreprise'];
						$SiteWeb = $_POST['siteweb'];
//	$conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
						$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
						if(mysqli_connect_errno()) { printf("Connect failed : %s\n", mysqli_connect_error()); }
						$sql = "UPDATE youthie_professionnels SET SiteWeb='$SiteWeb', Utilisateur='$Utilisateur', DatedeNaissance='$DatedeNaissance', AdressePostale='$AdressePostale', Pays='$Pays', Mobile='$Mobile', Email='$Email', MotdePasse='$MotdePasse', NomdEntreprise='$NomdEntreprise' WHERE id='$id' ";
						if(mysqli_query($conn, $sql)) {
							echo '<br><div style="text-align:center">Fiche mise à jour avec succès</div><br>';
							echo '<meta http-equiv="refresh" content="2; url=https://www.youthie.io/professionnel/">';
						} else {
							echo "Error updating record : " . mysqli_error($conn);
						}
						mysqli_close($conn);
					}

				}

				?>
				<div class="row">
					<form action="#" method="post">
						<div class="row">
							<div class="col-md-6"><img src="../images/icon.png" height="128" width="128" /></div>
							<div class="col-md-6">
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
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
						<select style="cursor:pointer;padding:6px;border-radius:5px;" name="mois" id="mois" style="cursor:pointer;" placeholder="MM" required >
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
						<select style="cursor:pointer;padding:6px;border-radius:5px;" name="annee" id="annee" style="cursor:pointer;" placeholder="AAAA" required >
							<?php if(isset($DatedeNaissance)) {
								echo '<option selected="selected" value="'.$DatedeNaissance[2].'">'.$DatedeNaissance[2].'</option>';
								echo '<option disabled="disabled">Année</option>';
							} else {
								echo '<option selected="selected" disabled="disabled">Année</option>';
							} ?>
							<option value="1996">1996</option>
							<option value="1995">1995</option>
							<option value="1994">1994</option>
							<option value="1993">1993</option>
							<option value="1992">1992</option>
							<option value="1991">1991</option>
							<option value="1990">1990</option>
							<option value="1989">1989</option>
							<option value="1988">1988</option>
							<option value="1987">1987</option>
							<option value="1986">1986</option>
							<option value="1985">1985</option>
							<option value="1984">1984</option>
							<option value="1983">1983</option>
							<option value="1982">1982</option>
							<option value="1981">1981</option>
							<option value="1980">1980</option>
							<option value="1979">1979</option>
							<option value="1978">1978</option>
							<option value="1977">1977</option>
							<option value="1976">1976</option>
							<option value="1975">1975</option>
							<option value="1974">1974</option>
							<option value="1973">1973</option>
							<option value="1972">1972</option>
							<option value="1971">1971</option>
							<option value="1970">1970</option>
							<option value="1969">1969</option>
							<option value="1968">1968</option>
							<option value="1967">1967</option>
							<option value="1966">1966</option>
							<option value="1965">1965</option>
							<option value="1964">1964</option>
							<option value="1963">1963</option>
							<option value="1962">1962</option>
							<option value="1961">1961</option>
							<option value="1960">1960</option>
							<option value="1959">1959</option>
							<option value="1958">1958</option>
							<option value="1957">1957</option>
							<option value="1956">1956</option>
							<option value="1955">1955</option>
							<option value="1954">1954</option>
							<option value="1953">1953</option>
							<option value="1952">1952</option>
							<option value="1951">1951</option>
							<option value="1950">1950</option>
							<option value="1949">1949</option>
							<option value="1948">1948</option>
							<option value="1947">1947</option>
							<option value="1946">1946</option>
							<option value="1945">1945</option>
							<option value="1944">1944</option>
							<option value="1943">1943</option>
							<option value="1942">1942</option>
							<option value="1941">1941</option>
							<option value="1940">1940</option>
							<option value="1949">1939</option>
							<option value="1948">1938</option>
							<option value="1947">1937</option>
							<option value="1946">1936</option>
							<option value="1945">1935</option>
							<option value="1944">1934</option>
							<option value="1943">1933</option>
							<option value="1942">1932</option>
							<option value="1941">1931</option>
							<option value="1940">1930</option>
						</select>
						<br><br>
						<input name="email" id="email" class="form-control width" required type="email" placeholder="Adresse mail*" value="<?php if(isset($Email)) { echo $Email; } ?>" />
						<br>
						<input id="motdepasse" name="motdepasse" class="form-control width" required type="password" placeholder="Mot de passe* (Mininum 8 caractères)" value="<?php if(isset($MotdePasse)) { echo $MotdePasse; } ?>" />
						<br>
						<input name="mobile" id="mobile" class="form-control width" type="tel" placeholder="Numéro de portable" value="<?php if(isset($Mobile)) { echo $Mobile; } ?>" maxlength="10" />
						<br>
						<input name="adressepostale" id="adressepostale" class="form-control width" type="text" placeholder="Adresse postale" value="<?php if(isset($AdressePostale)) { echo $AdressePostale; } ?>" />
						<br>
						<div class="row">
							<div class="col-md-8" style="padding-left:0px">
								<input name="ville" id="ville" class="form-control width" type="text" placeholder="Ville" value="<?php if(isset($Ville)) { echo $Ville; } ?>" />
							</div>
							<div class="col-md-4" style="padding-right:0px">
								<input style="float:right;" name="codepostal" id="codepostal" class="form-control" required type="text" placeholder="Code postal*" value="<?php if(isset($CodePostal)) { echo $CodePostal; } ?>" maxlength="5" />
							</div>
						</div>
						<br>
						<input name="pays" id="pays" class="form-control width" type="text" placeholder="Pays" value="<?php if(isset($Pays)) { echo $Pays; } ?>" />
						<br>
						<input name="nomdentreprise" id="nomentreprise" class="form-control width" required type="text" placeholder="Nom d'entreprise*" value="<?php if(isset($NomdEntreprise)) { echo $NomdEntreprise; } ?>" required />
						<br>
						<input name="siteweb" id="siteweb" class="form-control width" required type="text" placeholder="Site web" value="<?php if(isset($SiteWeb)) { echo $SiteWeb; } ?>" maxlength="50" />
						<br>
						<div style="text-align:right">
							<span style="font-size:10px;">*Champs obligatoires</span>
						</div>
						<br>
						<button class="btn btn-default" type="submit">Valider</button>
					</form>
				</div>
			</div>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>
