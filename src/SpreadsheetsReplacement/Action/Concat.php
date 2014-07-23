<?php

namespace SpreadsheetsReplacement\Action;

/**
 * Description of Concat
 *
 * @author florian
 */
class Concat extends Action {

    private $start = '';

    private $end = '';

    /**
     * Returns the string to add at start of the value.
     * @return string the string
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * Modify the string to add at start of the value.
     * @param string $start the string
     */
    public function setStart($start) {
        $this->start = (string)$start;
    }

    /**
     * Returns the string to add at start of the value.
     * @return string the string
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Modify the string to add at start of the value.
     * @param string $end the string
     */
    public function setEnd($end) {
        $this->end = (string)$end;
    }

    /**
     * {@inheritDoc}
     */
    public function replace($value) {
        return $this->getStart().$value.$this->getEnd();
    }

}
