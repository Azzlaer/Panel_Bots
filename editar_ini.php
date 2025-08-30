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
 a.logout {
        background: #ff4444;
        color: white !important;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        margin-left: 10px;
    }

    a.logout:hover {
        background: #ff2222;
    }		
    </style>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>
	
<?php
$archivo = $_GET['archivo'] ?? '';
if ($archivo && file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
} else {
    $contenido = '';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents($archivo, $_POST['contenido']);
    header("Location: editar_ini.php?archivo=" . urlencode($archivo));
    exit;
}
?>
<form method="post">
    <h3>Editando archivo INI: <?= htmlspecialchars($archivo) ?></h3>
    <textarea name="contenido" rows="25" cols="100"><?= htmlspecialchars($contenido) ?></textarea><br>
    <button type="submit">Guardar</button>
</form>
