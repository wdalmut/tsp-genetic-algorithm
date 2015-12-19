<?php
namespace Gen;

class Plan
{
    public $places;

    public function __construct()
    {
        $this->places = [];
    }

    public function addPlace(Place $place)
    {
        $this->places[] = $place;
    }

    public function getPlaces()
    {
        return $this->places;
    }
}

