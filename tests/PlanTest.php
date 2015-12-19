<?php
namespace Gen;

use PHPUnit_Framework_TestCase;

class PlanTest extends PHPUnit_Framework_TestCase
{
    public function testAddPlaces()
    {
        $plan = new Plan();
        $plan->addPlace(new Place("Imperia", new Point(43.889686, 8.039517)));

        $this->assertCount(1, $plan->places);
    }
}
