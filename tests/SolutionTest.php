<?php
include_once __DIR__ . '/../src/utils/functions.php';
use PHPUnit\Framework\TestCase;

class SolutionTest extends TestCase
{
 public function testSuma() {

     $numero = 5;
     $numero2 = 10;

     $this->assertEquals(15, suma($numero, $numero2));
  
 }

}
?>
 
