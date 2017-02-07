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
    <title>Youthie - Sélection profil</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
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
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    </script>
    <script>
        function show_pay() {
            divInfo = document.getElementById('payzone');
            if (divInfo.style.display == 'none')
                divInfo.style.display = 'block';
            else
                divInfo.style.display = 'none';

        }
    </script>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">

    <a href="../menumob/"><div class="nav-toggle"></div></a>

    <?php require '../navbar/navbar.php'; ?>
    <main>
        <p style="font-size:38px;color:#3CB5E8" align="center">Sélection du profil</p>
        <div class="img_box" style="margin-left:7.5%">
            <img title="Photo_profile" src="../images/icon.png" style="position:absolute;width:100%"/>
        </div>
        <div class="img_box">
            <img title="Photo_profile" src="../images/icon.png" style="position:absolute;width:100%"/>
        </div>
        <div class="img_box">
            <img title="Photo_profile" src="../images/icon.png" style="position:absolute;width:100%"/>
        </div>
        <div class="img_box">
            <img title="Photo_profile" src="../images/icon.png" style="position:absolute;width:100%"/>
        </div>
        <div class="img_box" style="margin-right:7.5%">
            <img title="Photo_profile" src="../images/icon.png" style="position:absolute;width:100%"/>
        </div>
        <?php
        $box = 1;
        $nb = 0;
        if (isset($_GET)) {
            $id_miss = $_GET['idmission'];
        }
        //$conn_select = new mysqli("localhost","root", "", "arkamitcjfefedb3");
        $conn_select = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
        if($conn_select->connect_error) {
            die("Connection failed : ". $conn_select->connect_error);
        }
        $sql_pro = "SELECT * FROM youthie_professionnels";
        $result_pro = $conn_select->query($sql_pro);
        while ($row_pro = $result_pro->fetch_assoc() ) {
            if ($_SESSION['id'] == $row_pro['id']) {
                $Emailpro = $row_pro['Email'];
                $_Utilisateurpro = $row_pro['Utilisateur'];
                $Utilisateurpro = explode(" ", $_Utilisateurpro);
            }
        }
        $sql_am = "SELECT * FROM youthie_mission";
        $result_am = $conn_select->query($sql_am);
        while ($row_am = $result_am->fetch_assoc() ) {
            if ($id_miss == $row_am['id']) {
                $Amount = $row_am['BudgetMission'];
            }
        }
        $get_mission = "SELECT * FROM mission_choisi";
        $result_mission = $conn_select->query($get_mission);
        if($result_mission->num_rows > 0) {
            while ($row_mission = $result_mission->fetch_assoc()) {
                if ($id_miss == $row_mission['id_mission']) {
                    $get_student = "SELECT * FROM youthie_etudiants";
                    $result_student = $conn_select->query($get_student);
                    if ($result_student->num_rows > 0) {
                        while ($row_student = $result_student->fetch_assoc()) {
                            if ($row_mission['id_etudiant'] == $row_student['id']) {
                                $_Utilisateur = $row_student['Utilisateur'];
                                $Utilisateur = explode(" ", $_Utilisateur);
                                $IdPromu = $row_student['id'];
                                if (isset($row_student['Avatar'])) {
                                    $avatar = $row_student['Avatar'];
                                }
                                $NiveauFormation = $row_student['NiveaudeFormation'];
                                $Audiovisuel = $row_student['Audiovisuel'];
                                $Graphisme = $row_student['Graphisme'];
                                $Informatique = $row_student['Informatique'];
                                $Marketing = $row_student['Marketing'];
                                $Droit = $row_student['Droit'];
                                $Finance = $row_student['Finance'];
                                $Communication = $row_student['Communication'];
                                $Ecole = $row_student['UniversiteEcole'];
                                $Evenementiel = $row_student['Evenementiel'];
                                $Email = $row_student['Email'];
                                $Mobile = $row_student['Mobile'];
                                if ($box == 1) {
                                    $box++;
                                    ?>
                                    <div class="select_box" style="margin-left:7.5%">
                                        <p style="position:absolute;font-size:14px;margin-top:28px;margin-left:15px">
                                            <br><?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br><br>
                                            <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br><br>
                                            <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br><br>
                                            Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br><br>
                                            Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br><br>
                                            Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br><br>
                                            Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br><br>
                                            Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br><br>
                                            Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br><br>
                                            Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br><br>
                                            Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br><br>
                                            <button type="button" class="choose" id="myButtonPerso<?php echo $nb ?>"  data-toggle="modal" data-target="#myModal<?php echo $nb ?>" style="margin-left:25%;margin-top:30%">Choisir</button>
                                        </p>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal<?php echo $nb ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body" style="font-size:16px">
                                                    <?php
                                                    if (isset($avatar)) {
                                                        ?><img title="Photo_profile" src="../avatar/<?php echo $avatar ?>" style="position:relative;width:150px;margin-bottom:100px;height:150px;float:left"/><?php
                                                    }
                                                    else {
                                                        ?> <img title="Photo_profile" src="../images/icon.png" style="position:relative;width:150px;margin-bottom:100px;height:150px;float:left"/><?php
                                                    }
                                                    ?>
                                                    <p style="font-size:14px;margin-bottom:5px;margin:auto">
                                                        <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                                                        <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                                                        <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br>
                                                        <?php ($Ecole) ? print "$Ecole" : print "Ecole";?><br>
                                                        Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br>
                                                        Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br>
                                                        Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br>
                                                        Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br>
                                                        Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br>
                                                        Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br>
                                                        Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br>
                                                        Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br><br>
                                                    </p>
                                                    <button onclick="show_pay()" type="submit" class="select_profile" style="margin:auto;display:block">Choisir ce candidat</button><br>
                                                    <button type="button" class="select_profile" data-dismiss="modal" aria-label="Close" style="margin:auto;display:block">
                                                        Revenir à l'espace sélection
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- EOM -->
                                    <?php
                                    $nb++;
                                }
                                else if ($box == 5) {
                                    ?>
                                    <div class="select_box" style="margin-right:7.5%">
                                        <p style="position:absolute;font-size:14px;margin-top:28px;margin-left:20px">
                                            <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                                            <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                                            <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br>
                                            Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br>
                                            Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br>
                                            Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br>
                                            Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br>
                                            Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br>
                                            Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br>
                                            Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br>
                                            Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br>
                                            <button type="button" class="choose" id="myButtonPerso<?php echo $nb ?>"  data-toggle="modal" data-target="#myModal<?php echo $nb ?>" style="margin-left:25%;margin-top:80%">Choisir</button>
                                        </p>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal<?php echo $nb ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body" style="font-size:16px">
                                                    <img title="Photo_profile" src="../images/icon.png" style="position:relative;width:150px;margin-bottom:100px;height:150px;float:left"/>
                                                    <p style="font-size:14px;margin-bottom:5px;margin:auto">
                                                        <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                                                        <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                                                        <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br>
                                                        <?php ($Ecole) ? print "$Ecole" : print "Ecole";?><br>
                                                        Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br>
                                                        Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br>
                                                        Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br>
                                                        Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br>
                                                        Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br>
                                                        Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br>
                                                        Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br>
                                                        Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br><br>
                                                    </p>
                                                    <button onclick="show_pay()" type="submit" class="select_profile" style="margin:auto;display:block">Choisir ce candidat</button><br>
                                                    <button type="button" class="select_profile" data-dismiss="modal" aria-label="Close" style="margin:auto;display:block">
                                                        Revenir à l'espace sélection
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- EOM -->
                                    <?php
                                    $nb++;
                                }
                                else {
                                    $box++;
                                    ?>
                                    <div class="select_box">
                                        <p style="position:absolute;font-size:14px;margin-top:28px;margin-left:20px">
                                            <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                                            <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                                            <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br>
                                            Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br>
                                            Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br>
                                            Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br>
                                            Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br>
                                            Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br>
                                            Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br>
                                            Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br>
                                            Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br>
                                            <button type="button" class="choose" id="myButtonPerso<?php echo $nb ?>"  data-toggle="modal" data-target="#myModal<?php echo $nb ?>" style="margin-left:25%;margin-top:80%">Choisir</button>
                                        </p>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal<?php echo $nb ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body" style="font-size:16px">
                                                    <img title="Photo_profile" src="../images/icon.png" style="position:relative;width:150px;margin-bottom:100px;height:150px;float:left"/>
                                                    <p style="font-size:14px;margin-bottom:5px;margin:auto">
                                                        <?php ($Utilisateur[0]) ? print "$Utilisateur[0] " : print "Nom ";?><br>
                                                        <?php ($Utilisateur[1]) ? print "$Utilisateur[1]" : print "Prenom";?><br>
                                                        <?php ($NiveauFormation) ? print "$NiveauFormation" : print "Formation";?><br>
                                                        <?php ($Ecole) ? print "$Ecole" : print "Ecole";?><br>
                                                        Audiovisuel:<?php ($Audiovisuel) ? print "$Audiovisuel " : print "Non renseigné";?><br>
                                                        Informatique:<?php ($Informatique) ? print "$Informatique " : print "Non renseigné";?><br>
                                                        Evenementiel:<?php ($Evenementiel) ? print "$Evenementiel " : print "Non renseigné";?><br>
                                                        Graphisme:<?php ($Graphisme) ? print "$Graphisme " : print "Non renseigné";?><br>
                                                        Marketing:<?php ($Marketing) ? print "$Marketing " : print "Non renseigné";?><br>
                                                        Droit:<?php ($Droit) ? print "$Droit " : print "Non renseigné";?><br>
                                                        Finance:<?php ($Finance) ? print "$Finance " : print "Non renseigné";?><br>
                                                        Communication:<?php ($Communication) ? print "$Communication " : print "Non renseigné";?><br><br>
                                                    </p>
                                                    <button onclick="show_pay()" type="submit" class="select_profile" style="margin:auto;display:block">Choisir ce candidat</button><br>
                                                    <button type="button" class="select_profile" data-dismiss="modal" aria-label="Close" style="margin:auto;display:block">
                                                        Revenir à l'espace sélection
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- EOM -->
                                    <?php
                                    $nb++;
                                }
                            }
                        }
                    }
                }
            }
        }
        ?>
        <?php
        while ($box <= 5) {
            if ($box == 5) {
                ?>
                <div class="select_box" style="margin-right:7.5%">
                    <p style="position:absolute;font-size:22px;margin-top:30px;margin-left:20px">
                        Vous recevrez d'autres profils bientôt !
                    </p>
                </div>
                <?php
            }
            else {
                ?>
                <div class="select_box">
                    <p style="position:absolute;font-size:22px;margin-top:30px;margin-left:20px">
                        Vous recevrez d'autres profils bientôt !
                    </p>
                </div>
                <?php
            }
            $box++;
        }
        ?>
        <div id="payzone" style="display:none;background-color:#F1F2F3;margin-top:30px">
            <form action="payment.php" method="POST" id="payment-form">
                <span class="payment-errors"></span>
                <p style="font-size:38px;color:#3CB5E8;margin-bottom:30px" align="center">Validation et paiement</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="credit-card-div">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-muted"> Montant à régler</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <?php $montant = $Amount / 100; ?>
                                                <input type="text" class="form-control" placeholder="<?php echo $montant ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h5 class="text-muted"> Credit Card Number</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" placeholder="4242 4242 4242 4242" data-stripe="number"/>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font"> Expiry Month</span>
                                                <input type="text" class="form-control" placeholder="MM" data-stripe="exp_month"/>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font">  Expiry Year</span>
                                                <input type="text" class="form-control" placeholder="YY" data-stripe="exp_year"/>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <span class="help-block text-muted small-font">  CCV</span>
                                                <input type="text" class="form-control" placeholder="CCV" data-stripe="cvc"/>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <img src="data:image/png;base64,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" class="img-rounded" />
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12 pad-adjust">
                                                <input type="text" class="form-control" placeholder="Propriétaire" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row ">
                                            <div align="center">
                                                <input type="hidden" name="name" value="<?php echo $Utilisateurpro[0] ?>">
                                                <input type="hidden" name="email" value="<?php echo $Emailpro ?>">
                                                <input type="hidden" name="amount" value="<?php echo $Amount ?>">
                                                <input type="hidden" name="idmission" value="<?php echo $id_miss ?>">
                                                <input type="hidden" name="idpromu" value="<?php echo $IdPromu ?>">
                                                <button type="submit" class="choose" >PAYER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CREDIT CARD DIV END -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $conn_select->close();
        ?>
    </main>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    Stripe.setPublishableKey('pk_live_Yp5B2dFtM3MjXj7GyubC33RW');
</script>

<script>
    $(function() {
        var $form = $('#payment-form');
        $form.submit(function(event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Stripe:
            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from being submitted:
            return false;
        });
    });
</script>
<script>
    function stripeResponseHandler(status, response) {
        // Grab the form:
        var $form = $('#payment-form');

        if (response.error) { // Problem!

            // Show the errors on the form:
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.submit').prop('disabled', false); // Re-enable submission

        } else { // Token was created!

            // Get the token ID:
            var token = response.id;

            // Insert the token ID into the form so it gets submitted to the server:
            $form.append($('<input type="hidden" name="stripeToken">').val(token));

            // Submit the form:
            $form.get(0).submit();
        }
    };
</script>

</body>
<?php require '../footer/footer.php'; ?>
</html>