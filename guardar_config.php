<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>
<?php
if (!isset($_POST['archivo']) || !isset($_POST['contenido'])) {
    die("Datos faltantes.");
}

$archivo = basename($_POST['archivo']);
$ruta = "C:/Servidores/ghost-turbo/$archivo";

file_put_contents($ruta, $_POST['contenido']);
echo "Archivo guardado correctamente. <a href='index.php'>Volver al panel</a>";
