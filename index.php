<?php
// login.php
session_start();

require_once 'config.php';

// Mostrar errores de PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';

    if ($usuario === USUARIO && $clave === CLAVE) {
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: bots.php");
        exit();
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🔐 Login</title>
    <style>
        body {
            background: #111;
            color: #fff;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px #00ffcc44;
        }
        input, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #00cc88;
            color: white;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>🔐 Iniciar Sesión</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>
</div>
</body>
</html>
