<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use ToddMinerTech\MinerTechDataUtils\ArrUtil;
use ToddMinerTech\MinerTechDataUtils\ResultObject;

    /**
     * @covers  \ToddMinerTech\MinerTechDataUtils\ArrUtil
     * @covers  \ToddMinerTech\MinerTechDataUtils\StringUtil
     * @covers  \ToddMinerTech\MinerTechDataUtils\ResultObject
     */
class ArrUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that we can successfully map a value to another
     */
    public function test_mapValueInObjectArrayWithResult_FailWithSameValueWithMatch()
    {
        $data = [
            (object) [
                'idToMatch' => 'FindMe1',
                'valueToReturn' => 'FoundMe1'
            ],
            (object) [
                'idToMatch' => 'FindMe2',
                'valueToReturn' => 'FoundMe2'
            ],
        ];

        $resultObject = ArrUtil::mapValueInObjectArrayWithResult('FindMe1', 'idToMatch', 'valueToReturn', $data);

        $this->assertInstanceOf(ResultObject::class, $resultObject);
        $this->assertTrue($resultObject->isSuccessful);
        $this->assertEquals('FoundMe1', $resultObject->payload);
    }

    /**
     * Test that we will receive a fail status and our input string when no match is found
     */
    public function test_mapValueInObjectArrayWithResult_FailWithSameValueWithoutMatch()
    {
        $data = [
            (object) [
                'idToMatch' => 'FindMe1',
                'valueToReturn' => 'FoundMe1'
            ],
            (object) [
                'idToMatch' => 'FindMe2',
                'valueToReturn' => 'FoundMe2'
            ],
        ];

        $resultObject = ArrUtil::mapValueInObjectArrayWithResult('FindMe3', 'idToMatch', 'valueToReturn', $data);

        $this->assertInstanceOf(ResultObject::class, $resultObject);
        $this->assertFalse($resultObject->isSuccessful);
        $this->assertEquals('FindMe3', $resultObject->payload);
    }
}
