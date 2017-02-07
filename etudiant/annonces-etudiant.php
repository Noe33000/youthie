<?php session_start(); 
// Si on n'est pas connecté en tant qu'étudiant, on est renvoyé sur une page de connexion
if (!isset($_SESSION['statut'])){
    header('location: ../connexion/');
}
elseif($_SESSION['statut'] !== 'Etudiant'){
    header('location: ../accueil/');
}
//Sinon on affiche la page
else {
    $_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
    //$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
    if($_conn->connect_error) {
        die("Connection failed : ". $_conn->connect_error);
    }
    $_sql = "SELECT * FROM youthie_mission ORDER BY STR_TO_DATE(DatedeDebut, '%d/%m/%Y') ASC";
    $id = $_SESSION["id"];
    $a = 0;
    $info = 0;
    $_result = $_conn->query($_sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/youthie_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Youthie - Annonces</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-87485637-1', 'auto');
        ga('send', 'pageview');

    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function mySwitch() {
            if ($('.first').is(":visible") == true) {
                $('.second').show();
                $('.first').hide();
            }
            else {
                $('.first').show();
                $('.second').hide();
            }
        }
    </script>
    <script type="text/javascript">
        $(function() {
            $("#sendstu").submit(function() {
                var buttonVal = $(this).find("input[name=a]").val();
                var buttonValue = "myButtonPerso" + buttonVal;
                var mod = "myModal" + buttonVal;
                id = $(this).find("input[name=id]").val();
                IdMission = $(this).find("input[name=IdMission]").val();
                $.post("post_annonce.php", {id: id, IdMission: IdMission}, function(data) {
                    if (data == "<br><div style=\"text-align:center\">Demande correctement envoyée</div><br><meta http-equiv=\"refresh\" content=\"2; url=../annonces-etudiant/\">") {
                        $('#' + buttonValue).addClass("sent");
                        $('#' + buttonValue).removeClass("wantit");
                        $('#' + buttonValue).prop('disabled', true);
                        $('#' + buttonValue).text('Candidature Envoyée', 'Save');
                        $('#' + mod).hide();
                        $('.modal-backdrop').hide();
                    } else {
                        alert("Erreur dans la requête !")
                    }
                });
                return false;
            });
        });
    </script>
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
    <script src="../js/mode.js"></script>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">

    <a href="../menumob/"><div class="nav-toggle"></div></a>

    <?php require '../navbar/navbar.php'; ?>
    <main>
        <br>
        <section class="module content" style="padding-top: 0;">
            <div style="position: relative; width: 100%; top: 0; z-index: -1;">
                <img src="../images/annonces-etudiant.jpg" style="width:100%;height:45em;">
                <div style="position: absolute; bottom: 0;height: 10em; width:100%; background-color: rgba(255,255,255,0.75);">
                    <p style="text-transform: uppercase;width: 90%; margin:1em 5%;padding: 1em 0 1em 5%;font-size: 2em; color: #000; border-top: 1px solid black; border-bottom: 1px solid black;">Les dernières annonces</p>
                </div>
            </div>
            <div style="clear: both;"></div>

            <?php 
            $_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
            //$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
            if($_conn->connect_error) {
                die("Connection failed : ". $_conn->connect_error);
            }
            $_sql = "SELECT * FROM youthie_mission";
            $id = $_SESSION["id"];
            $a = 0;
            $info = 0;
            $_result = $_conn->query($_sql);

            if($_result->num_rows > 0) {
                while ($_row = $_result->fetch_assoc()) {
                    var_dump($_row);
                    if ($_row['EtapeMission'] == 0 || $_row['EtapeMission'] == 1) {
                        $IdMission = $_row['id'];
                        $NomMission = $_row['Titre'];
                        $DatedeDebut = $_row['DatedeDebut'];
                        $DatedeFin = $_row['DatedeFin'];
                        $ProfilRecherche = $_row['ProfilRecherche'];
                        $LieuMission = $_row['LieuMission'];
                        $Descriptif = $_row['DescriptifMission'];
                        $DureeMission = $_row['DatedeDebut'];
                        $Informatique = $_row['Informatique'];
                        $Evenementiel = $_row['Evenementiel'];
                        $Marketing = $_row['Marketing'];
                        $Audiovisuel = $_row['Audiovisuel'];
                        $Droit = $_row['Droit'];
                        $Finance = $_row['Finance'];
                        $Prix = $_row['BudgetMission'];
                        $Prix = $Prix / 100;
                        $Communication = $_row['Communication'];
                        $Graphisme = $_row['Graphisme'];
                        $CdC = $_row['CahierdesCharges'];
                        ?>
            
                        <div class="annonce_bigbox container">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="../images/icon.png" style="height:10em;margin-top:4em;margin-left:15%; margin-right: 5%;"/>
                            </div>
                        <div class="col-md-6">
                            
                        <hr style="border-top: 2px solid black; margin-top: 0; margin-bottom: 1em; width: 145%">
                        <p style="font-size:1.5em; text-transform: uppercase; color;margin-bottom:0;display:inline; margin: 1em 0; font-weight: bold;">
                            <?php ($NomMission) ? print "$NomMission" : print "Titre de la mission"; ?><br>
                        <?php
                        $_get_ent = "SELECT * FROM youthie_professionnels";
                        $_result_ent = $_conn->query($_get_ent);
                        if ($_result_ent->num_rows > 0) {
                            while ($_row_ent = $_result_ent->fetch_assoc()) {
                                if ($_row_ent['id'] == $_row['IdProfessionnel']) {
                                    $Entname = $_row_ent['NomdEntreprise'];
                                    $EmailEntreprise = $_row_ent['Email'];
                                }
                            }
                            ($Entname) ? print "$Entname" : print "Nom de l'entreprise";?>
                            <br>
                            </p>
                            <hr style="border-color: black; margin-top: 0.5em;">
                            <p style="margin-bottom: 0; font-size: 1.5em;">
                                Niveau&nbsp&nbsp&nbsp&nbsp <?php echo $ProfilRecherche; ?>
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                Lieu <?php echo $LieuMission; ?><br>
                                Début / Fin  &nbsp&nbsp&nbsp<?php echo $DatedeDebut.' - '.$DatedeFin;?><br>
                            </p>
                            <hr style="border-color: black; margin: 1em 0 0.5 0;">
                            <p>
                                Rémunération : <?php echo $Prix.' €'; ?>
                            </p>

                        </div>
                        <div class="col-md-3">
                            <?php 
                            $set_post = "SELECT * FROM mission_postulant";
                            $resmiss = $_conn->query($set_post);
                            $has_post = 0;
                            $a++;
                            if ($resmiss->num_rows > 0) {
                                while ($row = $resmiss->fetch_assoc()) {
                                    if ($row['id_etudiant'] == $id && $IdMission == $row['id_mission']) {
                                        $has_post = 1;
                                    }
                                }
                            }

                            if ($has_post == 1) {
                                ?>

                                <button type="button" class="sent plus" id="info<?php echo $a ?>"  data-toggle="modal" data-target="#myModall<?php echo $a ?>" style="float:right;margin-right:25%;margin-top: 4em; ">Candidature envoyée</button>
                                <!-- Modal -->
                                <div class="modal fade" id="myModall<?php echo $a ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div style="margin:auto;text-align:justify">
                                                    <br><br>
                                                    <p class="profil-specialtext">Ville de la mission :</p><?php ($LieuMission) ? print " $LieuMission" : print "empty";?><br><br>
                                                    <p class="profil-specialtext">Rémunération de la mission :</p><?php ($Prix) ? print " $Prix €" : print "empty";?><br><br>
                                                    <p class="profil-specialtext">Profil recherché :</p><?php ($Audiovisuel) ? print " Audiovisuel" : print "";?>
                                                    <?php ($Graphisme) ? print " Graphisme" : print "";?>
                                                    <?php ($Informatique) ? print " Informatique" : print "";?>
                                                    <?php ($Marketing) ? print " Marketing" : print "";?>
                                                    <?php ($Communication) ? print " Communication" : print "";?>
                                                    <?php ($Droit) ? print " Droit" : print "";?>
                                                    <?php ($Finance) ? print " Finance" : print "";?>
                                                    <?php ($Evenementiel) ? print " Evenementiel" : print "";?><br><br>
                                                    <p class="profil-specialtext">Description :</p><?php ($Descriptif) ? print " $Descriptif" : print "empty";?><br><br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- EOM -->
                                <?php
                            }
                            if ($has_post == 0) {
                                ?>
                                <img src="../images/plus_blue.png" class="wantit" id="myButtonPerso<?php echo $a; ?>" style="float:right;margin-right:30%;position: relative; top: 4em;" data-toggle="modal" data-target="#myModal<?php echo $a; ?>">
                                <div style="clear: both;"></div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $a; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel"><?php ($NomMission) ? print "$NomMission" : print "Titre de la mission"; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                Date de début : <?php ($DatedeDebut) ? print "$DatedeDebut" : print ""; ?><br>
                                                Date de fin : <?php ($DatedeFin) ? print "$DatedeFin" : print ""; ?><br>
                                                Descriptif : <?php ($Descriptif) ? print "$Descriptif" : print ""; ?><br>
                                                Cahier des charges : <?php ($CdC) ? print "$CdC" : print ""; ?><br>
                                                Lieu : <?php ($LieuMission) ? print "$LieuMission" : print ""; ?><br>
                                                Rémunération : <?php ($Prix) ? print "$Prix" : print ""; ?>€<br>
                                                Profil recherché : <?php ($Informatique) ? print "Informatique " : print ""; ?>
                                                <?php ($Graphisme) ? print "Graphisme " : print ""; ?>
                                                <?php ($Evenementiel) ? print "Evenementiel " : print ""; ?>
                                                <?php ($Audiovisuel) ? print "Audiovisuel " : print ""; ?>
                                                <?php ($Marketing) ? print "Marketing " : print ""; ?>
                                                <?php ($Droit) ? print " Droit" : print "";?>
                                                <?php ($Finance) ? print " Finance" : print "";?>
                                                <?php ($Communication) ? print "Communication " : print ""; ?><br>
                                            </div>
                                            <div class="modal-footer">
                                                <?php
                                                $check_info = "SELECT * FROM youthie_etudiants WHERE id ='$id'";
                                                $info_stud = $_conn->query($check_info);
                                                if ($info_stud->num_rows > 0) {
                                                    while ($row_stud = $info_stud->fetch_assoc()) {
                                                        if (!(isset($row_stud['Pays'])) ||$row_stud['Pays'] == "") {
                                                            $info = 0;
                                                        }
                                                        else {
                                                            $info = 1;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <form id="sendstu" method="post" action="#">
                                                    <input type="hidden" name="IdMission" value="<?php echo $IdMission ?>">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                    <input type="hidden" name="a" value="<?php echo $a ?>">
                                                    <?php
                                                    if ($has_post == 1) {
                                                        ?>
                                                        <button type="button" class="sent" style="float:right;margin-right:3%">Candidature envoyée
                                                        </button>
                                                        <?php
                                                    }elseif($info == 0) {
                                                        ?>
                                                        <a href="../etudiant/">
                                                            <button type="button" class="btn btn-primary">Je Postule !</button>
                                                        </a><?php
                                                    } else {
                                                        ?> <button type="submit" class="btn btn-primary">Je Postule !</button> <?php
                                                    }
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- EOM -->
                                <?php
                            }
                            ?>
                            <br>
                            </div>
                            </div> <!-- Fin class Row -->
                            </div><br> <!-- Fin class Bigbox Container -->
                            <?php
                        }
                    }
                }
            }
            $_conn->close();
            ?>
        </section>

    </main>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>
<?php } ?> <!-- Fin de else pour la vérification de la connexion -->