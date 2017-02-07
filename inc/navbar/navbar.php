<?php
$conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
//$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
if($conn->connect_error) {
    die("Connection failed : ". $conn->connect_error);
}
if (isset($_SESSION['id'])) {
    $id_youthie = $_SESSION["id"];
    $sql = "SELECT * FROM youthie_professionnels WHERE id ='$id_youthie' ";
    $_result = $conn->query($sql);
    if($_result->num_rows > 0) {
        while($_row = $_result->fetch_assoc()) {
            $is_admin = $_row['Admin'];
        }
    }
}
$conn->close();
?>
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