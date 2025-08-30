<?php
// config.php

define('USUARIO', 'Azzlaer');
define('CLAVE', '35027595');


// Configuración de títulos y rutas de logs
return [
    'tables' => [
                [
            'title' => 'Orc Gladiators Revenge 1.39fa',
            'log'   => 'C:\Servidores\logs\d2ibot.log'
        ],
        [
            'title' => 'Bleach vs One Piece',
            'log'   => 'C:\Servidores\logs\d2jbot.log'
        ],
        [
            'title' => 'DBZ Tribute LuNaTic v60j ESP',
            'log'   => 'C:\Servidores\logs\d2nbot.log'
        ],
        [
            'title' => 'Canned Bread',
            'log'   => 'C:\Servidores\logs\d2sbot.log'
        ],
        [
            'title' => 'hvsa X3 v4.42-Hotfix',
            'log'   => 'C:\Servidores\logs\d2tbot.log'
        ],
        [
            'title' => 'Pudge Wars v2.03df edition d2',
            'log'   => 'C:\Servidores\logs\d2xbot.log'
        ],
		[
            'title' => '52009_FOCS_Another_10.0_A06_ES',
            'log'   => 'C:\Servidores\logs\d2zbot.log'
        ],
		[
            'title' => 'Eve Of The Apocalypse',
            'log'   => 'C:\Servidores\logs\ssjuegos.log'
        ],


		
    ],   // <- **FALTA COMA AQUÍ**
    
    // Configuración de lectura de líneas
    'lines_config' => [
        'default' => 50,  // Cantidad por defecto si no se especifica otra
        'min'     => 10,  // Mínimo de líneas
        'max'     => 200  // Máximo de líneas
    ]
];

