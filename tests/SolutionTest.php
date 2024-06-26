<?php
include_once __DIR__ . '/../src/utils/functions.php';
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
    public function testPrintMessage() {
        // Capturamos la salida de la función
        ob_start();
        printMessage();
        $output = ob_get_clean();

        // Verificamos que la salida sea la esperada
        $this->assertEquals('Hello, World!', $output);
    }
}
?>
 