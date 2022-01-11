<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use ToddMinerTech\MinerTechDataUtils\CountryStateUtil;
use ToddMinerTech\MinerTechDataUtils\ResultObject;

/**
* @covers  \ToddMinerTech\MinerTechDataUtils\CountryStateUtil
* @covers  \ToddMinerTech\MinerTechDataUtils\StringUtil
*/
class CountryStateUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that we get a state name from a valid state code.  Verifies capitalization and trimming.
     */
    public function test_getStateNameOrCode_GetStateNameFromCodeValid()
    {
        $data = 'cA ';

        $result = CountryStateUtil::getStateNameOrCode($data);

        $this->assertEquals('California', $result->name);
    }

    /**
     * Test that we get a state code from a valid state name.  Verifies capitalization and trimming.
     */
    public function test_getStateNameOrCode_GetStateCodeFromNameValid()
    {
        $data = 'califorNIA ';

        $result = CountryStateUtil::getStateNameOrCode($data);

        $this->assertEquals('CA', $result->code);
    }

    /**
     * Test that we get a null value with an invalid state name
     */
    public function test_getStateNameOrCode_GetStateNameFromCodeInvalidValid()
    {
        $data = 'cAjs';

        $result = CountryStateUtil::getStateNameOrCode($data);

        $this->assertNull($result);
    }

    /**
     * Test that we get a state name from a valid state code.  Verifies capitalization and trimming.
     */
    public function test_getCountryNameOrCode_GetCountryNameFromCodeValid()
    {
        $data = 'uS ';

        $result = CountryStateUtil::getCountryNameOrCode($data);

        $this->assertEquals('United States', $result->name);
    }

    /**
     * Test that we get a state code from a valid state name.  Verifies capitalization and trimming.
     */
    public function test_getCountryNameOrCode_GetCountryCodeFromNameValid()
    {
        $data = 'unITED states ';

        $result = CountryStateUtil::getCountryNameOrCode($data);

        $this->assertEquals('US', $result->code);
    }

    /**
     * Test that we get a null value with an invalid state name
     */
    public function test_getCountryNameOrCode_GetCountryNameFromCodeInvalidValid()
    {
        $data = '123';

        $result = CountryStateUtil::getCountryNameOrCode($data);

        $this->assertNull($result);
    }
}
