<?php

namespace SpreadsheetsReplacement\Replacer;

use SpreadsheetsReplacement\Sheet\ISheet;
use SpreadsheetsReplacement\Converter\IConverter;

/**
 * Description of ArrayReplacer
 *
 * @author florian
 */
class ArrayReplacer extends AbstractReplacer {

    private $results;

    public function __construct(ISheet $sheet = null, IConverter $converter = null) {
        parent::__construct($sheet, $converter);
        $this->clearResults();
    }

    public function replaceRow($row) {
        $this->results[] = parent::replaceRow($row);
    }

    public function getResults() {
        return $this->results;
    }

    public function clearResults() {
        $this->results = array();
    }

}
