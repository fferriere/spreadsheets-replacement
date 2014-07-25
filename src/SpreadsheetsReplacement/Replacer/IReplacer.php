<?php

namespace SpreadsheetsReplacement\Replacer;

use SpreadsheetsReplacement\Sheet\ISheet;
use SpreadsheetsReplacement\Converter\IConverter;

/**
 *
 * @author florian
 */
interface IReplacer {

    /**
     * Replaces values in a row.
     * @param $row
     * @return mixed return a row with new values
     */
    public function replaceRow($row);

    /**
     * Returns the sheet.
     * @return ISheet the sheet
     */
    public function getSheet();

    /**
     * Modify the sheet.
     * @param ISheet $sheet
     */
    public function setSheet(ISheet $sheet);

    /**
     * Returns the converter.
     * @return IConverter the converter
     */
    public function getConverter();

    /**
     * Modify the converter.
     * @param IConverter $converter the converter
     */
    public function setConverter(IConverter $converter);

}
