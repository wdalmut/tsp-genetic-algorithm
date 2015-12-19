<?php
namespace Gen;

class Place
{
    public $name;
    public $point;

    public function __construct($name, Point $point)
    {
        $this->name = $name;
        $this->point = $point;
    }
}
