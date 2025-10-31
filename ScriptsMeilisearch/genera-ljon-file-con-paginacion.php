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
$filename = "{$tabla}.json";

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

    // Consulta a la tabla indicada
    $stmt = $pdo->query("SELECT * FROM `$tabla`");

    // Crear el archivo de salida
    $file = fopen($filename, 'w');

    while ($row = $stmt->fetch()) {
        fwrite($file, json_encode($row, JSON_UNESCAPED_UNICODE) . "\n");
    }

    fclose($file);
    echo "Archivo '$filename' generado exitosamente.\n";

} catch (\PDOException $e) {
    echo "Error de conexión o consulta: " . $e->getMessage() . "\n";
}
