<?php

namespace SpreadsheetsReplacement\Action;

/**
 * Action to copy a column's value
 *
 * @author florian
 */
class Copy extends Action {

    /**
     * {@inheritDoc}
     */
    public function replace($value) {
        return $value;
    }

}
