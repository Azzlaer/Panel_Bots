<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>
<?php
$archivo = $_GET['archivo'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contenido'])) {
    file_put_contents($archivo, $_POST['contenido']);
    echo "<p style='color: lime;'>✅ Archivo guardado correctamente.</p>";
}

$contenido = file_exists($archivo) ? file_get_contents($archivo) : "No se encontró el archivo.";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar PY</title>
    <style>
        body {
            font-family: monospace;
            background: #1e1e1e;
            color: #f0f0f0;
            padding: 20px;
        }
        textarea {
            width: 100%;
            height: 600px;
            background: #2e2e2e;
            color: #00ff88;
            border: 1px solid #444;
            padding: 10px;
            font-family: monospace;
            font-size: 14px;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<h2>🐍 Editando archivo PY:</h2>
<p><?= htmlspecialchars($archivo) ?></p>

<form method="post">
    <textarea name="contenido"><?= htmlspecialchars($contenido) ?></textarea><br>
    <button type="submit">💾 Guardar</button>
</form>

</body>
</html>
