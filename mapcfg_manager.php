<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

$mapcfgDir = "C:/Servidores/wc3bots/mapcfgs";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["archivo"], $_POST["contenido"])) {
    $archivo = basename($_POST["archivo"]); // evitar path traversal
    $rutaCompleta = $mapcfgDir . DIRECTORY_SEPARATOR . $archivo;
    file_put_contents($rutaCompleta, $_POST["contenido"]);
    $mensaje = "✅ Archivo '$archivo' guardado correctamente.";
}

$archivos = glob($mapcfgDir . "/*.cfg");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>🗺️ Editor de MAPCFG</title>
    <style>
        body {
            background: #1f1f1f;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .file-box {
            background: #2c2c2c;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        textarea {
            width: 100%;
            height: 300px;
            background: #111;
            color: #0f0;
            border: 1px solid #444;
            border-radius: 6px;
            padding: 10px;
            font-family: monospace;
        }
        button {
            background: #00aaff;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #008fcc;
        }
        .success {
            background: #2e7d32;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
include("header.php");
?>

<?php if (isset($mensaje)): ?>
<div class="success"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<?php foreach ($archivos as $archivo): 
    $nombreArchivo = basename($archivo);
    $contenido = file_get_contents($archivo);
?>
<div class="file-box">
    <h3><?= htmlspecialchars($nombreArchivo) ?></h3>
    <form method="post">
        <input type="hidden" name="archivo" value="<?= htmlspecialchars($nombreArchivo) ?>">
        <textarea name="contenido"><?= htmlspecialchars($contenido) ?></textarea>
        <button type="submit">💾 Guardar</button>
    </form>
</div>
<?php endforeach; ?>

</body>
</html>
