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
class DataUtils
{
    /**
     * safeJsonEncode
     *
     * Taken from php.net comment: https://www.php.net/manual/en/function.json-last-error.php#115980
     * Added to handle some character encoding issues when building objects from json
     * 
     * @param string $value Normal json string, like you'd use in json_encode.
     *
     * @return string Returns object or null like json_encode
     */
    public static function safeJsonEncode(string $value, int $options = 0, int $depth = 512, bool $utfErrorFlag = false): object
    {
        $encoded = json_encode($value, $options, $depth);
        switch (json_last_error())
        {
            case JSON_ERROR_NONE:
                return $encoded;
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
            case JSON_ERROR_UTF8:
                $clean = self::utf8ize($value);
                if ($utfErrorFlag) {
                    return 'UTF8 encoding error'; // or trigger_error() or throw new Exception()
                }
                return safe_json_encode($clean, $options, $depth, true);
            default:
                return 'Unknown error'; // or trigger_error() or throw new Exception()
        }
    }

    private function utf8ize($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = utf8ize($value);
            }
        } else if (is_string ($mixed)) {
            return utf8_encode($mixed);
        }
        return $mixed;
    }
}
