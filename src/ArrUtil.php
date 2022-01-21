<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use Closure;
use ToddMinerTech\MinerTechDataUtils\ResultObject;
use ToddMinerTech\MinerTechDataUtils\StringUtil;

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
        if (!in_array($newValue, $inputArr)) {
            $inputArr[] = $newValue;
        }
        return $inputArr;
    }

    /**
     * matchValueInObjectArray
     *
     * Searches and returns an object from within an array using defined criteria.
     *
     * @param string $valueToMatch The value you are trying to match within the object attribute
     *
     * @param string $attributeToMatch The attribute name you want to check the value of
     *
     * @param array $arrayToSearch The array of objects you are trying to match
     *
     * @return object Returns the object if matched, or null if no match is found
     */
    public static function matchValueInObjectArray(string $valueToMatch, string $attributeToMatch, array $arrayToSearch): ?object
    {
        for ($i = 0; $i < count($arrayToSearch); $i++) {
            if (!isset($arrayToSearch[$i]->$attributeToMatch)) {
                continue;
            }
            if (StringUtil::sSComp($arrayToSearch[$i]->$attributeToMatch, $valueToMatch)) {
                return $arrayToSearch[$i];
            }
        }
        return null;
    }

    /**
     * matchValueInObjectArrayIndex
     *
     * Same as matchValueInObjectArray but returns the index value instead.
     *
     * @param string $valueToMatch The value you are trying to match within the object attribute
     *
     * @param string $attributeToMatch The attribute name you want to check the value of
     *
     * @param array $arrayToSearch The array of objects you are trying to match
     *
     * @return object Returns the index of the object, or -1 if no match
     */
    public static function matchValueInObjectArrayIndex(string $valueToMatch, string $attributeToMatch, array $arrayToSearch): int|bool
    {
        for ($i = 0; $i < count($arrayToSearch); $i++) {
            if (!isset($arrayToSearch[$i]->$attributeToMatch)) {
                continue;
            }
            if (StringUtil::sSComp($arrayToSearch[$i]->$attributeToMatch, $valueToMatch)) {
                return $i;
            }
        }
        return false;
    }

    /**
     * matchValueInObjectArrayClosure
     *
     * Searches and returns an object from within an array using an anonymous function.
     *
     * @param string $matchCriteria An anonymous function that takes a comparable object returns bool value.  True if a record matches.
     *
     * @param array $arrayToSearch The array of objects you are trying to match
     *
     * @return object Returns the object if matched, or null if no match is found
     */
    public static function matchValueInObjectArrayClosure(Closure $matchCriteria, array $arrayToSearch): ?object
    {
        for ($i = 0; $i < count($arrayToSearch); $i++) {
            if ($matchCriteria($arrayToSearch[$i])) {
                return $arrayToSearch[$i];
            }
        }
        return null;
    }

    /**
     * mapValueInObjectArrayWithResult
     *
     * Clone of mapValueInObjectArray but returns a ResultObject instead to identify whether a match was found
     *
     * @param string $valueToMatch The value you are trying to match within the object attribute
     *
     * @param string $attributeToMatch The attribute name you want to check the value of
     *
     * @param string $attributeToReturn The attribute name you want to return from the matched object
     *
     * @param array $arrayToSearch The array of objects you are trying to match
     *
     * @return ResultObject If a match is found a success with the mapped value is returned, otherwise a failure with the original value
     */
    public static function mapValueInObjectArrayWithResult(string $valueToMatch, string $attributeToMatch, string $attributeToReturn, array $arrayToSearch): ResultObject
    {
        $matchedObject = self::matchValueInObjectArray($valueToMatch, $attributeToMatch, $arrayToSearch);
        if (!$matchedObject || !isset($matchedObject->$attributeToReturn)) {
            return ResultObject::fail($valueToMatch);
        }
        return ResultObject::success($matchedObject->$attributeToReturn);
    }
}
