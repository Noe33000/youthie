<?php
$IdPromu = $_POST['idpromu'];
$id_mission = $_POST['idmission'];
$token = $_POST['stripeToken'];
$name = $_POST['name'];
$email = $_POST['email'];
$amount = $_POST['amount'];

require_once('../stripe-php/init.php');
\Stripe\Stripe::setApiKey("sk_live_Ld9H7yhQMMNnPE5Hp4NJDYpY");



// Create a charge: this will charge the user's card
try {
    $charge = \Stripe\Charge::create(array(
        "amount" =>$amount,
        "currency" => "eur",
        "source" => $token,
        "description" => $name
    ));
} catch(\Stripe\Error\Card $e) {
    // The card has been declined
}

//$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
if($_conn->connect_error) {
    die("Connection failed : " . $_conn->connect_error);
}
$set_mission = "UPDATE youthie_mission SET EtapeMission = '1', IdPromu ='$IdPromu' WHERE id ='$id_mission'";
$rem_choo = "DELETE FROM mission_choisi WHERE id_mission ='$id_mission'";
$rem_post = "DELETE FROM mission_postulant WHERE id_mission ='$id_mission'";
mysqli_query($_conn, $rem_choo);
mysqli_query($_conn, $rem_post);
if(mysqli_query($_conn, $set_mission)) {
    ;
} else {
    echo "error updating record : " . mysqli_error($_conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Youthie : Faire d'une mission un succès</title>
    <link rel="icon" type="image/png" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/mode.js"></script>
</head>
<body>
<!-- GNU General Public License, version 3 (GPL-3.0) -->
<div class="wrapper">

    <a href="../menumob/"><div class="nav-toggle"></div></a>

    <?php require '../navbar/navbar.php'; ?>
<?php
$get_miss = "SELECT * from youthie_mission WHERE id ='$id_mission'";
$result_mission = $_conn->query($get_miss);
if($result_mission->num_rows > 0) {
    while ($row_mission = $result_mission->fetch_assoc()) {
        $name_mission = $row_mission['Titre'];
        $debut_mission = $row_mission['DatedeDebut'];
        $fin_mission = $row_mission['DatedeFin'];
        $lieu_mission = $row_mission['LieuMission'];
        $budget = $amount / 100;
    }
}
$get_stu = "SELECT * from youthie_etudiants WHERE id ='$IdPromu'";
$result_stu = $_conn->query($get_stu);
if($result_stu->num_rows > 0) {
    while ($row_stu = $result_stu->fetch_assoc()) {
        $_Utilisateur = base64_decode($row_stu['Utilisateur']);
        $Utilisateur = explode(" ", $_Utilisateur);
    }
}
$_conn->close();
?>
<div style="background-color:#A8E2F9"><br><br>
    <section class="main_section">
        <div class="container">
            <br>
            <p style="font-size:38px;color:#3CB5E8" align="center">Récapitulatif</p><br><br>
            <p style="float:left;font-size:20px;margin-left:10%">Mission validée <?php echo $name_mission ?><br><br>
            Durée de la mission Du <?php echo ' '; echo  $debut_mission ?> Au <?php echo ' '; echo $fin_mission ?><br><br>
            Lieu <?php echo $lieu_mission ?><br><br>
            Etudiant <?php echo $Utilisateur[0]; echo ' '; echo $Utilisateur[1] ?><br><br>
            Budget <?php echo $budget  ?> €</p><br><br>
        </div>
    </section><br><br>
</div>

    <footer>
        <div style="text-align:center;color:#fff;">
            <div style="text-align:right;margin-right:40px;">
                <ul id="footer_menu">
                    <li><a href="../cgu/">CGU</a></li>
                    <li><a href="#">Nous connaître</a></li>
                    <li><a href="../inscriptioncx/">S'inscrire</a></li>
                </ul>
            </div>
            <h1 style="color:white">Youthie</h1>
            <h3 style="color:white">Faire d'une mission un succès</h3>
            <a href="https://www.facebook.com/helloyouthie/">
                <img title="Facebook" src="../images/facebook.png" />
            </a>
            <a href="https://twitter.com/helloyouthie">
                <img title="Twitter" src="../images/twitter.png" />
            </a>
            <a href="#">
                <img title="Linkdin" src="../images/linkdin.png" />
            </a>
            <a href="#">
                <img title="Viadeo" src="../images/viadeo.png" />
            </a>
            <p style="color:#1A1A1A;">© 2016 Youthie.io, tous droits réservés</p>
        </div>
    </footer>

</div>



