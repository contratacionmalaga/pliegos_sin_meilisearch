<?php
// Configura tus datos de conexión
$host = '172.26.3.217';
$db = 'laravel_pliegos';
$user = 'root';
$pass = 'Malaga$1234';
$charset = 'utf8mb4';

// Verificar que se haya pasado el nombre de la tabla como argumento
if ($argc < 2) {
    die("Uso: php exportar.php <nombre_tabla>\n");
}

$tabla = $argv[1];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false, // importante para grandes volúmenes
];

// Aumenta límite de memoria (por si acaso)
ini_set('memory_limit', '1G');

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $stmt = $pdo->query("SELECT * FROM `$tabla`");

    $batchSize = 50000;
    $count = 0;
    $fileIndex = 1;
    $rowInFile = 0;

    $filename = "{$tabla}_{$fileIndex}.json";
    $file = fopen($filename, 'w');
    fwrite($file, "[\n"); // abrir array JSON

    while ($row = $stmt->fetch()) {
        $jsonRow = json_encode($row, JSON_UNESCAPED_UNICODE);

        // Si no es la primera fila del archivo, escribe una coma antes
        if ($rowInFile > 0) {
            fwrite($file, ",\n");
        }

        fwrite($file, $jsonRow);

        $count++;
        $rowInFile++;

        // Si llegamos al límite de 50k, cerramos el array y el archivo
        if ($rowInFile === $batchSize) {
            fwrite($file, "\n]\n");
            fclose($file);
            echo "Archivo '{$filename}' generado con $batchSize filas.\n";

            // Nuevo archivo
            $fileIndex++;
            $filename = "{$tabla}_{$fileIndex}.json";
            $file = fopen($filename, 'w');
            fwrite($file, "[\n");

            $rowInFile = 0;
        }
    }

    // Cierra el último archivo si tiene filas
    if ($rowInFile > 0) {
        fwrite($file, "\n]\n");
        fclose($file);
        echo "Archivo '{$filename}' generado (último fragmento con $rowInFile filas).\n";
    }

    echo "Exportación completa: {$count} filas en total.\n";

} catch (PDOException $e) {
    echo "Error de conexión o consulta: " . $e->getMessage() . "\n";
}