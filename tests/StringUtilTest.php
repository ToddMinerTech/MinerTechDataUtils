<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use ToddMinerTech\MinerTechDataUtils\StringUtil;
use ToddMinerTech\MinerTechDataUtils\ResultObject;

/**
 * @covers  \ToddMinerTech\MinerTechDataUtils\StringUtil
 */
class StringUtilTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that spaces are removed from a string
     */
    public function test_removeSpaces_RemoveSpacesFromString()
    {
        $data = ' Todd De La Miner ';

        $result = StringUtil::removeSpaces($data);

        $this->assertEquals('ToddDeLaMiner', $result);
    }

    /**
     * Test that spaces are removed from the start and finish of a string and it is lowercased
     */
    public function test_strip_StripLeadingTrailingSpacesFromString()
    {
        $data = ' Todd De La Miner ';

        $result = StringUtil::strip($data);

        $this->assertEquals('todd de la miner', $result);
    }

    /**
     * Test that spaces all spaces and specified special characters are removed from a string
     */
    public function test_sStrip_StripAllSpacesAndSomeSpecialCharsFromString()
    {
        $data = ' Todd De La -–"&.,Miner ';

        $result = StringUtil::sStrip($data);

        $this->assertEquals('todddelaminer', $result);
    }

    /**
     * Test that two strings match when expected
     */
    public function test_sComp_MatchTwoStringsWithBasicDifferences()
    {
        $data1 = ' TODD MINER ';
        $data2 = 'todd mINer';

        $result = StringUtil::sComp($data1, $data2);

        $this->assertTrue($result);
    }

    /**
     * Test that two strings match when expected
     */
    public function test_sComp_CheckMatchFailsWithCharacterDifference()
    {
        $data1 = ' TOhDD MINER ';
        $data2 = 'todd mINer';

        $result = StringUtil::sComp($data1, $data2);

        $this->assertFalse($result);
    }

    /**
     * Test that we get a first name as expected when a space is present
     */
    public function test_getFirstNameFromFullName_GetFirstNameWithSpacePresent()
    {
        $data = 'Todd De La Miner';

        $result = StringUtil::getFirstNameFromFullName($data);

        $this->assertEquals('Todd', $result);
    }

    /**
     * Test that we get a last  name in a typical scenario
     */
    public function test_getFirstNameFromFullName_GetLastNameWithSpacePresent()
    {
        $data = 'Todd De La Miner';

        $result = StringUtil::getLastNameFromFullName($data);

        $this->assertEquals('De La Miner', $result);
    }

    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is true
     */
    public function test_getFirstNameFromFullName_GetFirstNameWithSpacePresentEmpty()
    {
        $data = 'ToddDeLaMiner';

        $result = StringUtil::getFirstNameFromFullName($data, true);

        $this->assertEquals('', $result);
    }

    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is false
     */
    public function test_getFirstNameFromFullName_GetLastNameWithSpacePresentNotEmpty()
    {
        $data = 'ToddDeLaMiner';

        $result = StringUtil::getFirstNameFromFullName($data, false);

        $this->assertEquals('ToddDeLaMiner', $result);
    }

    /**
     * Test that we get a last name as expected when no space is present and $returnEmptyIfNoSpace is true
     */
    public function test_getLastNameFromFullName_GetLastNameWithSpacePresentEmpty()
    {
        $data = 'ToddDeLaMiner';

        $result = StringUtil::getLastNameFromFullName($data, true);

        $this->assertEquals('', $result);
    }

    /**
     * Test that we get a first name as blank when no space is present and $returnEmptyIfNoSpace is false
     */
    public function test_getLastNameFromFullName_GetLastNameWithSpacePresentNotEmpty()
    {
        $data = 'ToddDeLaMiner';

        $result = StringUtil::getLastNameFromFullName($data, false);

        $this->assertEquals('ToddDeLaMiner', $result);
    }
}
