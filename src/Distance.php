<?php
namespace Gen;

class Distance
{
    public static function between(Point $p1, Point $p2)
    {
        if ($p1->latitude == $p2->latitude && $p1->longitude == $p2->longitude) return 0;

        $theta = $p1->longitude - $p2->longitude;
        $dist = sin(deg2rad($p1->latitude)) * sin(deg2rad($p2->latitude)) +  cos(deg2rad($p1->latitude)) * cos(deg2rad($p2->latitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        return $dist * 60 * 1.853159;
    }
}
