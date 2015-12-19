<?php
namespace Gen;

class Selection
{
    private $mutations;

    public function __construct($mutations = 4)
    {
        $this->mutations = $mutations;
    }

    public function getMutations()
    {
        return $this->mutations;
    }
/**
     * pay attention the population should be sorted 0 BETTER ->inf WORST
     *
     * [better 1, better 2, mid, ..., worst element]
     */
    public function select(array $population)
    {

        $solutions = [];
        for ($i=0; $i<$this->mutations && count($population); $i++) {
            $rand = $this->rand();
            $pos = (int)($rand*2*count($population));
            $solutions[] = $population[$pos];
            unset($population[$pos]);
            $population = array_values($population);
        }

        return $solutions;
    }

    // Generate a gaussian using twelve random number algorithm
    private function rand()
    {
        $randmax = 50;
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (rand(0, $randmax) / $randmax) - 0.5;
            $sum /= 2;
        }
        return abs($sum);
    }
}
