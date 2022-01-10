<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use ToddMinerTech\MinerTechDataUtils\StringUtil;
use ToddMinerTech\MinerTechDataUtils\ResultObject;

class StringUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that we get a first name in a typical scenario
     */
    public function testGetFirstNameFromFullName_GetFirstNameWithSpacePresent()
    {
        $data = 'Todd De La Miner';
        
        $result = StringUtil::getFirstNameFromFullName($data);
        
        $this->assertEquals('Todd', $result);
    }
    
    /**
     * Test that we get a last  name in a typical scenario
     */
    public function testGetFirstNameFromFullName_GetLastNameWithSpacePresent()
    {
        $data = 'Todd De La Miner';
        
        $result = StringUtil::getLastNameFromFullName($data);
        
        $this->assertEquals('De La Miner', $result);
    }
    
    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is true
     */
    public function testGetFirstNameFromFullName_GetFirstNameWithSpacePresentEmpty()
    {
        $data = 'ToddDeLaMiner';
        
        $result = StringUtil::getFirstNameFromFullName($data, true);
        
        $this->assertEquals('', $result);
    }
    
    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is false
     */
    public function testGetFirstNameFromFullName_GetLastNameWithSpacePresentNotEmpty()
    {
        $data = 'ToddDeLaMiner';
        
        $result = StringUtil::getFirstNameFromFullName($data, false);
        
        $this->assertEquals('ToddDeLaMiner', $result);
    }
    
    /**
     * Test that we get a last name as expected when no space is present and $returnEmptyIfNoSpace is true
     */
    public function testGetLastNameFromFullName_GetLastNameWithSpacePresentEmpty()
    {
        $data = 'ToddDeLaMiner';
        
        $result = StringUtil::getLastNameFromFullName($data, true);
        
        $this->assertEquals('', $result);
    }
    
    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is false
     */
    public function testGetLastNameFromFullName_GetFirstNameWithSpacePresentNotEmpty()
    {
        $data = 'ToddDeLaMiner';
        
        $result = StringUtil::getLastNameFromFullName($data, false);
        
        $this->assertEquals('ToddDeLaMiner', $result);
    }
}
