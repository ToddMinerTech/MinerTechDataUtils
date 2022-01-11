<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

/**
 * Class XmlUtil
 *
 * Various xml handling functions
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class XmlUtil
{
    /**
     * xmlToArray
     *
     * A common function found across the internet, provide XML, get a php array back
     *
     * @param SimpleXMLElement $xml XML element to be converted
     *
     * @return string Returns a php array of XML
     */
    public static function xmlToArray(\SimpleXMLElement $xml): array
    {
        $arr = array();
        foreach ($xml as $element) {
            $tag = $element->getName();
            $e = get_object_vars($element);
            if (!empty($e)) {
                $arr[$tag] = $element instanceof SimpleXMLElement ? xmlToArray($element) : $e;
            } else {
                $arr[$tag] = trim($element);
            }
        }
        return $arr;
    }
}
