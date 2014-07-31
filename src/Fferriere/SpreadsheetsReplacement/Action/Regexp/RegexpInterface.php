<?php

namespace Fferriere\SpreadsheetsReplacement\Action\Regexp;

use Fferriere\SpreadsheetsReplacement\Action\ActionInterface;

/**
 *
 * @author florian
 */
interface RegexpInterface extends ActionInterface {

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
