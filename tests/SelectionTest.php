<?php
namespace Gen;

class SelectionTest extends \PHPUnit_Framework_TestCase
{
    public function testSubselect()
    {
        $selection = new Selection(4);
        $result = $selection->select([1,2,3,4,5,6]);

        $this->assertCount(4, $result);
    }
}
