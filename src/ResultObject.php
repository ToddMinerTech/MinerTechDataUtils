<?php

namespace ToddMinerTech\MinerTechDataUtils;

/**
 * Class ResultObject
 *
 * Generic result object returned by all methods for error handling
 * 
 * Contains bool to track success, then the payload will either be the returned variant, or a string with a failure message.
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
final class ResultObject
{
    public $isSuccessful;
    public $payload = null;

    private function __construct(bool $isSuccessful, $payload = null)
    {
        $this->isSuccessful = $isSuccessful;
        $this->payload = $payload;
    }

    public static function fail($payload = null): ResultObject
    {
        return new static(false, $payload);
    }

    public static function success($payload = null): ResultObject
    {
        return new static(true, $payload);
    }
}