<?php

namespace App\Helpers;

class HaversineFormula
{
    public static function checkGeoSimilarity($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $degLat = deg2rad($lat2 - $lat1);
        $degLon = deg2rad($lon2 - $lon1);
        $a = sin($degLat / 2) * sin($degLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($degLon / 2) * sin($degLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        $maxDistance = 10; // assuming max similarity is 10 km;

        return max(0, (1 - ($distance / $maxDistance)) * 100);
    }
}
