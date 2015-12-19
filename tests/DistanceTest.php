<?php
namespace Gen;

use PHPUnit_Framework_TestCase;

class DistanceTest extends PHPUnit_Framework_TestCase
{
    public function testDist()
    {
        $distance = Distance::between(new Point(43.889686, 8.039517), new Point(43.815967, 7.776057));

        $this->assertEquals(22.65, $distance, "wrong distance", 0.01);
    }
}
