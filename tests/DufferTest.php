<?php
namespace App;


use PHPUnit\Framework\TestCase;


class DufferTest extends TestCase {


    public function testViewInstantiation() {
        // Create an instance of the View class
        $duffer = new Duffer('John');
        

        // Check if the instance is of the correct class
        // $this->assertInstanceOf('View', $view);

        $this->assertSame('John', $duffer->getName());
    }

    
}