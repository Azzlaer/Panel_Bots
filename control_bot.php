<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.php");
    exit;
}

$bot = $_POST['bot'] ?? '';
$accion = $_POST['accion'] ?? '';

$botPath = "C:/Servidores/wc3bots/" . basename($bot); // Seguridad extra

if ($accion === 'iniciar') {
    // Iniciar el bot
    pclose(popen("start /B \"$botPath\"", "r"));
    echo "Bot $bot iniciado.";
} elseif ($accion === 'detener') {
    // Detener el bot
    exec("taskkill /F /IM $bot");
    echo "Bot $bot detenido.";
} else {
    echo "Acción no válida.";
}
echo '<br><a href="bots.php">Volver</a>';
