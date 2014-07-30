<?php

namespace SpreadsheetsReplacement\Replacer;

/**
 * Description of ArrayReplacer
 *
 * @author florian
 */
class ArrayReplacer extends AbstractReplacer {

    private $results;

    public function __construct($sheet = null, $converter = null) {
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
