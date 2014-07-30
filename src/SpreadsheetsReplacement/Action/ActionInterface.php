<?php

namespace SpreadsheetsReplacement\Action;

/**
 *
 * @author florian
 */
interface ActionInterface {

    /**
     * Replace a value.
     * @param string $value the value to replace
     * @return string the result for the replacement
     */
    public function replace($value);

}
