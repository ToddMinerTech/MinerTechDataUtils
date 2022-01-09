<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use ToddMinerTech\MinerTechDataUtils\ArrUtil;
use ToddMinerTech\MinerTechDataUtils\ResultObject;

class ArrUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that we can successfully map a value to another
     */
    public function testMapValueInObjectArrayWithResult_FailWithSameValueWithMatch()
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
        
        $this->assertInstanceOf(ResultObject, $resultObject);
        $this->assertTrue($resultObject->isSuccessful);
        $this->assetEquals('FoundMe1');
    }
    /**
     * Test that we will receive a fail status and our input string when no match is found
     */
    public function testMapValueInObjectArrayWithResult_FailWithSameValueWithoutMatch()
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
        
        $this->assertInstanceOf(ResultObject, $resultObject);
        $this->assertFalse($resultObject->isSuccessful);
        $this->assetEquals('FindMe3');
    }
}
