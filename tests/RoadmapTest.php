<?php
namespace Gen;

use PHPUnit_Framework_TestCase;

class RoadmapTest extends PHPUnit_Framework_TestCase
{
    public function testGetDistance()
    {
        $roadmap = new Roadmap([]);
        $roadmap->addPlace(new Place("Imperia", new Point(43.889686, 8.039517)));
        $roadmap->addPlace(new Place("Sanremo", new Point(43.815967, 7.776057)));
        $roadmap->addPlace(new Place("Ventimiglia", new Point(43.791237, 7.607586)));

        $this->assertEquals(36.45, $roadmap->distance(), "wrong distance", 0.01);
    }

    public function testGetLastPlace()
    {
        $roadmap = new Roadmap([]);
        $roadmap->addPlace(new Place("Imperia", new Point(43.889686, 8.039517)));
        $roadmap->addPlace(new Place("Sanremo", new Point(43.815967, 7.776057)));

        $last = new Place("Ventimiglia", new Point(43.791237, 7.607586));
        $roadmap->addPlace($last);

        $this->assertSame($last, $roadmap->getLastPlace());
    }

    public function testRemainingPlaces()
    {
        $one = new Place("Imperia", new Point(43.889686, 8.039517));
        $two = new Place("Sanremo", new Point(43.815967, 7.776057));
        $three = new Place("Ventimiglia", new Point(43.791237, 7.607586));
        $roadmap = new Roadmap([$one, $two, $three]);

        $this->assertContains($one, $roadmap->getRemainingPlaces());
        $roadmap->addPlace($one);
        $this->assertNotContains($one, $roadmap->getRemainingPlaces());
    }
}
