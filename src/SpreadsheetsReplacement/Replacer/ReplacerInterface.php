<?php

namespace SpreadsheetsReplacement\Replacer;

use SpreadsheetsReplacement\Sheet\SheetInterface;
use SpreadsheetsReplacement\Converter\ConverterInterface;

/**
 *
 * @author florian
 */
interface ReplacerInterface {

    /**
     * Replaces values in a row.
     * @param $row
     * @return mixed return a row with new values
     */
    public function replaceRow($row);

    /**
     * Returns the sheet.
     * @return SheetInterface the sheet
     */
    public function getSheet();

    /**
     * Modify the sheet.
     * @param SheetInterface $sheet
     */
    public function setSheet($sheet);

    /**
     * Returns the converter.
     * @return ConverterInterface the converter
     */
    public function getConverter();

    /**
     * Modify the converter.
     * @param ConverterInterface $converter the converter
     */
    public function setConverter($converter);

}
