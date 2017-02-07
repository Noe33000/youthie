<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Youthie : Faire d'une mission un succès</title>
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/youthie_form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    <script type="text/javascript">
        $(function() {
            $("form[id^='up_mission']").submit(function() {
                Titre = $(this).find("input[name=paramtitremission]").val();
                IdMiss = $(this).find("input[name=IdMiss]").val();
                Debutmiss = $(this).find("input[name=paramdatemission]").val();
                Finmiss = $(this).find("input[name=paramdureemission]").val();
                var Marketing = document.getElementById("parammarketing").checked;
                var Droit = document.getElementById("paramdroit").checked;
                var Finance = document.getElementById("paramfinance").checked;
                var Communication = document.getElementById("paramcommunication").checked;
                var Evenementiel = document.getElementById("paramevenementiel").checked;
                var Graphisme = document.getElementById("paramgraphisme").checked;
                var Informatique = document.getElementById("paraminformatique").checked;
                var Audiovisuel = document.getElementById("paramaudiovisuel").checked;
                Lieu = $(this).find("input[name=paramlieumission]").val();
                var Descriptif = document.getElementById("paramdescriptifmission").value;
                var Cahier = document.getElementById("paramcahierchargesmission").value;
                var Profil = document.getElementById("paramprofilrecherche").value;
                Jour = $(this).find("input[name=paramnbjour]").val();
                Budget = $(this).find("input[name=parambudgetmission]").val();
                Heure = $(this).find("input[name=paramnbheure]").val();
                Cent = $(this).find("input[name=paramctmission]").val();
                $.post("update_mission.php", {Titre: Titre, IdMiss: IdMiss, Debutmiss: Debutmiss, Finmiss: Finmiss, Marketing: Marketing, Droit: Droit, Finance:Finance, Communication: Communication, Evenementiel: Evenementiel, Graphisme: Graphisme, Informatique: Informatique, Audiovisuel: Audiovisuel, Profil: Profil, Lieu: Lieu, Descriptif: Descriptif, Cahier: Cahier, Jour: Jour, Heure: Heure, Budget: Budget, Cent: Cent}, function(data) {
                    if (data) {
                        console.log(data);
                    } else {
                        alert(data);
                    }
                });
                return false;
            });
        });
    </script>
    <script>
        $( function() {
            $( "#paramdatepicker" ).datepicker();
        } );
        $( function() {
            $( "#paramdatepickerend" ).datepicker();
        } );
    </script>
    <script src="../js/mode.js"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
    <section class="module content second">
        <div>
            <p style="text-align:left;margin-left:30px;font-size:30px;color:black;margin-bottom:0;text-align: center">
                Mission(s) publiée(s)
            </p><br>
        </div>
        <?php
        $date = date("d/m/Y");
        $_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
        //$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
        if($_conn->connect_error) {
            die("Connection failed : ". $_conn->connect_error);
        }
        $_sql = "SELECT * FROM youthie_mission";
        $_result = $_conn->query($_sql);
        $id = $_SESSION["id"];
        $IdProfessionnel = $id;
        $nb_pub = 0;
        if($_result->num_rows > 0) {
            while($_row = $_result->fetch_assoc()) {
                if ($_row['DatedeFin'] >= $date && $_row['EtapeMission'] == 1) {
                    $change_id = $_row['id'];
                    $update_etape = "UPDATE youthie_mission SET EtapeMission = '2' WHERE id = '$change_id'";
                    mysqli_query($_conn, $update_etape);
                }
                if($IdProfessionnel == $_row['IdProfessionnel']) {
                    $NomMission = $_row['Titre'];
                    $id_mission = $_row['id'];
                    $ParamDebut = $_row['DatedeDebut'];
                    $ParamFin = $_row['DatedeFin'];
                    $ParamCommunication = $_row['Communication'];
                    $ParamAudiovisuel = $_row['Audiovisuel'];
                    $ParamEvenementiel = $_row['Evenementiel'];
                    $ParamInformatique = $_row['Informatique'];
                    $ParamGraphisme = $_row['Graphisme'];
                    $ParamMarketing = $_row['Marketing'];
                    $ParamDroit = $_row['Droit'];
                    $ParamFinance = $_row['Finance'];
                    $Paramdesc = $_row['DescriptifMission'];
                    $Paramcahier = $_row['CahierdesCharges'];
                    $Paramjour = $_row['Nbjour'];
                    $Paramheure = $_row['Nbheure'];
                    $Parambudget = $_row['BudgetMission'];
                    $Paramvalue = $Parambudget / 100;
                    $Parameuros = explode(".", $Paramvalue);
                    $ppl_post = 0;
                    $alarm = 0;
                    $VilleMission = $_row['LieuMission'];
                    $DebutMission = $_row['DatedeDebut'];
                    $EtapeMission = $_row['EtapeMission'];
                    if (isset($_row['Appreciation'])) {
                        $Appreciation = $_row['Appreciation'];
                    }
                    ?>
                    <div class="row">
                    <div class="published_box1">
                        <?php
                        $nb_pub++;
                        if ($EtapeMission == 0) {
                            ?>
                            <button id="param<? echo $id_mission ?>" type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal<?php echo $id_mission ?>" style="float:right;margin-top:2px;margin-right:2px">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </button>
                            <?php
                        }
                        ?>
                        <p style="margin-top:20px;font-size:26px;margin-left:60px;color;black;font-weight:bold;margin-bottom:0px">
                            <?php ($NomMission) ? print "$NomMission" : print "Titre de la mission";?></p>
                        <p style="margin-top:5px;font-size:20px;margin-left:60px;color:black">
                            <?php ($VilleMission) ? print "$VilleMission" : print "Ville de la mission";?>
                            <br><?php ($DebutMission) ? print "$DebutMission" : print "Duree de la mission";?></p>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $id_mission ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div style="font-size:18px;margin:auto;text-align:justify">
                                        <form action="#" method="post" id="up_mission">
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Titre de la mission à réaliser*</label>
                                                <input name="paramtitremission" id="paramtitremission" class="form-control width" type="text" style="margin-left:10px" value="<?php if(isset($NomMission)) { echo $NomMission; } ?>" required/>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <div class="form-group">
                                                    <label style="margin-left:30px">Date de début de la mission*</label>
                                                    <input name="paramdatemission" type="text" id="paramdatepicker" class="form-control width" style="margin-left:10px" value="<?php if(isset($ParamDebut)) { echo $ParamDebut; } ?>" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <div class="form-group">
                                                    <label style="margin-left:30px ">Date de fin de la mission*</label>
                                                    <input name="paramdureemission" type="text" id="paramdatepickerend" class="form-control width" style="margin-left:10px" value="<?php if(isset($ParamFin)) { echo $ParamFin; } ?>" required>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="background-color:#F1F2F3;">
                                                <label style="margin-right:10px;margin-left:30px">Domaine(s) de la mission*</label>
                                                <tr >
                                                    <br><td>Marketing :</td>
                                                    <?php if ($ParamMarketing != '0' && $ParamMarketing != "false") {
                                                        ?><td><input checked type="checkbox"  id="parammarketing"></td><br> <?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="parammarketing" id="parammarketing"></td><br> <?php
                                                    }?>
                                                    <td>Communication :</td>
                                                    <?php if ($ParamCommunication != '0' && $ParamCommunication != "false") {
                                                        ?> <td><input checked type="checkbox" name="paramcommunication" id="paramcommunication"></td><br><?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paramcommunication" id="paramcommunication"></td><br> <?php
                                                    }?>
                                                    <td>Événementiel :</td>
                                                    <?php if ($ParamEvenementiel != '0' && $ParamEvenementiel != "false") {
                                                        ?>  <td><input checked type="checkbox" name="paramevenementiel" id="paramevenementiel"></td><br><?php
                                                    } else {
                                                        ?>  <td><input type="checkbox" name="paramevenementiel" id="paramevenementiel"></td><br><?php
                                                    }?>
                                                    <td>Graphisme :</td>
                                                    <?php if ($ParamGraphisme != '0' && $ParamGraphisme != "false") {
                                                        ?> <td><input checked type="checkbox" name="paramgraphisme" id="paramgraphisme"></td><br><?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paramgraphisme" id="paramgraphisme"></td><br> <?php
                                                    }?>
                                                    <td>Informatique :</td>
                                                    <?php if ($ParamInformatique != '0' && $ParamInformatique != "false") {
                                                        ?><td><input checked type="checkbox" name="paraminformatique" id="paraminformatique"></td><br> <?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paraminformatique" id="paraminformatique"></td><br> <?php
                                                    }?>
                                                    <td>Audiovisuel :</td>
                                                    <?php if ($ParamAudiovisuel != '0' && $ParamAudiovisuel != "false") {
                                                        ?><td><input checked type="checkbox" name="paramaudiovisuel" id="paramaudiovisuel"></td><br> <?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paramaudiovisuel" id="paramaudiovisuel"></td><br> <?php
                                                    }?>
                                                    <td>Droit :</td>
                                                    <?php if ($ParamDroit != '0' && $ParamDroit != "false") {
                                                        ?><td><input checked type="checkbox" name="paramdroit" id="paramdroit"></td><br> <?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paramdroit" id="paramdroit"></td><br> <?php
                                                    }?>
                                                    <td>Finance :</td>
                                                    <?php if ($ParamFinance != '0' && $ParamFinance != "false") {
                                                        ?><td><input checked type="checkbox" name="paramfinance" id="paramfinance"></td><br> <?php
                                                    } else {
                                                        ?><td><input type="checkbox" name="paramfinance" id="paramfinance"></td><br> <?php
                                                    }?>
                                                </tr>
                                            </div>
                                            <br>
                                            <div style="background-color:#F1F2F3">
                                                <label style="margin-left:30px">Profil recherché (formation)*</label>
                                                <select style="cursor:pointer;padding:6px;border-radius:5px;margin-left:10px" id="paramprofilrecherche" name="paramprofilrecherche" required>
                                                    <option value="Bac pro, BEP, CAP">Bac pro, BEP, CAP</option>
                                                    <option value="DUT, BTS, BAC +2">DUT, BTS, BAC +2</option>
                                                    <option value="Licence, BAC +3">Licence, BAC +3</option>
                                                    <option value="Master, BAC +5">Master, BAC +5</option>
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Lieu de la mission*</label><input name="paramlieumission" id="paramlieumission" class="form-control width" type="text" style="margin-left:10px" value="<?php if(isset($VilleMission)) { echo $VilleMission; } ?>" required/>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Descriptif de la mission*</label><br>
                                                <textarea style="margin-left:30px;margin-top:5px;resize:none;border-radius:5px" rows="8" cols="55" name="paramdescriptifmission" id="paramdescriptifmission" required><?php if(isset($Paramdesc)) { echo $Paramdesc; } ?></textarea>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Compétence(s) recherchée(s)</label><br>
                                                <textarea style="margin-left:30px;margin-top:5px;resize:none;border-radius:5px" rows="8" cols="55" name="paramcahierchargesmission" id="paramcahierchargesmission"><?php if(isset($Paramcahier)) { echo $Paramcahier; } ?></textarea>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Nombre de jour(s) par semaine*</label><input name="paramnbjour" id="paramnbjour" class="form-control width" type="text" style="margin-left:10px" value="<?php if(isset($Paramjour)) { echo $Paramjour; } ?>" required/>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Nombre d'heure(s) par jour*</label><input name="paramnbheure" id="paramnbheure" class="form-control width" type="text" style="margin-left:10px" value="<?php if(isset($Paramheure)) { echo $Paramheure; } ?>" required/>
                                            </div>
                                            <br>
                                            <div class="form-inline" style="background-color:#F1F2F3;">
                                                <label style="margin-left:30px">Budget alloué à la mission (incluant la commission)*</label>
                                                <input name="parambudgetmission" size="3" id="parambudgetmission" class="form-control width" type="text" style="margin-left:10px;margin-right:10px" value="<?php if(isset($Parameuros[0])) { echo $Parameuros[0]; } ?>" required/>,
                                                <input name="paramctmission" size="2" id="paramctmission" class="form-control width" type="text" style="margin-left:10px" value="<?php if(isset($Parameuros[1])) { echo $Parameuros[1]; } else { echo '00';} ?>" required/> €
                                            </div>
                                            <br>
                                            <input type="hidden" name="IdMiss" value="<?php echo $id_mission ?>">
                                            <button class="btn btn-default" type="submit" id="update_mission<?php echo $id_mission ?>" style="display:block;margin:auto">Mettre à jour</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- EOM -->
                    <div class="published_box2">
                    <?php
                    if ($_row['EtapeMission'] == 0) {
                        $get_miss = "SELECT * FROM mission_postulant";
                        $result_miss = $_conn->query($get_miss);
                        if ($result_miss->num_rows > 0) {
                            while ($row_miss = $result_miss->fetch_assoc()) {
                                if ($row_miss['id_mission'] == $id_mission && $alarm == 0) {
                                    $ppl_post = 1;
                                    $alarm = 1;
                                    ?>
                                    <br>
                                    <form method="get" action="../selection_profil/">
                                        <input type="hidden" name="idmission" value="<?php echo $id_mission ?>">
                                        <input type="image" src="../images/alarm.png" name="Nouvelles candidatures" style="width:90px;height:90px;margin-top:5px;margin-left:20px;position:absolute;border:none">
                                    </form>

                                    <?php
                                }}}
                        if ($ppl_post == 0) {
                            ?>
                            <div style="margin-top:20px">
                                <button type="button" class="lfp" style="float:right;margin-right:50px;margin-top:25px">Attente de profils</button>
                            </div>
                            <?php
                        }
                    }
                    if ($_row['EtapeMission'] == 1) {
                        $conn_stu = "SELECT * FROM youthie_etudiants";
                        $result_stu = $_conn->query($conn_stu);
                        if ($result_stu->num_rows > 0) {
                            while ($row_stu = $result_stu->fetch_assoc()) {
                                if ($_row['IdPromu'] == $row_stu['id']) {
                                    $_Utilisateur = $row_stu['Utilisateur'];
                                    $Utilisateur = explode(" ", $_Utilisateur);?>
                                    <div style="font-size:20px;margin-left:30px;color:black;margin-bottom:0px;width:30%;display:inline-block">
                                        <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?>
                                        <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?>
                                    </div>
                                    <div style="display:inline-block">
                                        <form style="height:147px">
                                            <div style="display:inline;float:right">
                                                <button type="button" class="wfp" style="margin-right:5px;margin-top:5px">Mission validée</button>
                                            </div>
                                            <div style="display:inline;float:left">
                                                <textarea style="margin-left:30px;margin-top:5px;resize:none" rows="6" cols="60" name="appreciation" id="appreciation">Appreciation</textarea>
                                            </div>
                                            <div style="display:inline;float:left;margin-top:40px;margin-left:45px">
                                                <br><br>
                                                <button class="btn" type="submit" style="margin-left:10px;float:right;">Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    if (isset($_POST['appreciation'])) {
                                        $Appreciation = $_POST['appreciation'];
                                        $idmiss = $_row['id'];
                                        $sql = "UPDATE youthie_mission SET Appreciation = '$Appreciation' WHERE id='$idmiss'";
                                        if (mysqli_query($_conn, $sql)) {
                                            echo '<br><div style="text-align:center">Appreciation postée avec succès</div><br>';
                                            echo '<meta http-equiv="refresh" content="2; url=https://www.youthie.io/mon-entreprise/">';
                                        } else {
                                            echo "Error updating record : " . mysqli_error($_conn);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if ($_row['EtapeMission'] == 2) {
                        $conn_stu = "SELECT * FROM youthie_etudiants";
                        $result_stu = $_conn->query($conn_stu);
                        if ($result_stu->num_rows > 0) {
                            while ($row_stu = $result_stu->fetch_assoc()) {
                                if ($_row['IdPromu'] == $row_stu['id']) {
                                    $_Utilisateur = $row_stu['Utilisateur'];
                                    $Utilisateur = explode(" ", $_Utilisateur);?>
                                    <div style="font-size:20px;margin-left:30px;color:black;margin-bottom:0px;width:30%;display:inline-block">
                                        <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?>
                                        <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?>
                                    </div>
                                    <div style="display:inline-block">
                                        <form style="height:147px">
                                            <div style="display:inline;float:right">
                                                <button type="button" class="mission_ended" style="margin-right:5px;margin-top:5px;">Mission passée</button>
                                            </div>
                                            <div style="display:inline;float:left">
                                                <textarea style="margin-left:30px;margin-top:5px;resize:none" rows="6" cols="60" name="appreciation" id="appreciation">Appreciation</textarea>
                                            </div>
                                            <br><br>
                                            <div style="display:inline;float:right;margin-top:40px;margin-left:45px">
                                                <button class="btn" type="submit" style="margin-left:10px;">Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    if (isset($_POST['appreciation'])) {
                                        $Appreciation = $_POST['appreciation'];
                                        $idmiss = $_row['id'];
                                        $sql = "UPDATE youthie_mission SET Appreciation = '$Appreciation' WHERE id='$idmiss'";
                                        if (mysqli_query($_conn, $sql)) {
                                            echo '<br><div style="text-align:center">Appreciation postée avec succès</div><br>';
                                            echo '<meta http-equiv="refresh" content="2; url=https://www.youthie.io/professionnel/">';
                                        } else {
                                            echo "Error updating record : " . mysqli_error($_conn);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                </div>
                </div>
                <br>
                <?php
            }
        }
        $_conn->close();
        if ($nb_pub == 0) {
            ?>
            <div style="margin-left:30px;margin-bottom:400px">
                <img style="height:200px;width:200px;margin-left:45%;margin-bottom:50px" src="../images/fusee.png">
               <p style="font-size:24px;text-align:center">
                   Vous n'avez publié aucune mission pour le moment, cliquez ici pour en publier une !
               </p><br>
                <a href="../mon-entreprise/">
                    <div class="rectangle">Publier une mission</div>
                </a>
            </div>
            <?php
        }
        ?>
    </section>


</body>
<?php require '../footer/footer.php'; ?>
</html>
