<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<div style="background: #111; color: white; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
    <div style="font-weight: bold;">
        🎮 Panel Bots - 👤 <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
    </div>
    <div>
        <a href="bots.php" style="color: #90ee90; margin-right: 20px; text-decoration: none; font-weight: bold;">🤖 Bots</a>
		<a href="monitor.php" style="color: #90ee90; margin-right: 20px; text-decoration: none; font-weight: bold;">🖥 Monitor</a>
        <a href="ftp_manager.php" style="color: #00aaff; margin-right: 20px; text-decoration: none; font-weight: bold;">📁 FTP Manager</a>
        <a href="mapcfg_manager.php" style="color: #ffc107; margin-right: 20px; text-decoration: none; font-weight: bold;">🗺️ MAPCFG</a>
        <a href="logout.php" style="color: #ff6666; text-decoration: none; font-weight: bold;">🔓 Cerrar sesión</a>
    </div>
</div>
