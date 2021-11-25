<?php

declare(strict_types=1);

namespace ToddMinerTech\DataUtils;

use ToddMinerTech\DataUtils\StringUtil;

/**
 * Class ArrUtil
 *
 * Convert regional codes and names
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class CountryStateUtil
{
    /**
     * getStateNameOrCode
     *
     * Take the 2 letter abbreviation, or the full name, and get the opposite
     * 
     * @param string $stateNameOrCode
     *
     * @return object object with name and code
     */
    public static function getStateNameOrCode(string $stateNameOrCode): object
    {
        $stateArr = getStateCodeArr();
        $stateName = '';
        $returnObj = new \stdClass();
        foreach ($stateArr as $key => $value) {
            if(StringUtil::sComp($stateNameOrCode,$key) || StringUtil::sComp($stateNameOrCode,$value)) {
                $returnObj->code = $key;
                $returnObj->name = $value;
                return $returnObj;
            }
        }
        throw new Exception('CountryStateUtil: getStateNameOrCode: We could not locate a country definition for $stateNameOrCode ('.$stateNameOrCode.')');
    }
    
    /**
     * getStateCodeArr
     *
     * Provides an array mapping code to name
     *
     * @return array 
     */
    public static function getStateCodeArr(): array
    {
        return array(
            //United States
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming',
            //Canada
            'AB'=>'Alberta',
            'BC'=>'British Columbia',
            'MB'=>'Manitoba',
            'NB'=>'New Brunswick',
            'NL'=>'Newfoundland and Labrador',
            'NT'=>'Northwest Territories',
            'NS'=>'Nova Scotia',
            'NU'=>'Nunavut',
            'ON'=>'Ontario',
            'PE'=>'Prince Edward Island',
            'QC'=>'Quebec',
            'SK'=>'Saskatchewan',
            'YT'=>'Yukon',
            //South Africa
            'EC'=>'Eastern Cape',
            'FC'=>'Free State',
            'GT'=>'Gauteng',
            'NL'=>'KwaZulu-Nata',
            'LP'=>'Limpopo',
            'MP'=>'Mpumalanga',
            'NW'=>'North West',
            'NC'=>'Northern Cape',
            'WC'=>'Western Cape'
        );
    }

    /**
     * getCountryNameOrCode
     *
     * Take the 2 letter abbreviation, or the full name, and get the opposite
     * 
     * @param string $countryCodeOrName
     *
     * @return object object with name and code
     */
    public static function getCountryNameOrCode(string $countryCodeOrName): object
    {
        $stateArr = getCountryCodeArr();
        $returnObj = new \stdClass();   
        foreach ($stateArr as $key => $value) {
            if(StringUtil::sComp($countryCodeOrName,$key) || StringUtil::sComp($countryCodeOrName,$value)) {
                $returnObj->code = $key;
                $returnObj->name = $value;
                return $returnObj;
            }
        }
        throw new Exception('CountryStateUtil: getCountryNameFromCodeOrName: We could not locate a country definition for $countryCodeOrName ('.$countryCodeOrName.')');
    }
    
    /**
     * getCountryCodeArr
     *
     * Provides an array mapping code to name
     *
     * @return array 
     */
    public static function getCountryCodeArr(): array
    {
        //IMPROVEMENT - implement this globally
        return array(
            'US'=>'United States'
        );
    }
}

