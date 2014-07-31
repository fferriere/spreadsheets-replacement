<?php

namespace Fferriere\SpreadsheetsReplacement;

use Zend\Stdlib\PriorityList as ZendPriorityList;

/**
 * Description of PriorityList
 *
 * @author florian
 */
class PriorityList extends ZendPriorityList {

    /**
     * Change the order of the list for FIFO.
     */
    public function setFIFO() {
        return !$this->isLIFO(false);
    }

    /**
     * Change the order of the list for LIFO.
     */
    public function setLIFO() {
        return $this->isLIFO(true);
    }

}
