<?php
namespace Gen;

class Roadmap
{
    public $places;
    private $remainingPlaces;

    public function __construct(array $remainingPlaces)
    {
        $this->places = [];
        $this->remainingPlaces = $remainingPlaces;
    }

    public function addPlace(Place $place)
    {
        $this->places[] = $place;
        $this->dropFromremainingPlaces($place);
    }

    private function dropFromremainingPlaces(Place $place)
    {
        foreach ($this->remainingPlaces as $i => $city) {
            if ($place->name == $city->name) {
                unset($this->remainingPlaces[$i]);
            }
        }
        $this->remainingPlaces = array_values($this->remainingPlaces);
    }

    public function distance()
    {
        $distance = 0;

        for ($i=0; $i<count($this->places)-1; $i++) {
            $distance += Distance::between($this->places[$i]->point, $this->places[$i+1]->point);
        }

        return $distance;
    }

    public function getRemainingPlaces()
    {
        return $this->remainingPlaces;
    }

    public function getLastPlace()
    {
        return $this->places[count($this->places)-1];
    }
}
