<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

/**
 * Class ObjectUtil
 * 
 * Various object helper functions
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class ObjectUtil
{
    /**
     * isObjectEmpty
     *
     * Check all properties for an object to see if there are any values.  Useful when building objects from unknown data sources in multiple pieces and then verifying them before further processing.
     * 
     * @param object $object Object to have properties checked
     * 
     * @param array $propertiesToExclude Optional array of strings for each property you want to exclude.  Ex. ID# could be excluded so objects with id only are returned as empty.
     *
     * @return bool True if the object is empty
     */
    static function isObjectEmpty(object $object, array $propertiesToExclude): bool
    {
        foreach($object as $property => $value) {
            if($value && strlen(strval($value)) > 0 && !in_array($property, $propertiesToExclude)) {
                return false;
            }
        }
        return true;
    }
}
