<?php

declare(strict_types=1);

namespace ToddMinerTech\MinerTechDataUtils;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * Class SpreadsheetUtil
 *
 * This class includes wrappers for the PHPOffice/PhpSpreadsheet project to facilitate working with spreadsheet data
 * https://github.com/PHPOffice/PhpSpreadsheet
 *
 * @package ToddMinerTech\MinerTechDataUtils
 */
class SpreadsheetUtil
{
    /**
     * getArrayFromXlsx
     *
     * Provide a file path to an xlsx file and get an object back
     *
     * @param string $filePath Fully qualified file path to xlsx file
     *
     * @return string Returns array containing and object each row.  1st row will be used as attribute names for the object.
     */
    public static function getArrayFromXlsx(string $filePath): array
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($filePath);

        $data = $spreadsheet->getActiveSheet()->toArray();

        $rowNumber = 0;
        $headerRow = [];
        $valueRows = [];
        foreach ($data as $curRow) {
            //Assumed 1st row is headers
            //Index 0 based by default, changing to 1 based - this is so we can continue in multiple places without incrementing rowNumber for each
            $rowNumber++;
            $rowVals = new \stdClass();
            //Loop the header values to build a value map that we'll use to get values in other loops
            if ($rowNumber == 1) {
                //For UTF8 csv files from excel we get a special character when json encoding.  Replace that out here.
                $headerJson = str_replace(' ', '', str_replace('\ufeff', '', json_encode($curRow)));
                $headerRow = json_decode($headerJson);
            } else {
                $colNum = 0;
                $hasData = false;
                foreach ($curRow as $cCol) {
                    $rowVals->{$headerRow[$colNum]} = $cCol;
                    if ($cCol) {
                        $hasData=true;
                    }
                    $colNum++;
                }
                //Only inject if 1 of the columns had some data
                if ($hasData) {
                    $valueRows[] = $rowVals;
                }
            }
        }
        return $valueRows;
    }
}
