<?php
session_start();

$IdStud = $_POST['IdStud'];
$IdMiss = $_POST['IdMiss'];

$_conn = new mysqli("localhost","root", "", "arkamitcjfefedb3");
//$_conn = new mysqli('arkamitcjfefedb3.mysql.db', 'arkamitcjfefedb3', 'C6c6f7946fdc', 'arkamitcjfefedb3');
if($_conn->connect_error) {
    die("Connection failed : " . $_conn->connect_error);
}
$set_choisi = "INSERT INTO mission_choisi(id_mission, id_etudiant) VALUES ('$IdMiss', '$IdStud')";

if(mysqli_query($_conn, $set_choisi)) {
    echo '<br><div style="text-align:center">Demande correctement envoyée</div><br>';
    echo '<meta http-equiv="refresh" content="2; url=../profil_youthie/">';
} else {
    echo "error updating record : " . mysqli_error($_conn);
}
$_conn->close();
?>