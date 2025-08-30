# 🛠 Panel Bots (Warcraft III)

¡Bienvenido al *Panel Administrativo para Bots de Warcraft III*! Aquí podrás controlar bots desde un panel web hecho en **PHP**, que interactúa con scripts en **Python**.

---

##  Características

- 🖥 Interfaz web amigable en PHP  
- 🐍 Scripts en Python para lógica de bots  
- 🔧 Administración completa: agregar, editar, controlar  
- 📊 Monitoreo y control en tiempo real

---

##  Estructura del proyecto

Aquí tienes un vistazo general de los archivos principales:

├── agregar_bot.php - Añade nuevos bots
├── bots.php - Lista y gestiona bots existentes
├── control_bot.php - Controla el comportamiento del bot
├── editar_config.php - Modifica configuraciones PHP
├── editar_py.php - Modifica scripts en Python
├── monitor.php - Panel de monitoreo en tiempo real
├── ftp_manager.php - Gestión de archivos vía FTP
├── parser.php - Procesa logs o archivos personalizados
├── config.php - Configuración general del panel
├── index.php - Página principal / dashboard
├── logout.php - Cierra sesión de usuario
└── bootstrap.min.css - Estilos responsivos con Bootstrap



---

##  Requisitos

- PHP (versión recomendada: ≥ 7.4)  
- Python (versión recomendada: ≥ 3.8)  
- Servidor web (Apache, Nginx u otro compatible con PHP)  
- Acceso FTP si vas a usar las herramientas de gestión de archivos

---

##  IMAGENES

![Descripción de la imagen](./imagenes/Screenshot_1.png)
![Descripción de la imagen](./imagenes/Screenshot_2.png)
![Descripción de la imagen](./imagenes/Screenshot_3.png)
![Descripción de la imagen](./imagenes/Screenshot_4.png)
![Descripción de la imagen](./imagenes/Screenshot_5.png)
![Descripción de la imagen](./imagenes/Screenshot_6.png)
![Descripción de la imagen](./imagenes/Screenshot_7.png)
![Descripción de la imagen](./imagenes/Screenshot_8.png)

##  Instalación & Uso

1. Clona este repositorio:
   git clone https://github.com/Azzlaer/Panel_Bots.git
   
Configura tu servidor web apuntando al directorio raíz del panel.

Edita config.php con tus credenciales y rutas según tu entorno.

Asegúrate de que editar_py.php tenga acceso y permisos para modificar los scripts Python.

Abre tu navegador y navega a http://tu-servidor/index.php.

Usa el panel para agregar bots, monitorizarlos, editar sus parámetros y enviar comandos.

Cómo funciona (flujo típico)
Inicias sesión en el panel (index.php).

Desde ahí puedes agregar bots (agregar_bot.php) y editar su configuración (editar_config.php).

El sistema guarda la configuración y, si aplica, modifica algún script Python mediante editar_py.php.

Puedes controlar los bots con control_bot.php o supervisarlos en monitor.php.

Para manejo de archivos (mapas, cfg, etc.), usa ftp_manager.php, ftp_download.php, ftp_compress.php, etc.

El parser (parser.php) analiza logs u otros archivos para facilitar la gestión.

Contribuciones
¡Se aceptan contribuciones! Puedes:

Reportar errores en Issues

Hacer mejoras o aportar nuevas funcionalidades

Compartir tus ideas o feedback para enriquecer el panel