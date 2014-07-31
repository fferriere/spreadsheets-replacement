<?php

namespace Fferriere\SpreadsheetsReplacement\Action\tests\units;

// / tests / src / SpreadsheetsReplacement / Action / FullReplace
require_once dirname(dirname(dirname(dirname(__DIR__)))).'/vendor/autoload.php';

use atoum;

/**
 * Test class for FullReplace.
 *
 * @author florian
 */
class FullReplace extends atoum {

    public function testReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\FullReplace('VE', 'VTE');
        $value = 'VE';
        $this->variable('VTE')
                ->isEqualTo($action->replace($value));
    }

    public function testNoReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\FullReplace('VE', 'VTE');
        $value = 'AC';
        $this->variable($value)
                ->isEqualTo($action->replace($value));
    }

}
