<?php

declare(strict_types=1);

namespace ToddMinerTech\DataUtils;

/**
 * Class DataUtils
 *
 * Class to map an app name/id to static values that are required for each app.  No raw source for these right now, manually tested and documented.
 *
 * @package ToddMinerTech\apptivo-php-mt
 */
class StringUtil
{
    /**
     * strip
     *
     * Wrapper for both strtolower and trim to prepare strings for comparison
     * 
     * @param string $inputStr String to be stripped
     *
     * @return string Returns stripped string
     */
    public static function strip(string $inputStr): string
    {
        return trim(strtolower($inputStr));
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
    public static function sStrip(string $inputStr): string
    {
        $outputStr = strip($inputStr);
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
    public static function sComp(string $inputStr1, string $inputStr2): bool
    {
        $compString1 = strip($inputStr1);
        $compString2 = strip($inputStr2);
        if(strip($compString1) == strip($compString2)) {
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    /**
     * ssComp
     *
     * Wraps sComp but this completely removes spaces and hyphens in the comparison
     * 
     * @param string $inputStr1 First string to compare
     * 
     * @param string $inputStr2 Second string to compare
     *
     * @return bool Returns true if strings match
     */
    public static function ssComp(string $inputStr1, string $inputStr2):bool
    {
        if(sComp(sStrip($inputStr1),sStrip($inputStr2))) {
                $result = true;
        }else{
                $result = false;
        }
        return $result;
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
                    if(strpos(sStrip($haystack),sStrip($needleArr[$i])) !== false) {
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
}
