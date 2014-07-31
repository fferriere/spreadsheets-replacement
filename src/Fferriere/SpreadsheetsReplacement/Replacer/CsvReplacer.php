<?php

namespace Fferriere\SpreadsheetsReplacement\Replacer;

use Fferriere\SpreadsheetsReplacement\Sheet\CsvSheet;
use Fferriere\SpreadsheetsReplacement\Exception\DependencyException;

/**
 * Description of CsvReplacer
 *
 * @author florian
 */
class CsvReplacer extends AbstractReplacer {

    /**
     * {@inheritDoc}
     * @throws DependencyException if $sheet is not a CsvSheet instance
     */
    public function __construct($sheet = null, $converter = null) {
        parent::__construct($sheet, $converter);
    }

    /**
     * {@inheritDoc}
     * @throws DependencyException if $sheet is not a CsvSheet instance
     */
    public function setSheet($sheet) {
        if($sheet != null && !$sheet instanceof CsvSheet) {
            throw new DependencyException('The sheet must be an instance of \Fferriere\SpreadsheetsReplacement\Sheet\CsvSheet.');
        }
        parent::setSheet($sheet);
    }

        /**
     * Replace element of CSV file and return the result filepath.
     * @return string filepath
     */
    public function replaceFile() {
        /* @var $sheet CsvSheet */
        $sheet = $this->getSheet();
        $sheet->open();

        while(($row = $sheet->readOneRow()) !== false) {
            $result = $this->replaceRow($row);
            $sheet->writeOneRow($result);
        }

        $sheet->close();
        return $sheet->getWriteFilepath();
    }

}
