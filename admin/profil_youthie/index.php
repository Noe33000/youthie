<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Profil Youthie</title>
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/youthie_form.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
</div>
<p class="profil-youthie-tittle" align="center">Sélection des profils</p>
<?php
$id_square = 0;
$id_chose = 0;
$id_Miss = 0;
$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
//$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
if($_conn->connect_error) {
    die("Connection failed : ". $_conn->connect_error);
}
$count_stud = "SELECT COUNT(*) FROM youthie_etudiants";
$count_pro = "SELECT COUNT(*) FROM youthie_professionnels";
$my_stud = $_conn->query($count_stud);
$my_pro = $_conn->query($count_pro);
$nb_stud = $my_stud->fetch_assoc();
$nb_pro = $my_pro->fetch_assoc();
$_sql = "SELECT * FROM youthie_mission";
$_result = $_conn->query($_sql);?>
<p class="profil-youthie-tittle" align="center">
    Il y a <?php echo $nb_stud['COUNT(*)'] ?> étudiants inscrits et <?php echo $nb_pro['COUNT(*)'] ?> entreprises.
</p>
<?php
if($_result->num_rows > 0) {
    while ($_row = $_result->fetch_assoc()) {
        if ($_row['EtapeMission'] == 0 || $_row['EtapeMission'] == 1) {
            $id_square++;
            $id_Miss++;
            $nb_stud = 0;
            $IdMiss = $_row['id'];
            $IdPro = $_row['IdProfessionnel'];
            $Email_sent = $_row['Email_sent'];
            $NomMission = $_row['Titre'];
            $DateDebut = $_row['DatedeDebut'];
            $DateFin = $_row['DatedeFin'];
            if (isset($_row['Nbjour'])) {
                $Nbjour = $_row['Nbjour'];
            }
            else {
                $Nbjour = 0;
            }
            if (isset($_row['Nbheure'])) {
                $Nbheure = $_row['Nbheure'];
            }
            else {
                $Nbheure = 0;
            }
            $Localisation = $_row['LieuMission'];
            $Description = $_row['DescriptifMission'];
            $Remuneration = $_row['BudgetMission'];
            $Remuneration = $Remuneration / 100;
            $Audiovisuel = $_row['Audiovisuel'];
            $Graphisme = $_row['Graphisme'];
            $Informatique = $_row['Informatique'];
            $cdc = $_row['cdc'];
            if ($cdc != "") {
                $cdc = '../cdc/' . $cdc;
            }
            $Marketing = $_row['Marketing'];
            $Communication = $_row['Communication'];
            $Evenementiel = $_row['Evenementiel'];
            $Droit = $_row['Droit'];
            $Finance = $_row['Finance'];
            $get_pro = "SELECT * FROM youthie_professionnels WHERE id = '$IdPro'";
            $result_pro = $_conn->query($get_pro);
            $row_pro = $result_pro->fetch_assoc();
            $NomEntreprise = $row_pro['NomdEntreprise'];
            $EmailEntreprise = $row_pro['Email'];
            if (!(empty($row_pro['Pays']))) {
                $Pays = $row_pro['Pays'];
                $ZoneEntreprise = explode(";", $Pays);
                $CPEntreprise = $ZoneEntreprise[0];
                $VilleEntreprise = $ZoneEntreprise[1];
                $PaysEntreprise = $ZoneEntreprise[2];
            }
            $amount_stud = "SELECT * FROM mission_postulant WHERE id_mission = '$IdMiss'";
            $result_amount = $_conn->query($amount_stud);
            while ($row_amount = $result_amount->fetch_assoc()) {
                $nb_stud++;
            }
            $stud_choisi = 0;
            $amount_choisi = "SELECT * FROM mission_choisi WHERE id_mission = '$IdMiss'";
            $result_choisi = $_conn->query($amount_choisi);
            while ($row_choisi = $result_choisi->fetch_assoc()) {
                $stud_choisi++;
            }
            $MobileEntreprise = $row_pro['Mobile'];
            ?>
            <div class="profil-largebox">
                <form id="email_pro" method="post" action="#">
                    <input type="hidden" name="Email" value="<?php echo $EmailEntreprise ?>">
                    <input type="hidden" name="IdMIss" value="<?php echo $IdMiss ?>">
                    <button id="send_mail<? echo $id_square ?>" type="submit" class="btn btn-default"  style="float:right;margin-top:2px;margin-right:2px">
                        <?php if ($Email_sent == 1) {
                            ?>
                            <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                            <?php
                        } else {
                            ?>
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            <?php
                        }
                        ?>
                    </button>
                </form>
                <img src="../images/icon.png" class="profil-icon"/>
                <p class="profil-missname">
                    <?php  echo $NomMission ?>
                </p>
                <div style="float:right;margin-right:50px;">
                    <button onclick="show_student_zone(this.id)" id="<?php echo $id_Miss?>" type="button" class="wfp">Voir les profils intéréssés</button>
                </div>
                <button type="button" class="plus" id="info<?php echo $id_Miss;?>"  data-toggle="modal" data-target="#myModal<?php echo $id_Miss;?>" style="display:none;margin-top:5px;margin-left:520px;position:absolute">+</button>
                <div>
                    <p style="font-size:20px;float:right;margin-right:5%;display:inline">
                        <?php echo $nb_stud . ' demande(s) d\'étudiant(es) !'?>
                    </p>
                </div>
                <p class="profil-infomiss">
                    <?php echo $NomEntreprise ?><br>
                    <?php echo $Localisation ?><br>
                    <?php echo 'Du ' . $DateDebut . ' au ' . $DateFin ?>
                </p>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo $id_Miss; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body" style="font-size:16px">
                            <div style="font-size:18px;margin:auto;text-align:justify">
                                <br><br><p class="profil-specialtext">Nom de l'entreprise :</p> <?php ($NomEntreprise) ? print " $NomEntreprise" : print "empty";?><br><br>
                                <p class="profil-specialtext">Email de l'entreprise :</p><?php ($EmailEntreprise) ? print " $EmailEntreprise" : print "empty";?><br><br>
                                <p class="profil-specialtext">Ville de l'entrepise :</p><?php ($VilleEntreprise) ? print " $VilleEntreprise" : print "empty";?><br><br>
                                <p class="profil-specialtext">Telephone de l'entreprise :</p><?php ($MobileEntreprise) ? print " $MobileEntreprise" : print "empty";?><br><br>
                                <p class="profil-specialtext">Rémunération de la mission :</p><?php ($Remuneration) ? print " $Remuneration €" : print "empty";?><br><br>
                                <p class="profil-specialtext">Horaires de la mission :</p><?php ($Nbjour) ? print " $Nbjour " : print "empty ";?> jour(s) par semaine à raison de <?php ($Nbheure) ? print " $Nbheure " : print "empty ";?> heure(s) par jour<br><br>
                                <p class="profil-specialtext">Profil recherché :</p><?php ($Audiovisuel) ? print " Audiovisuel" : print "";?>
                                <?php ($Graphisme) ? print " Graphisme" : print "";?>
                                <?php ($Informatique) ? print " Informatique" : print "";?>
                                <?php ($Marketing) ? print " Marketing" : print "";?>
                                <?php ($Communication) ? print " Communication" : print "";?>
                                <?php ($Droit) ? print " Droit" : print "";?>
                                <?php ($Finance) ? print " Finance" : print "";?>
                                <?php ($Evenementiel) ? print " Evenementiel" : print "";?><br><br>
                                <p class="profil-specialtext">Lieu de la mission :</p><?php ($Localisation) ? print " $Localisation" : print "empty";?><br><br><br>
                                <p class="profil-specialtext">Description :</p><?php ($Description) ? print " $Description" : print "empty";?><br><br><br>
                                <?php if (isset($cdc)  && $cdc != "" && $cdc != "../cdc/") {
                                    ?>
                                    <a href="<?php echo $cdc ?>" download="<?php echo $cdc ?>">
                                        <img border="0" src="../images/arrow.png" alt="dwl" style="width:30px;height:30px">
                                    </a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- EOM -->
            <?php
            $hauteur = 1;
            $stud_square = 0;
            if ($nb_stud == 0) {
                $hauteur = 0;
            }
            while ($nb_stud > 5) {
                $nb_stud -= 5;
                $hauteur++;
            }
            $hauteur *= 225;
            ?>
            <div class="profil-student-zone" id="student-zone<?php echo $id_square ?>" style="height:<?php echo $hauteur ?>px">
                <?php
                $check_stud = "SELECT * FROM mission_postulant WHERE id_mission = '$IdMiss'";
                $result_check = $_conn->query($check_stud);
                while ($row_check = $result_check->fetch_assoc()) {
                    $IdStud = $row_check['id_etudiant'];
                    $info_stud = "SELECT * FROM youthie_etudiants WHERE id = '$IdStud'";
                    $result_stud = $_conn->query($info_stud);
                    $detail_stud = $result_stud->fetch_assoc();
                    $_Utilisateur = $detail_stud['Utilisateur'];
                    $Utilisateur = explode(" ", $_Utilisateur);
                    $Audiovisuel = $detail_stud['Audiovisuel'];
                    $Graphisme = $detail_stud['Graphisme'];
                    $Droit = $detail_stud['Droit'];
                    $Finance = $detail_stud['Finance'];
                    $Informatique = $detail_stud['Informatique'];
                    $Marketing = $detail_stud['Marketing'];
                    $Communication = $detail_stud['Communication'];
                    $Evenementiel = $detail_stud['Evenementiel'];
                    $MobileEtudiant = $detail_stud['Mobile'];
                    $EmailEtudiant = $detail_stud['Email'];
                    $Universite = $detail_stud['UniversiteEcole'];
                    $Formation = $detail_stud['NiveaudeFormation'];
                    $_PaysEtudiant = $detail_stud['Pays'];
                    $PaysEtudiant = explode(";", $_PaysEtudiant);
                    $Description = $detail_stud['Description'];
                    $cv = $detail_stud['cv'];
                    if ($cv != "") {
                        $cv = '../cv/' . $cv;
                    }
                    $cvname = $detail_stud['cvOriginal'];
                    ?>
                    <div id="<?php echo $id_chose; $id_chose++?>" class="profil-student-box">
                        <form id="rem-post" method="post" action="#">
                            <input type="hidden" name="IdMiss" value="<?php echo $IdMiss ?>">
                            <input type="hidden" name="IdStud" value="<?php echo $IdStud ?>">
                            <button type="submit" class="moins-rouge" id="remove-post<?php echo $IdStud ?>" style="float:right">x</button>
                        </form>
                        <p style="margin-top:3px;margin-left:3px;">
                            <?php var_dump($utilisateur);?>
                            <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                            <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                            <?php if ($Audiovisuel && $Audiovisuel != 'sansavis') {
                                echo 'Audiovisuel : ' . $Audiovisuel;
                            }?><br>
                            <?php if ($Graphisme && $Graphisme != 'sansavis') {
                                echo 'Graphisme : ' . $Graphisme;
                            }?><br>
                            <?php if ($Informatique && $Informatique != 'sansavis') {
                                echo 'Informatique : ' . $Informatique;
                            }?><br>
                            <?php if ($Marketing && $Marketing != 'sansavis') {
                                echo 'Marketing : ' . $Marketing;
                            }?><br>
                            <?php if ($Communication && $Communication != 'sansavis') {
                                echo 'Communication : ' . $Communication;
                            }?><br>
                            <?php if ($Evenementiel && $Evenementiel != 'sansavis') {
                                echo 'Evenementiel : ' . $Evenementiel;
                            }?><br>
                            <?php if ($Droit && $Droit != 'sansavis') {
                                echo 'Droit : ' . $Droit;
                            }?><br>
                            <?php if ($Finance && $Finance != 'sansavis') {
                                echo 'Finance : ' . $Finance;
                            }?><br>
                        </p>
                        <?php
                        $is_choose = "SELECT * FROM mission_choisi WHERE id_etudiant = '$IdStud' AND id_mission = '$IdMiss'";
                        $result_choose = $_conn->query($is_choose);
                        $choose = $result_choose->fetch_assoc();
                        if (isset($choose)) {
                            ?>
                            <form id="rem-choisi" method="post" action="#">
                                <input type="hidden" name="IdMiss" value="<?php echo $IdMiss ?>">
                                <input type="hidden" name="IdStud" value="<?php echo $IdStud ?>">
                                <button type="submit" class="moins-rouge" id="remove-stud<?php echo $IdStud ?>" style="float:left">-</button>
                            </form>
                            <img  src="../images/star.png" style="float:right;width:40px;height:40px">
                            <?php
                        } else {
                            ?>
                            <button type="button" class="plus-blue" id="<?php echo $id_chose ?>"  data-toggle="modal" data-target="#myModal<?php echo $id_chose ?>" style="float:right">+</button>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $id_chose ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body" style="font-size:16px">
                                    <div style="font-size:18px;margin:auto;text-align:justify">
                                        <br><br>
                                        <p class="profil-specialtext" style="display: inline">Nom</p><?php ($Utilisateur[0]) ? print " : $Utilisateur[0] " : print "Nom ";?><br>
                                        <p class="profil-specialtext" style="display: inline">Prenom</p><?php ($Utilisateur[1]) ? print " : $Utilisateur[1]" : print "Prenom";?><br>
                                        <?php if(isset($PaysEtudiant[0])) {
                                            ?><p class="profil-specialtext" style="display: inline">Code postal</p><?php
                                            ($PaysEtudiant[0]) ? print " : $PaysEtudiant[0]" : print "Code postal"?> <br> <?php
                                        } ?>
                                        <?php if(isset($PaysEtudiant[1])) {
                                            ?><p class="profil-specialtext" style="display: inline">Ville</p><?php
                                            ($PaysEtudiant[1]) ? print " : $PaysEtudiant[1]" : print "VIlle" ?><br> <?php
                                        }?>
                                        <?php if(isset($PaysEtudiant[2])) {
                                            ?><p class="profil-specialtext" style="display: inline">Pays</p><?php
                                            ($PaysEtudiant[2]) ? print " : $PaysEtudiant[2]" : print "Pays" ?><br> <?php
                                        }?>
                                        <p class="profil-specialtext" style="display: inline">Téléphone</p><?php ($MobileEtudiant) ? print " : $MobileEtudiant" : print "Telephone" ?><br>
                                        <p class="profil-specialtext" style="display: inline">Email</p><?php ($EmailEtudiant) ? print " : $EmailEtudiant" : print "Email" ?><br>
                                        <p class="profil-specialtext" style="display: inline">Université/école</p><?php ($Universite) ? print " : $Universite" : print "Universite/Ecole" ?><br>
                                        <p class="profil-specialtext" style="display: inline">Formation</p><?php ($Formation) ? print " : $Formation" : print "Formation" ?><br>
                                        <?php if ($Audiovisuel && $Audiovisuel != 'sansavis' && $Audiovisuel != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Audiovisuel</p><?php
                                            print ' : ' . $Audiovisuel; ?> <br> <?php
                                        }?>
                                        <?php if ($Graphisme && $Graphisme != 'sansavis' && $Graphisme != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Graphisme</p><?php
                                            print ' : ' . $Graphisme; ?> <br> <?php
                                        }?>
                                        <?php if ($Informatique && $Informatique != 'sansavis' && $Informatique != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Informatique</p><?php
                                            print ' : ' . $Informatique; ?> <br> <?php
                                        }?>
                                        <?php if ($Marketing && $Marketing != 'sansavis' && $Marketing != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Marketing</p><?php
                                            print ' : ' . $Marketing; ?> <br> <?php
                                        }?>
                                        <?php if ($Communication && $Communication != 'sansavis' && $Communication != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Communication</p><?php
                                            print ' : ' . $Communication; ?> <br> <?php
                                        }?>
                                        <?php if ($Evenementiel && $Evenementiel != 'sansavis' && $Evenementiel != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Evenementiel</p><?php
                                            print ' : ' . $Evenementiel; ?> <br> <?php
                                        }?>
                                        <?php if ($Droit && $Droit != 'sansavis' && $Droit != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Droit</p><?php
                                            print ' : ' . $Droit; ?> <br> <?php
                                        }?>
                                        <?php if ($Finance && $Finance != 'sansavis' && $Finance != "") {
                                            ?><p class="profil-specialtext" style="display: inline">Finance</p><?php
                                            print ' : ' . $Finance; ?> <br> <?php
                                        }?>
                                        <p class="profil-specialtext">Description : </p><?php ($Description) ? print "$Description" : print "Description" ?><br><br><br>
                                    </div>
                                    <?php if (isset($cv) && isset($cvname) && $cv != "" && $cv != "../cv/") {
                                        ?>
                                        <a href="<?php echo $cv ?>" download="<?php echo $cvname ?>">
                                            <img border="0" src="../images/arrow.png" alt="dwl" style="width:30px;height:30px">
                                        </a>
                                    <?php }?>
                                    <div class="modal-footer">
                                        <form id="selectstu" method="post" action="#">
                                            <input type="hidden" name="IdMiss" value="<?php echo $IdMiss ?>">
                                            <input type="hidden" name="IdStud" value="<?php echo $IdStud ?>">
                                            <?php
                                            if ($stud_choisi < 5) {
                                                ?>
                                                <button id="select<?php echo $IdStud ?>" type="submit" class="wfp" style="margin-left:80px">Je choisi ce candidat !</button>
                                                <?php
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOM -->
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}
$_conn->close();
?>
</body>
<?php require '../footer/footer.php'; ?>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    })
</script>
<script>
    function show_student_zone(id) {
        var zone = "student-zone" + id;
        var plus = "info" + id;
        divInfo = document.getElementById(zone);
        divPlus = document.getElementById(plus);
        if (divInfo.style.display == 'none' && divPlus.style.display == 'none') {
            divInfo.style.display = 'block';
            divPlus.style.display = 'block';
        }
        else {
            divInfo.style.display = 'none';
            divPlus.style.display = 'none';
        }
    }
</script>
<script type="text/javascript">
    $(function() {
        $("form[id^='selectstu']").submit(function() {
            var buttonVal = $(this).find("input[name=IdStud]").val();
            var mod = "myModal" + buttonVal;
            id = $(this).find("input[name=IdStud]").val();
            IdMiss = $(this).find("input[name=IdMiss]").val();
            $.post("select-student.php", {IdStud: id, IdMiss: IdMiss}, function(data) {
                if (data == "<br><div style=\"text-align:center\">Demande correctement envoyée</div><br><meta http-equiv=\"refresh\" content=\"2; url=../profil_youthie/\">") {
                    $('#' + mod).hide();
                    $('.modal-backdrop').hide();
                    window.location.reload(false);
                } else {
                    alert("Erreur dans la requête !")
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $("form[id^='rem-choisi']").submit(function() {
            id = $(this).find("input[name=IdStud]").val();
            IdMiss = $(this).find("input[name=IdMiss]").val();
            $.post("remove-student.php", {IdStud: id, IdMiss: IdMiss}, function(data) {
                if (data == "<br><div style=\"text-align:center\">Demande correctement envoyée</div><br><meta http-equiv=\"refresh\" content=\"2; url=../profil_youthie/\">") {
                    window.location.reload(false);
                } else {
                    alert("Erreur dans la requête !")
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $("form[id^='rem-post']").submit(function() {
            id = $(this).find("input[name=IdStud]").val();
            IdMiss = $(this).find("input[name=IdMiss]").val();
            $.post("rem-post.php", {IdStud: id, IdMiss: IdMiss}, function(data) {
                if (data == "<br><div style=\"text-align:center\">Demande correctement envoyée</div><br><meta http-equiv=\"refresh\" content=\"2; url=../profil_youthie/\">") {
                    window.location.reload(false);
                } else {
                    alert("Erreur dans la requête !")
                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $("form[id^='email_pro']").submit(function() {
            Email = $(this).find("input[name=Email]").val();
            IdMiss = $(this).find("input[name=IdMiss]").val();
            $.post("send_mail.php", {Email: Email, IdMiss: IdMiss}, function(data) {
                if (data == "ok") {
                    alert("Mail correctement envoyé !")
                } else {
                    alert("Mail non envoyé !")
                }
            });
            return false;
        });
    });
</script>
</html>