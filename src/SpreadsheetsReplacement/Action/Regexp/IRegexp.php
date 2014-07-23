<?php

namespace SpreadsheetsReplacement\Action\Regexp;

use SpreadsheetsReplacement\Action\IAction;

/**
 *
 * @author florian
 */
interface IRegexp extends IAction {

    /**
     * Returns the search pattern for the replacement regexp.
     * @return string the pattern.
     */
    public function getPattern();

    /**
     * Returns the replacement pattern for the replacement regexp.
     * @return string the replacement
     */
    public function getReplacement();

}
