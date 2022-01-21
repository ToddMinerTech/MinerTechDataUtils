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
    protected $dataObjectArray;
    
    protected function setUp(): void
    {
        $this->dataObjectArray = [
            (object) [
                'idToMatch2' => 'FindMe1',
                'valueToReturn2' => 'FoundMe1'
            ],
            (object) [
                'idToMatch' => 'FindMe1',
                'valueToReturn' => 'FoundMe1'
            ],
            (object) [
                'idToMatch' => 'FindMe2',
                'valueToReturn' => 'FoundMe2'
            ],
        ];
    }
    
    /**
     * Test that a new value is added to array when it doesn't already exist, even if a similar match exists
     */
    public function test_addArrIfNew_ReturnArrayWithLastValueIfNew()
    {
        $data1 = 'newValue';
        $data2 = ['notNewValue', 'alsoNotNewValue', 'NEWVALUE '];

        $result = ArrUtil::addArrIfNew($data1, $data2);

        $this->assertEquals($data1, $result[count($result)-1]);
    }
    
    /**
     * Test that we return the same exact array as provided if the value already exists
     */
    public function test_addArrIfNew_ReturnSameArrayIfValueAlreadyExists()
    {
        $data1 = 'newValue';
        $data2 = ['notNewValue', 'newValue', 'anotherNotNewValue'];

        $result = ArrUtil::addArrIfNew($data1, $data2);

        $this->assertEquals($data2, $result);
    }
    
    /**
     * Test that we can successfully map a value to another
     */
    public function test_matchValueInObjectArray_FailWithSameValueWithMatch()
    {
        $data = $this->dataObjectArray;

        $result = ArrUtil::matchValueInObjectArray('FindMe1', 'idToMatch', $data);

        $this->assertNotNull($result);
        $this->assertEquals('FindMe1', $result->idToMatch);
    }

    /**
     * Test that we will receive a fail status and our input string when no match is found
     */
    public function test_matchValueInObjectArray_FailWithSameValueWithoutMatch()
    {
        $data = $this->dataObjectArray;

        $result = ArrUtil::matchValueInObjectArray('FindMe3', 'idToMatch', $data);

        $this->assertNull($result);
    }
    
    /**
     * Test that we can successfully map a value to another
     */
    public function test_matchValueInObjectArrayIndex_FailWithSameValueWithMatch()
    {
        $data = $this->dataObjectArray;

        $result = ArrUtil::matchValueInObjectArrayIndex('FindMe1', 'idToMatch', $data);

        $this->assertNotFalse($result);
        $this->assertEquals(1, $result);
    }

    /**
     * Test that we will receive a fail status and our input string when no match is found
     */
    public function test_matchValueInObjectArrayIndex_FailWithSameValueWithoutMatch()
    {
        $data = $this->dataObjectArray;

        $result = ArrUtil::matchValueInObjectArrayIndex('FindMe3', 'idToMatch', $data);

        $this->assertFalse($result);
    }
    
    /**
     * Test that we can successfully map a value to another
     */
    public function test_matchValueInObjectArrayClosure_FailWithSameValueWithMatch()
    {
        $data = $this->dataObjectArray;
        $closure = function($objToCheck){
            if(isset($objToCheck->idToMatch) && $objToCheck->idToMatch == 'FindMe1') {
                return true;
            }
            return false;
        };

        $result = ArrUtil::matchValueInObjectArrayClosure($closure, $data);

        $this->assertNotNull($result);
        $this->assertEquals('FindMe1', $result->idToMatch);
    }

    /**
     * Test that we will receive a fail status and our input string when no match is found
     */
    public function test_matchValueInObjectArrayClosure_FailWithSameValueWithoutMatch()
    {
        $data = $this->dataObjectArray;
        $closure = function($objToCheck){
            if(isset($objToCheck->idToMatch) && $objToCheck->idToMatch == 'FindMe3') {
                return true;
            }
            return false;
        };

        $result = ArrUtil::matchValueInObjectArrayClosure($closure, $data);

        $this->assertNull($result);
    }
    
    /**
     * Test that we can successfully map a value to another
     */
    public function test_mapValueInObjectArrayWithResult_FailWithSameValueWithMatch()
    {
        $data = $this->dataObjectArray;

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
        $data = $this->dataObjectArray;

        $resultObject = ArrUtil::mapValueInObjectArrayWithResult('FindMe3', 'idToMatch', 'valueToReturn', $data);

        $this->assertInstanceOf(ResultObject::class, $resultObject);
        $this->assertFalse($resultObject->isSuccessful);
        $this->assertEquals('FindMe3', $resultObject->payload);
    }
}
