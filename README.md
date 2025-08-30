# Panel Bots (Warcraft III)

├── Bienvenido al *Panel Administrativo para Bots de Warcraft III*! 
Aqui podras controlar bots desde un panel web hecho en **PHP**, que interactua con scripts en **Python**.

---

##  Caracteristicas

├──  Interfaz web amigable en PHP  
├──  Scripts en Python para logica de bots  
├──  Administracion completa: agregar, editar, controlar  
├──  Monitoreo y control en tiempo real

---

##  Estructura del proyecto

Aqui tienes un vistazo general de los archivos principales:

├── agregar_bot.php - A?ade nuevos bots
├── s bots.php - Lista y gestiona bots existentes
├── control_bot.php - Controla el comportamiento del bot
├── editar_config.php - Modifica configuraciones PHP
├── editar_py.php - Modifica scripts en Python
├── monitor.php - Panel de monitoreo en tiempo real
├── ftp_manager.php - Gestion de archivos via FTP
├── parser.php - Procesa logs o archivos personalizados
├── config.php - Configuraci贸n general del panel
├── index.php - Pagina principal / dashboard
├── logout.php - Cierra sesion de usuario
├── bootstrap.min.css - Estilos responsivos con Bootstrap



---

##  Requisitos

- PHP (version recomendada: 7.4)  
- Python (version recomendada: 3.8)  
- Servidor web (Apache, Nginx u otro compatible con PHP)  
- Acceso FTP si vas a usar las herramientas de gestion de archivos

---

##  IMAGENES

![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_1.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_2.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_3.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_4.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_5.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_6.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_7.png)
![Descripci贸n de la imagen](https://github.com/Azzlaer/Panel_Bots/blob/main/Imagenes/Screenshot_8.png)

##  Instalacion & Uso

1. Clona este repositorio:
   git clone https://github.com/Azzlaer/Panel_Bots.git
   
Configura tu servidor web apuntando al directorio raiz del panel.

Edita config.php con tus credenciales y rutas segun tu entorno.

Asegurate de que editar_py.php tenga acceso y permisos para modificar los scripts Python.

Abre tu navegador y navega a http://tu-servidor/index.php.

Usa el panel para agregar bots, monitorizarlos, editar sus parametros y enviar comandos.

Como funciona 
Inicias sesion en el panel (index.php).

Desde ahi puedes agregar bots (agregar_bot.php) y editar su configuracion (editar_config.php).

El sistema guarda la configuracion y, si aplica, modifica algun script Python mediante editar_py.php.

Puedes controlar los bots con control_bot.php o supervisarlos en monitor.php.

Para manejo de archivos (mapas, cfg, etc.), usa ftp_manager.php, ftp_download.php, ftp_compress.php, etc.

El parser (parser.php) analiza logs u otros archivos para facilitar la gestion.

Contribuciones
Se aceptan contribuciones! Puedes:

Reportar errores en Issues

Hacer mejoras o aportar nuevas funcionalidades

Compartir tus ideas o feedback para enriquecer el panel