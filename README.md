# Panel_Bots

Administración en panel para bots de Warcraft 3 mediante PHP y Python.

## Descripción

Este proyecto (`Panel_Bots`) ofrece un **panel administrativo** para gestionar bots de Warcraft 3, construido combinando **PHP** y **Python**. La interfaz permite realizar las acciones clave necesarias para el control de bots de forma eficiente.

## Estructura del repositorio

```
Panel_Bots/
├── Imagenes/
│   ├── ejemplo1.png
│   └── ejemplo2.png
├── src/
│   ├── index.php
│   └── bot_controller.py
├── README.md
└── (otros archivos...)
```

- `Imagenes/`: contiene imágenes referenciadas en esta documentación (por ejemplo, capturas de pantalla del panel).
- `src/`: código fuente en PHP y Python.
- `README.md`: este archivo.

## Visualización de imágenes en el README

Para que las imágenes se muestren correctamente, utiliza rutas relativas con la sintaxis Markdown:

```markdown
![Descripción alternativa](Imagenes/ejemplo1.png)
```

Ejemplo:

```markdown
![Pantalla principal del panel](Imagenes/pantalla_principal.png)
```

Asegúrate de que el nombre del archivo y la extensión coincidan exactamente y que la carpeta `Imagenes` esté al mismo nivel que el `README.md`.

## Instalación y configuración

1. Clona el repositorio:

    ```bash
    git clone https://github.com/Azzlaer/Panel_Bots.git
    cd Panel_Bots
    ```

2. Instala las dependencias (ajustar según el proyecto):

    ```bash
    # PHP (por ejemplo, usando Composer)
    composer install

    # Python
    pip install -r requirements.txt
    ```

3. Configura la conexión al bot y ajustes necesarios (indica aquí si hay un archivo `.env`, configuración en `config.php`, etc.).

4. Inicia el panel:

    ```bash
    # Ejemplo de PHP
    php -S localhost:8000 -t src/
    
    # O un comando específico para tu entorno
    ```

Luego accede a `http://localhost:8000` en tu navegador.

## Uso

Describe aquí cómo usar el panel: iniciar sesión, crear bots, ver estado, comandos disponibles, etc.

## Contribuciones

¡Las contribuciones son bienvenidas! Para ayudar:

1. Haz un fork.
2. Crea una rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza los cambios y haz commits descriptivos.
4. Envía un Pull Request.

## Licencia

Indica aquí bajo qué licencia se distribuye el proyecto (MIT, Apache, GPL…).

---

## Capturas del panel

![Pantalla principal](Imagenes/pantalla_principal.png)

El panel muestra el estado de los bots, estadísticas en tiempo real y opciones de control.

![Configuración del bot](Imagenes/config_bot.png)

Aquí puedes configurar parámetros como el token, comandos, etc.
