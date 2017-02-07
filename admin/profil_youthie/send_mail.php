<?php session_start();

$destinataire = $_POST['Email'];
$IdMiss = $_POST['IdMiss'];
$expediteur = 'info@youthie.fr';
$objet = 'Des étudiants ont été trouvés pour votre mission'; // Objet du message
$headers = "From: info@youthie.io";
$message = 'Bonjour,


Suite au depot de votre mission sur Youthie.io, nous avons le plaisir de vous annoncer que les profils selectionnes sont dorenavant disponibles et selectionnables depuis votre espace entreprise.
Nous demeurons disponible si necessaire pour vous aider dans le cadre de votre choix final.

Cordialement,

L’equipe Youthie';
if(mail($destinataire, $objet, $message, $headers, '-f info@youthie.io')) {
//$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
    $_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
    if($_conn->connect_error) {
        die("Connection failed : " . $_conn->connect_error);
    }
    $up_mail = "UPDATE youthie_mission SET Email_sent = '1' WHERE id = '$IdMiss'";

    if(mysqli_query($_conn, $up_mail)) {
        echo 'ok';
    } else {
        echo "error updating record : " . mysqli_error($_conn);
    }
    $_conn->close();
} else {
    echo "Mail non envoyé";
} ?>