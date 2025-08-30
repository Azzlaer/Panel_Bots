<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<?php
$archivoBots = 'bots.json';

$botNuevo = [
    "nombre" => $_POST["nombre"],
    "cfg" => $_POST["cfg"],
    "exe" => $_POST["exe"]
];

$bots = [];
if (file_exists($archivoBots)) {
    $bots = json_decode(file_get_contents($archivoBots), true);
}
$bots[] = $botNuevo;
file_put_contents($archivoBots, json_encode($bots, JSON_PRETTY_PRINT));

header("Location: bots.php");
exit;

