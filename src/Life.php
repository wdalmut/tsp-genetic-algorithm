<?php
namespace Gen;

class Life
{
    public $selection;

    public function __construct(Selection $selection = null)
    {
        $this->selection = ($selection === null) ? new Selection(4) : $selection;
    }

    public function getShortestPath(Plan $plan)
    {
        $mutation = $this->selection->getMutations();

        $places = $plan->getPlaces();
        $from = array_shift($places);

        $roadmap = new Roadmap($places);
        $roadmap->addPlace($from);

        $roadmaps = $this->sortRoadmaps($this->explodeRoadmaps([$roadmap]));

        return $roadmaps[0];
    }

    private function explodeRoadmaps(array $roadmaps)
    {
        while (count($roadmaps[0]->getRemainingPlaces()) > 0) {
            $newRoadmaps = [];
            foreach ($roadmaps as $roadmap) {
                $newRoadmaps = array_merge($newRoadmaps, $this->createRoadmaps($roadmap));
            }
            $this->sortRoadmaps($newRoadmaps);

            $newRoadmaps = $this->selection->select($newRoadmaps);

            $roadmaps = $this->explodeRoadmaps($newRoadmaps);
        }

        return $roadmaps;
    }

    private function sortRoadmaps($roadmaps)
    {
        usort($roadmaps, function($a, $b) { return $a->distance() <=> $b->distance(); });
        return $roadmaps;
    }

    private function createRoadmaps(Roadmap $roadmap)
    {
        $places = $roadmap->getRemainingPlaces();
        $from = $roadmap->getLastPlace();

        $selections = [];
        foreach ($places as $selection) {
            $selections[] = [
                "distance" => Distance::between($from->point, $selection->point),
                "place" => $selection,
            ];
        }

        usort($selections, function($a, $b) {return $a["distance"] <=> $b["distance"];});
        $selections = $this->selection->select($selections);

        $roadmaps = [];
        foreach ($selections as $i => $selection) {
            $currentRoadmap = $roadmap;
            if ($i != count($selections)-1) {
                $currentRoadmap = clone $roadmap;
            }

            $currentRoadmap->addPlace($selection["place"]);
            $roadmaps[] = $currentRoadmap;
        }

        return $roadmaps;
    }
}
