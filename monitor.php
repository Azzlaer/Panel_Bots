<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>🎮 Monitoreo de Bots WC3</title>
<style>
body { font-family: Arial, sans-serif; background: #1e1e2f; color: #fff; text-align: center; margin: 0; }
h1 { background: #111; padding: 15px; color: #4cafef; }
h2 { margin-top: 30px; color: #ffda6b; }
table { width: 85%; margin: 15px auto; border-collapse: collapse; background: #2a2a3d; border-radius: 10px; overflow: hidden; }
th, td { padding: 10px; border-bottom: 1px solid #444; }
th { background: #333; color: #4cafef; }
tr:hover { background: #3c3c55; }
.radmin { color: #00ff9d; font-weight: bold; }
.internet { color: #ffa500; font-weight: bold; }
.no-players { color: #aaa; font-style: italic; }
</style>
</head>
<body>
<?php
include("header.php");
?>
<h1>📡 Monitoreo en tiempo real - Warcraft 3 Bots</h1>
<div id="tables"></div>

<script>
async function cargarDatos() {
    try {
        const res = await fetch("parser.php");
        const data = await res.json();

        let html = "";
        data.forEach(log => {
            html += `<h2>(Bot ${log.bot}) 🎮 ${log.title} </h2>`;
            if (log.players.length === 0) {
                html += `<p class="no-players">😴 No hay jugadores conectados</p>`;
            } else {
                html += `<table>
                            <tr>
                                <th>👤 Jugador</th>
                                <th>🌐 IP</th>
                                <th>🖧 Servidor</th>
                            </tr>`;
                log.players.forEach(p => {
                    html += `<tr>
                                <td>${p.name}</td>
                                <td>${p.ip}</td>
                                <td class="${p.server.toLowerCase()}">${p.server}</td>
                             </tr>`;
                });
                html += `</table>`;
            }
        });

        document.getElementById("tables").innerHTML = html;
    } catch (e) {
        document.getElementById("tables").innerHTML = `<p style="color:red">⚠️ Error cargando datos: ${e}</p>`;
    }
}

// Actualiza cada 3 segundos
setInterval(cargarDatos, 3000);
cargarDatos();
</script>

</body>
</html>
