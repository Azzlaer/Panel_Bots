<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<?php
if (!isset($_GET['archivo'])) {
    die("Archivo no especificado.");
}

$archivo = basename($_GET['archivo']); // Seguridad
$ruta = "C:/Servidores/wc3bots/$archivo";

if (!file_exists($ruta)) {
    die("El archivo no existe: $ruta");
}

$contenido = file($ruta);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar <?= htmlspecialchars($archivo) ?></title>
    <style>
        body { background: #111; color: #eee; font-family: monospace; }
        textarea { width: 100%; height: 600px; background: #222; color: #eee; border: none; padding: 10px; }
        button { padding: 10px 20px; background: #555; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Editando <?= htmlspecialchars($archivo) ?></h2>
    <form method="post" action="guardar_config.php">
        <input type="hidden" name="archivo" value="<?= htmlspecialchars($archivo) ?>">
        <textarea name="contenido"><?= htmlspecialchars(implode("", $contenido)) ?></textarea><br>
        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>
