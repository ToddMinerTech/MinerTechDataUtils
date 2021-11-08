<?php

declare(strict_types=1);

namespace ToddMinerTech\DataUtils;

/**
 * Class ArrUtil
 *
 * Various array editing, search, and comparison functions
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class ArrUtil
{
    /**
     * addArrIfNew
     *
     * Inserts a value into an array only if it doesn't exist yet
     * 
     * @param string $inputStr New value to insert into array
     *
     * @return array Returns the array with any update needed
     */
    public static function addArrIfNew(string $newValue, array $inputArr): array
    {
        if(!in_array($newValue, $inputArr)) {
            $inputArr[] = $newValue;
        }
        return $inputArr;
    }
}
