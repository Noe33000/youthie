<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/youthie_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Youthie - Mon Entreprise</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-87485637-1', 'auto');
        ga('send', 'pageview');

    </script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
        $( function() {
            $( "#datepickerend" ).datepicker();
        } );
    </script>
    <script src="../js/mode.js"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">
    <a href="../menumob/"><div class="nav-toggle"></div></a>
    <?php require '../navbar/navbar.php'; ?>
    <section class="module content">
        <?php
        $id = $_SESSION["id"];
        // Create missions
        if(isset($_SESSION["statut"]) && $_SESSION["statut"] == 'Professionnel') {
            if (isset($_POST['budgetmission'])) {
                $IdProfessionnel = $id;
                $id = uniqid();
                $cdc = "";
                $DateParution = date('d/m/Y');
                $Graphisme = 0;
                $Communication = 0;
                $Audiovisuel = 0;
                $Informatique = 0;
                $Marketing = 0;
                $Evenementiel = 0;
                $Droit = 0;
                $Finance = 0;
                $Titre = $_POST['titremission'];
                $DureeMission = $_POST['dureemission'];
                $myDateTime = DateTime::createFromFormat('m/d/Y', $DureeMission);
                $newDateString = $myDateTime->format('d/m/Y');
                $DureeMission = $newDateString;
                $ProfilRecherche = $_POST['profilrecherche'];
                $DescriptifMission = $_POST['descriptifmission'];
                $LieuMission = $_POST['lieumission'];
                $CahierDesCharges = $_POST['cahierchargesmission'];
                if ($_POST['ctmission'] > 0 && $_POST['ctmission'] <= 9) {
                    $_POST['ctmission'] = $_POST['ctmission'] . "0";
                }
                if ($_POST['ctmission'] == 0) {
                    $_POST['ctmission'] = "00";
                }
                $BudgetMission = $_POST['budgetmission'] . $_POST['ctmission'];
                if (!(empty($_POST['communication']))) {
                    $Communication = $_POST['communication']; }
                if (!(empty($_POST['audiovisuel']))) {
                    $Audiovisuel = $_POST['audiovisuel']; }
                if (!(empty($_POST['evenementiel']))) {
                    $Evenementiel = $_POST['evenementiel']; }
                if (!(empty($_POST['informatique']))) {
                    $Informatique = $_POST['informatique']; }
                if (!(empty($_POST['graphisme']))) {
                    $Graphisme = $_POST['graphisme']; }
                if (!(empty($_POST['marketing']))) {
                    $Marketing = $_POST['marketing']; }
                if (!(empty($_POST['droit']))) {
                    $Droit = $_POST['droit']; }
                if (!(empty($_POST['finance']))) {
                    $Finance = $_POST['finance']; }
                if(!empty($_FILES['cdc']) && $_FILES['cdc']['name'] != "") {
                    if ($_FILES['cdc']['error'] > 0) {
                        $erreur = "Erreur lors du transfert";
                    }
                    if ($_FILES['cdc']['size'] > 1000000) {
                        $erreur = "Le fichier est trop gros";
                    }
                }
                if(!empty($_FILES['cdc']) && $_FILES['cdc']['name'] != "") {
                    if($_FILES['cdc']['error'] == 0 && is_uploaded_file($_FILES['cdc']['tmp_name'])) {
                        $code_user = $id; // code de l'utilisateur enregistré dans le formulaire.
                        $extension_cdc = strtolower(substr(strrchr($_FILES['cdc']['name'], '.'), 1));
                        if(move_uploaded_file($_FILES['cdc']['tmp_name'], "../cdc/$code_user.$extension_cdc")) {
                            echo 'Fichier enregistré';
                            $cdc = $code_user;
                        } else {
                            exit('Erreur lors de l\'enregistrement');
                        }
                    } else {
                        exit('Fichier non uploadé');
                    }
                }
                $DatedeDebut = $_POST['datemission'];
                $Nbjour = $_POST['nbjour'];
                $Nbheure = $_POST['nbheure'];
                $myDateTime = DateTime::createFromFormat('m/d/Y', $DatedeDebut);
                $newDateString = $myDateTime->format('d/m/Y');
                $DatedeDebut = $newDateString;
                $Appreciation = "Appreciation";
                $IdPromu = "";
                $IdPostulant = "";
                $conn = new mysqli("localhost", "root", "", "arkamitcjfefedb3");
                //$conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
                if (mysqli_connect_errno()) {
                    printf("Connect failed : %s\n", mysqli_connect_error());
                }
                $DescriptifMission = htmlspecialchars(mysqli_real_escape_string($conn, $DescriptifMission));
                $CahierDesCharges = htmlspecialchars(mysqli_real_escape_string($conn, $CahierDesCharges));
                $Titre = htmlspecialchars(mysqli_real_escape_string($conn, $Titre));
                $LieuMission = htmlspecialchars(mysqli_real_escape_string($conn, $LieuMission));
                $sql = "INSERT INTO youthie_mission (id, Titre, DatedeDebut, DatedeFin, cdc, ProfilRecherche, DescriptifMission, CahierDesCharges, BudgetMission, LieuMission, Audiovisuel, Graphisme, Marketing, Informatique, Evenementiel, Communication, Droit, Finance, IdProfessionnel, Appreciation, IdPromu, DateParution, Nbjour, Nbheure)
                    VALUES ('".$id."', '".$Titre."', '".$DatedeDebut."', '".$DureeMission."', '".$cdc."', '".$ProfilRecherche."', '".$DescriptifMission."', '".$CahierDesCharges."', '".$BudgetMission."', '".$LieuMission."', '".$Audiovisuel."', '".$Graphisme."', '".$Marketing."', '".$Informatique."', '".$Evenementiel."', '".$Communication."', '".$Droit."', '".$Finance."', '".$IdProfessionnel."', '".$Appreciation."', '".$IdPromu."', '".$DateParution."', '".$Nbjour."', '".$Nbheure."')";
                if (mysqli_query($conn, $sql)) {
                    echo '<br><div style="text-align:center">Mission postée avec succès</div><br>';
                    echo '<meta http-equiv="refresh" content="2; url=https://www.youthie.io/mission_pro/">';

                } else {
                    echo "Error updating record : " . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        }
        ?>
        <div>
            <p style="text-align:left;margin-left:30px;font-size:30px;color:black;">
                Dépôt d'annonce
            </p>
        </div>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Titre de la mission à réaliser*</label>
                <input name="titremission" id="titremission" class="form-control width" type="text" style="margin-left:10px" required/>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <div class="form-group">
                    <label style="margin-left:30px">Date de début de la mission*</label>
                    <input name="datemission" type="text" id="datepicker" class="form-control width" style="margin-left:10px" required>
                </div>
                <div class="form-group">
                    <label style="margin-left:30px ">Date de fin de la mission*</label>
                    <input name="dureemission" type="text" id="datepickerend" class="form-control width" style="margin-left:10px" required>
                </div>
            </div>
            <br>
            <div style="background-color:#F1F2F3">
                <label style="margin-right:10px;margin-left:30px">Domaine(s) de la mission*</label>
                <tr>
                    <td>Marketing :</td>
                    <td><input type="checkbox" name="marketing" id="marketing"></td>
                    <td>Communication :</td>
                    <td><input type="checkbox" name="communication" id="communication"></td>
                    <td>Événementiel :</td>
                    <td><input type="checkbox" name="evenementiel" id="evenementiel"></td>
                    <td>Graphisme :</td>
                    <td><input type="checkbox" name="graphisme" id="graphisme"></td>
                    <td>Informatique :</td>
                    <td><input type="checkbox" name="informatique" id="informatique"></td>
                    <td>Audiovisuel :</td>
                    <td><input type="checkbox" name="audiovisuel" id="audiovisuel"></td>
                    <td>Droit :</td>
                    <td><input type="checkbox" name="droit" id="droit"></td>
                    <td>Finance :</td>
                    <td><input type="checkbox" name="finance" id="finance"></td>
                </tr>
            </div>
            <br>
            <div style="background-color:#F1F2F3">
                <label style="margin-left:30px">Profil recherché (formation)*</label>
                <select style="cursor:pointer;padding:6px;border-radius:5px;margin-left:10px" id="profilrecherche"
                        name="profilrecherche" required>
                    <option value="Bac pro, BEP, CAP">Bac pro, BEP, CAP</option>
                    <option value="DUT, BTS, BAC +2">DUT, BTS, BAC +2</option>
                    <option value="Licence, BAC +3">Licence, BAC +3</option>
                    <option value="Master, BAC +5">Master, BAC +5</option>
                </select>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Lieu de la mission*</label><input name="lieumission" id="lieumission" class="form-control width" type="text" style="margin-left:10px" required/>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Descriptif de la mission*</label><br>
                <textarea style="margin-left:30px;margin-top:5px;resize:none;border-radius:5px" rows="8" cols="90" name="descriptifmission" id="descriptifmission" required></textarea>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Compétence(s) recherchée(s)</label><br>
                <textarea style="margin-left:30px;margin-top:5px;resize:none;border-radius:5px" rows="8" cols="90" name="cahierchargesmission" id="cahierchargesmission" ></textarea>
            </div><br>
            <div style="background-color:#F1F2F3;"><br>
                <label style="float:left;margin-bottom:0;margin-left:30px">Cahier des charges : </label><input style="display:inline;float:left" type="file" name="cdc" id="cdc"><br><br>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Nombre de jour(s) par semaine*</label><input onblur="myFunction()" name="nbjour" id="nbjour" class="form-control width" type="text" style="margin-left:10px" required/>
            </div>
            <br>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Nombre d'heure(s) par jour*</label><input onblur="myFunction()" name="nbheure" id="nbheure" class="form-control width" type="text" style="margin-left:10px" required/>
            </div>
            <script>
                function myFunction() {
                    var jour = document.getElementById("nbjour").value;
                    var heure = document.getElementById("nbheure").value;
                    if ($.isNumeric(jour) == true && $.isNumeric(heure) == true) {
                        if ((jour <= 7) == true && (heure <= 24) == true && (jour > 0) == true && (heure > 0) == true) {
                            res = jour * heure * 10;
                            res += res * 8 / 100;
                            if (res != 0) {
                                $('.prix').show();
                                mytext = "Il vous est conseillé de valoriser cette mission d'un minimum de " + res + " € par semaine à raison de 10 € de l'heure (avec les 8% de commisison).";
                                document.getElementById("estimation").innerHTML = mytext;
                            }
                            else {
                                $('.prix').hide();
                            }
                        }
                        else {
                            $('.prix').hide();
                        }
                    }
                    else {
                        $('.prix').hide();
                    }
                }
            </script>
            <br>
            <div class="prix" style="display:none;margin-bottom:10px;">
                <p style="color:black;font-size:14px;margin-left:30px" id="estimation"></p>
            </div>
            <div class="form-inline" style="background-color:#F1F2F3;">
                <label style="margin-left:30px">Budget alloué à la mission (incluant la commission)*</label>
                <input name="budgetmission" size="3" id="budgetmission" class="form-control width" type="text" style="margin-left:10px;margin-right:10px" required/>,
                <input name="ctmission" size="2" id="ctmission" class="form-control width" type="text" style="margin-left:10px" required/> €
            </div>
            <br>
            <button class="btn btn-default" type="submit" style="display:block;margin:auto">Enregistrer</button>
        </form>
    </section>
</div>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
</body>
<?php require '../footer/footer.php'; ?>
</html>