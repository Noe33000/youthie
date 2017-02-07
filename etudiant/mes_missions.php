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
    </head>
    <body>
    <div class="wrapper">
        <a href="../menumob/"><div class="nav-toggle"></div></a>
<?php require '../navbar/navbar.php'; ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-87485637-1', 'auto');
            ga('send', 'pageview');

        </script>

        <section class="module content">
            <p style="margin-left:30px;font-size:30px;color:black;text-align: center">
                Les missions en cours
            </p><br>
            <?php
            $i = 0;
            $_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
            //$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
            if($_conn->connect_error) {
                die("Connection failed : ". $_conn->connect_error);
            }
            $_sql = "SELECT * FROM youthie_mission";
            $current = 0;
            $id = $_SESSION["id"];
            $_result = $_conn->query($_sql);
            if($_result->num_rows > 0) {
                while ($_row = $_result->fetch_assoc()) {
                    if ($_row['EtapeMission'] == 1 && $id == $_row['IdPromu']) {
                        $NomMission = $_row['Titre'];
                        $current = 1;
                        $LieuMission = $_row['LieuMission'];
                        $DureeMission = $_row['DatedeDebut'];
                        ?>
                        <div class="annonce_bigbox">
                            <img src="../images/icon.png" style="width:5%;height:5%;margin-top:20px;margin-bottom:20px;margin-left:20px;float:left;"/>
                            <br>
                            <p style="font-size:26px;margin-left:50px;font-weight:bold;color;black;margin-bottom:0px;display:inline">
                                <?php ($NomMission) ? print "$NomMission" : print "Titre de la mission";?></p><br>
                            <?php
                            $_get_ent = "SELECT * FROM youthie_professionnels";
                            $_result_ent = $_conn->query($_get_ent);
                            if($_result_ent->num_rows > 0) {
                                while ($_row_ent = $_result_ent->fetch_assoc()) {
                                    if ($_row_ent['id'] == $_row['IdProfessionnel']) {
                                        $Entname = $_row_ent['NomdEntreprise'];
                                    }
                                }
                            }
                            ?>
                            <button type="button" class="wantit" style="float:right;margin-right:50px;margin-top:25px">Mission en cours</button>
                            <br><p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($Entname) ? print "$Entname" : print "Nom de l'entreprise";?><br></p>
                            <button type="button" class="plus" id="my_info<?php echo $i ?>"  data-toggle="modal" data-target="#myModal_start<?php echo $i ?>" style="margin-top:5px;margin-left:15%;position:absolute">+</button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal_start<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body" style="font-size:16px">
                                            <div style="font-size:18px;margin:auto;text-align:justify">
                                                <br><br><p class="profil-specialtext">Nom de l'entreprise :</p> <?php ($Entname) ? print " $Entname" : print "empty";?><br><br>
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
                            <p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($LieuMission) ? print "$LieuMission" : print "Lieu de la mission";?><br></p>
                            <p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($DureeMission) ? print "$DureeMission" : print "Début de la mission";?></p>
                        </div>
                        <?php
                    }
                    $i++;
                }
            }
            if ($current == 0) {
                ?>
                <div >
                    <img style="height:200px;width:200px;margin-left:45%;margin-bottom:50px" src="../images/fusee.png">
                    <p style="font-size:24px;text-align:center">
                        Vous n'avez aucune mission en cours, cliquez ici pour postuler !
                    </p><br>
                    <a href="../annonces-etudiant/">
                        <div class="rectangle">Annonces en ligne</div>
                    </a>
                </div>
                <?php
            }
            $_conn->close();
            ?>
            <br>
            <p style="margin-left:30px;font-size:30px;color:black;text-align: center">
                Les missions effectuées
            </p><br>
            <?php
            $_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
            //$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
            if($_conn->connect_error) {
                die("Connection failed : ". $_conn->connect_error);
            }
            $_sql = "SELECT * FROM youthie_mission";
            $id = $_SESSION["id"];
            $finished = 0;
            $_result = $_conn->query($_sql);
            if($_result->num_rows > 0) {
                while ($_row = $_result->fetch_assoc()) {
                    if ($_row['EtapeMission'] == 2 && $id == $_row['IdPromu']) {
                        $finished = 1;
                        $NomMission = $_row['Titre'];
                        $LieuMission = $_row['LieuMission'];
                        $DureeMission = $_row['DatedeDebut'];
                        ?>
                        <div class="annonce_bigbox">
                            <img src="../images/icon.png" style="width:140px;height:140px;margin-top:20px;margin-bottom:20px;margin-left:20px;float:left;"/>
                            <br><p style="font-size:26px;margin-left:50px;font-weight:bold;color;black;margin-bottom:0px;display:inline">
                                <?php ($NomMission) ? print "$NomMission" : print "Titre de la mission";?></p><br>
                            <?php
                            $_get_ent = "SELECT * FROM youthie_professionnels";
                            $_result_ent = $_conn->query($_get_ent);
                            if($_result_ent->num_rows > 0) {
                                while ($_row_ent = $_result_ent->fetch_assoc()) {
                                    if ($_row_ent['id'] == $_row['IdProfessionnel']) {
                                        $Entname = $_row_ent['NomdEntreprise'];
                                    }
                                }
                            }
                            ?>
                            <br><p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($Entname) ? print "$Entname" : print "Nom de l'entreprise";?><br></p>
                            <p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($LieuMission) ? print "$LieuMission" : print "Lieu de la mission";?><br></p>
                            <p style="margin-top:5px;font-size:20px;margin-left:50px;color:black;display:inline">
                                <?php ($DureeMission) ? print "$DureeMission" : print "Début de la mission";?></p>
                        </div>
                        <?php
                    }
                }
            }
            if ($finished == 0) {
                ?>
                <div >
                    <img style="height:200px;width:200px;margin-left:45%;margin-bottom:50px" src="../images/mec_louche.png">
                    <p style="font-size:24px;text-align:center">
                        Vous n'avez terminé aucune mission, cliquez ici pour postuler !
                    </p><br>
                    <a href="../annonces-etudiant/">
                        <div class="rectangle">Annonces en ligne</div>
                    </a>
                </div>
                <?php
            }
            $_conn->close();
            ?>
        </section>

    </body>
    <?php require '../footer/footer.php'; ?>
</html>

