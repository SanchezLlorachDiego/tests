<?php
if ($argc != 3) {
    echo "Usage: php tokenScript.php <user_name> <activity_name>\n";
    exit(1);
}

$user_name = $argv[1];
$activity_name = $argv[2];
$specific_word = 'DWES3SFACIL';
$date = date('Y-m-d H:i:s');

// Ejecutar los tests y guardar el resultado en un archivo XML
exec('vendor/bin/phpunit --configuration ./phpunit.xml --log-junit test-results.xml', $output, $return_var);

if ($return_var !== 0) {
    echo "Tests failed. Exiting.\n";

    foreach ($output as $line) {
        echo $line . "\n";
    }
    exit(1);
}

// Generar un token único basado en los inputs
$token = hash('sha256', $user_name . $activity_name . $specific_word . $date);


// Cargar el archivo XML de resultados de los tests
$xml = simplexml_load_file('test-results.xml');
if ($xml === false) {
    echo "Failed to load test results XML.\n";
    exit(1);
}

// Añadir la información adicional al XML
$info = $xml->addChild('additionalInfo');
$info->addChild('userName', $user_name);
$info->addChild('activityName', $activity_name);
$info->addChild('token', $token);
$info->addChild('createdAt', $date);

// Guardar el archivo XML modificado
$xml->asXML('test-results.xml');

echo "Test results and additional info written to test-results.xml\n";



