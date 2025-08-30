<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ERROR | E_PARSE); // suprime warnings/notices

$config = include("config.php");
$linesConfig = $config['lines_config'] ?? ['default'=>50,'min'=>10,'max'=>200];
$linesToRead = $linesConfig['default'];

// Función para leer últimas N líneas
function tailFile($file, $lines = 50) {
    $lines = max(1, (int)$lines);
    $f = @fopen($file, 'rb');
    if (!$f) return [];
    $buffer = '';
    $chunkSize = 4096;
    fseek($f, 0, SEEK_END);
    $pos = ftell($f);
    $lineCount = 0;

    while ($pos > 0 && $lineCount <= $lines) {
        $readSize = ($pos - $chunkSize > 0) ? $chunkSize : $pos;
        $pos -= $readSize;
        fseek($f, $pos);
        $chunk = fread($f, $readSize);
        $buffer = $chunk . $buffer;
        $lineCount = substr_count($buffer, "\n");
    }

    $allLines = explode("\n", $buffer);
    return array_slice($allLines, -$lines);
}

$result = [];
foreach ($config['tables'] as $i => $table) {
    $logFile = $table['log'];
    $players = [];
    if (file_exists($logFile)) {
        $lines = tailFile($logFile, $linesToRead);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;

            if (preg_match('/player \[([^\|\]]+)\|([0-9\.]+)\] joined the game/i', $line, $m)) {
                $name = $m[1];
                $ip = $m[2];
                $server = (strpos($ip, "26.") === 0) ? "RADMIN" : "Internet";
                $players[$name] = ['name'=>$name,'ip'=>$ip,'server'=>$server];
            }

            if (preg_match('/deleting player \[([^\|\]]+)\]/i', $line, $m)) {
                $name = $m[1];
                unset($players[$name]);
            }
        }
    }

    $result[] = [
        'title' => $table['title'],
        'bot'   => $i+1,
        'players' => array_values($players)
    ];
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
