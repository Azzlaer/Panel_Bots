<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}
?>

<?php

// Configuración del servidor FTP
$ftp_server = "localhost";
$ftp_user   = "bots";
$ftp_pass   = "35027595";

// Conexión al servidor FTP
$ftp_conn = ftp_connect($ftp_server) or die("No se pudo conectar al servidor FTP");
$login    = ftp_login($ftp_conn, $ftp_user, $ftp_pass);

if (!$login) {
    die("Error de autenticación en el servidor FTP");
}

// Activar modo pasivo
ftp_pasv($ftp_conn, true);

// Determinar carpeta actual
$current_dir = isset($_GET['dir']) ? $_GET['dir'] : "/";
$current_dir = rtrim($current_dir, '/'); // quitar barra sobrante

// Obtener lista con detalles
$file_list = ftp_rawlist($ftp_conn, $current_dir);

// SUBIR ARCHIVO
if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $filename    = basename($_FILES['file']['name']);
    $target_file = ($current_dir === "" ? "/" : $current_dir) . "/" . $filename;

    if (ftp_put($ftp_conn, $target_file, $_FILES['file']['tmp_name'], FTP_BINARY)) {
        echo "<div class='alert alert-success'>Archivo subido correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al subir el archivo.</div>";
    }
}

// CREAR CARPETA
if (isset($_POST['create_folder']) && !empty($_POST['folder_name'])) {
    $folder_name = trim($_POST['folder_name'], '/');
    $new_folder  = ($current_dir === "" ? "/" : $current_dir) . "/" . $folder_name;

    if (ftp_mkdir($ftp_conn, $new_folder)) {
        echo "<div class='alert alert-success'>Carpeta creada correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al crear la carpeta.</div>";
    }
}

// ELIMINAR ARCHIVO O CARPETA
if (isset($_POST['delete_file'])) {
    $delete_path = $_POST['delete_file'];

    // Intentar eliminar como archivo
    if (@ftp_delete($ftp_conn, $delete_path)) {
        echo "<div class='alert alert-success'>Archivo eliminado.</div>";
    }
    // Si falla, intentar eliminar como carpeta
    elseif (@ftp_rmdir($ftp_conn, $delete_path)) {
        echo "<div class='alert alert-success'>Carpeta eliminada.</div>";
    }
    else {
        echo "<div class='alert alert-danger'>No se pudo eliminar.</div>";
    }
}

// Cerrar conexión FTP
ftp_close($ftp_conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Gestor FTP</title>
    <link href="bootstrap.min.css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
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
			color: white;
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
<body>
    <?php
include("header.php");
?>
    <div class="container mt-5">
        <h2>Gestor de Archivos FTP</h2>

        <p>Directorio actual: <strong><?= htmlspecialchars($current_dir ?: "/"); ?></strong></p>
        <!-- BOTÓN RAÍZ -->
        <a href="ftp_manager.php?dir=/" class="btn btn-primary">Ir a raíz</a>

        <!-- SUBIR ARCHIVO -->
        <form method="post" enctype="multipart/form-data" class="mt-3">
            <input type="file" name="file" required/>
            <button type="submit" name="upload" class="btn btn-primary">Subir Archivo</button>
        </form>

        <!-- CREAR CARPETA -->
        <form method="post" class="mt-3">
            <input type="text" name="folder_name" placeholder="Nombre de la carpeta" required/>
            <button type="submit" name="create_folder" class="btn btn-success">Crear Carpeta</button>
        </form>

        <!-- LISTADO DE ARCHIVOS -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($file_list)): ?>
                    <?php foreach ($file_list as $fileinfo):
                        // rawlist => "drwxrwxr-x 3 user group 4096 Apr 15 11:20 folder"
                        $parts     = preg_split('/\s+/', $fileinfo, 9);
                        $file_name = $parts[8] ?? '';
                        $is_dir    = (substr($parts[0], 0, 1) === 'd');

                        // Ruta completa FTP
                        $full_path_ftp = rtrim($current_dir, '/') . '/' . $file_name;
                        $full_path_ftp = ltrim($full_path_ftp, '/'); // Quitar / inicial

                        // Evitar doble slash
                        if ($full_path_ftp === "") {
                            $full_path_ftp = $file_name;
                        }
                        ?>
                        <tr>
                            <td>
                                <?php if ($is_dir): ?>
                                    <a href="ftp_manager.php?dir=<?= urlencode("/" . $full_path_ftp); ?>">
                                        📁 <?= htmlspecialchars($file_name); ?>
                                    </a>
                                <?php else: ?>
                                    <?= htmlspecialchars($file_name); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- BOTÓN ELIMINAR -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_file" value="<?= "/" . $full_path_ftp; ?>"/>
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>

                                <?php if (!$is_dir): ?>
                                    <!-- BOTÓN EDITAR -->
                                    <a href="ftp_edit.php?file=<?= urlencode("/" . $full_path_ftp); ?>"
                                       class="btn btn-warning btn-sm">Editar</a>

                                    <?php
                                    // Si es ZIP o RAR → Botón Descomprimir
                                    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                    if (in_array($ext, ['zip','rar'])):
                                    ?>
                                        <a href="ftp_compress.php?action=extract&file=<?= urlencode("/" . $full_path_ftp); ?>"
                                           class="btn btn-info btn-sm">Descomprimir</a>
                                    <?php endif; ?>

                                    <!-- BOTÓN COMPRIMIR -->
                                    <a href="ftp_compress.php?action=compress&file=<?= urlencode("/" . $full_path_ftp); ?>"
                                       class="btn btn-secondary btn-sm">Comprimir</a>
                                <?php endif; ?>
								<!-- BOTÓN DESCARGAR -->
									<a href="ftp_download.php?file=<?= urlencode($current_dir . '/' . $file_name); ?>"
										class="btn btn-primary btn-sm">Descargar</a>
								
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="2">No se encontraron archivos en este directorio.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
