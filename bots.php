

<?php
// Lista de bots (puedes extenderla más adelante o leer desde una base de datos)
$bots = [
    ["nombre" => "d2ibot", "cfg" => "d2ibott.cfg", "exe" => "d2ibot.exe"],
    ["nombre" => "d2xbot", "cfg" => "d2xbott.cfg", "exe" => "d2xbot.exe"],
	["nombre" => "d2tbot", "cfg" => "d2tbott.cfg", "exe" => "d2tbot.exe"],
	["nombre" => "d2nbot", "cfg" => "d2nbott.cfg", "exe" => "d2nbot.exe"],
	["nombre" => "d2zbot", "cfg" => "d2zbott.cfg", "exe" => "d2zbot.exe"],
	["nombre" => "d2sbot", "cfg" => "d2sbott.cfg", "exe" => "d2sbot.exe"],
	["nombre" => "d2jbot", "cfg" => "d2jbott.cfg", "exe" => "d2jbot.exe"],
];

function estaBotActivo($exeName) {
    exec("tasklist", $output);
    foreach ($output as $line) {
        if (stripos($line, $exeName) !== false) {
            return true;
        }
    }
    return false;
}
?>
<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
      <meta charset="UTF-8">
    <title>🎮 Panel de Bots Warcraft 3</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #1f1c2c, #928dab);
            margin: 0;
            color: #fff;
        }
        h2, h3 {
            text-align: center;
            margin-top: 30px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: rgba(0,0,0,0.6);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #2c2f4a;
            font-size: 1.1em;
        }
        tr:nth-child(even) {
            background-color: rgba(255,255,255,0.05);
        }
        tr:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .btn {
            background-color: #00aaff;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #008fcc;
        }
        .on {
            color: #00ff90;
            font-weight: bold;
        }
        .off {
            color: #ff3b3b;
            font-weight: bold;
        }
        form.add-form {
            width: 60%;
            margin: 30px auto;
            background: rgba(0,0,0,0.6);
            padding: 20px;
            border-radius: 10px;
        }
        form.add-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #222;
            color: #fff;
        }
        form.add-form label {
            font-weight: bold;
        }
        .emoji {
            font-size: 1.2em;
            margin-right: 6px;
        }
    </style>
</head>
<body>
<?php
include("header.php");
?>

<table>
        <tr>
    <th>🤖 NOMBRE</th>
    <th>🛠️ CONFIGURACIÓN</th>
    <th>💬 DISCORD</th>
	<th>💻 PROCESO</th>
    <th>📡 ESTADO</th>
</tr>
<?php foreach ($bots as $bot): ?>
<tr>
    <td><?= htmlspecialchars($bot["nombre"]) ?></td>

    <!-- CONFIGURACIÓN -->
    <td>
        <form action="editar_config.php" method="get" target="_blank">
            <input type="hidden" name="archivo" value="<?= htmlspecialchars($bot["cfg"]) ?>">
            <button class="btn">📝 Abrir</button>
        </form>
    </td>

    <!-- DISCORD -->
    <td>
        <form action="editar_ini.php" method="get" style="display:inline;" target="_blank">
            <input type="hidden" name="archivo" value="<?= "C:/Servidores/bots/" . htmlspecialchars($bot["nombre"]) . ".ini" ?>">
            <button class="btn">📖 INI</button>
        </form>
        <form action="editar_py.php" method="get" style="display:inline;" target="_blank">
            <input type="hidden" name="archivo" value="<?= "C:/Servidores/bots/" . htmlspecialchars($bot["nombre"]) . ".py" ?>">
            <button class="btn">🐍 PY</button>
        </form>
    </td>
	

<!-- PROCESO -->
<td>
    <form method="post" action="control_bot.php" style="display:inline;">
        <input type="hidden" name="bot" value="<?= $bot['exe']; ?>">
        <input type="hidden" name="accion" value="iniciar">
        <button style="background: #28a745; color: white;">▶️ Iniciar</button>
    </form>
    <form method="post" action="control_bot.php" style="display:inline;">
        <input type="hidden" name="bot" value="<?= $bot['exe']; ?>">
        <input type="hidden" name="accion" value="detener">
        <button style="background: #dc3545; color: white;">⛔ Detener</button>
    </form>
</td>


    <!-- ESTADO -->
    <td class="<?= estaBotActivo($bot["exe"]) ? 'on' : 'off' ?>">
        <?= estaBotActivo($bot["exe"]) ? '🟢 ONLINE' : '🔴 OFFLINE' ?>
    </td>
</tr>
<?php endforeach; ?>

    </table>

</body>
</html>
