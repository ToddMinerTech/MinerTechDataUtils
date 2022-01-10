<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

/**
 * Class StringUtil
 *
 * Various string editing and comparison functions
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class StringUtil
{
    /**
     * removeSpaces
     *
     * Simple removal of all spaces
     * 
     * @param string $inputStr String to be stripped
     *
     * @return string Returns stripped string
     */
    public static function removeSpaces(?string $inputStr): string
    {
        return str_replace(' ', '', $inputStr);
    }
    
    /**
     * strip
     *
     * Wrapper for both strtolower and trim to prepare strings for comparison
     * 
     * @param string $inputStr String to be stripped
     *
     * @return string Returns stripped string
     */
    public static function strip(string|int $inputStr = ''): string
    {
        if(!$inputStr) {
            return '';
        }else{
            return trim(strtolower(strval($inputStr)));
        }
    }
    
    /**
     * sStrip
     *
     * Wrapper of strip but this completely removes spaces, commas, and hyphens in the comparison
     * 
     * @param string $inputStr String to be super stripped
     *
     * @return string Returns super stripped string
     */
    public static function sStrip(string|int $inputStr = ''): string
    {
        $outputStr = self::strip(strval($inputStr));
        $outputStr = str_replace(' ','',$outputStr);
        $outputStr = str_replace('-','',$outputStr);
        $outputStr = str_replace('–','',$outputStr);
        $outputStr = str_replace('"','',$outputStr);
        $outputStr = str_replace('&','',$outputStr);
        $outputStr = str_replace('.','',$outputStr);
        $outputStr = str_replace(',','',$outputStr);
        return $outputStr;
    }

    /**
     * sComp
     *
     * Compares two strings using the strip function first
     * 
     * @param string $inputStr1 First string to compare
     * 
     * @param string $inputStr2 Second string to compare
     *
     * @return bool Returns true if strings match
     */
    public static function sComp(string|int $inputStr1 = '', string|int $inputStr2 = ''): bool
    {
        if(self::strip(strval($inputStr1)) == self::strip(strval($inputStr2))) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    public static function ssComp(string|int $inputStr1 = '', string|int $inputStr2 = ''): bool
    {
        if(self::sComp(self::sStrip($inputStr1),self::sStrip($inputStr2))) {
            return true;
        }
        return false;
    }

    /**
     * ssCompIfValsPresent
     *
     * Wraps ssComp but returns false if both inputs are empty.  Used when comparing 2 objects to detect a duplicate, but not wanting to flag a dupe on an empty value.
     * 
     * @param string $inputStr1 First string to compare
     * 
     * @param string $inputStr2 Second string to compare
     *
     * @return bool Returns true if strings match
     */
    public static function ssCompIfValsPresent(string|int $inputStr1 = '', string|int $inputStr2 = ''): bool
    {
        if(self::sComp(self::sStrip($inputStr1),self::sStrip($inputStr2))) {
            if(strlen(strval($inputStr1)) > 0 || strlen(strval($inputStr2)) > 0) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * ssPhraseComp
     *
     * Wraps ssComp into a word by word comparison of a string.  Can be used to search for all words of the needle within the haystack.
     * 
     * @param string $needle Substring to look for within larger string
     * 
     * @param string $haystack Larger string with multiple words
     *
     * @return bool Returns true if all words of the needle exist within the haystack
     */
    public static function ssPhraseComp(string $needle, string $haystack, int $minCharPerWord = 3): bool
    {
        $needleArr = explode(' ',$needle);
        $matchFailed = false;
        //Before we do the complex check, try do a ssComp of the strings
        if(ssComp($needle,$haystack)) {
            $matched = true;
        }else{
            for($i=0;$i<count($needleArr);$i++) {
                //Skip any words under the $minCharPerWord
                if(strlen($needleArr[$i]) >= $minCharPerWord) {
                    //logIt('Checking for needle ('.sStrip($needleArr[$i]).')   within haystack ('.$haystack.')');
                    if(strpos(self::sStrip($haystack),self::sStrip($needleArr[$i])) !== false) {
                        //logIt('needle found');
                        $matched = true;
                    }else{
                        $matchFailed = true;
                    }
                }
            }
        }
        if($matched && !$matchFailed) {
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * getFirstNameFromFullName
     *
     * split a name by the 1st space to get a first/last name
     * 
     * @param string $fullName Full name of a person to split
     * 
     * @param bool $returnEmptyIfNoSpace Defaults to true.  If true then an empty string is returned when no space is present.  Otherwise the fullname is returned.
     *
     * @return string Returns all characters before the 1st space, all characters, or none at all depending on $returnEmptyIfNoSpace
     */
    public static function getFirstNameFromFullName(string $fullName, bool $returnEmptyIfNoSpace = true): string
    {
        $spaceIndex = strpos($fullName,' ');
        if($spaceIndex) {
            return substr($fullName,0,strpos($fullName,' '));
        }
        if($returnEmptyIfNoSpace) {
            return '';
        }else{
            return $fullName;
        }
    }

    /**
     * getLastNameFromFullName
     *
     * split a name by the 1st space to get a first/last name
     * 
     * @param string $fullName Full name of a person to split
     * 
     * @param bool $returnEmptyIfNoSpace Defaults to true.  If true then an empty string is returned when no space is present.  Otherwise the fullname is returned.
     *
     * @return string Returns all characters before the 1st space, all characters, or none at all depending on $returnEmptyIfNoSpace
     */
    public static function getLastNameFromFullName(string $fullName, bool $returnEmptyIfNoSpace = false): string
    {
        $spaceIndex = strpos($fullName,' ');
        if($spaceIndex) {
            return substr($fullName,strpos($fullName,' ')+1);
        }
        if($returnEmptyIfNoSpace) {
            return '';
        }else{
            return $fullName;
        }
    }
}
