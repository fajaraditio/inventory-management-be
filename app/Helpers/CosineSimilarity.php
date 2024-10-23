<?php

namespace App\Helpers;

class CosineSimilarity
{
    private static function createFreqVector($words)
    {
        $words = preg_split('/\s+/', strtolower($words));
        $vector = [];

        foreach ($words as $word) {
            if (isset($vector[$word])) {
                $vector[$word]++;
            } else {
                $vector[$word] = 1;
            }
        }

        return $vector;
    }

    public static function checkPercentage($words, $target)
    {
        $vectorWords = static::createFreqVector($words);
        $vectorTargets = static::createFreqVector($target);

        $dotProduct = 0;

        foreach ($vectorWords as $key => $value) {
            if (isset($vectorTargets[$key])) {
                $dotProduct += $value * $vectorTargets[$key];
            }
        }

        $wordMagnitude = sqrt(array_sum(array_map(function ($value) {
            return $value * $value;
        }, $vectorWords)));

        $targetMagnitude = sqrt(array_sum(array_map(function ($value) {
            return $value * $value;
        }, $vectorTargets)));

        if ($wordMagnitude * $targetMagnitude === 0) {
            return 0;
        }

        return $dotProduct / ($wordMagnitude * $targetMagnitude) * 100;
    }
}
