<?php

namespace Fferriere\SpreadsheetsReplacement\Action\tests\units;

// / tests / src / Fferriere / SpreadsheetsReplacement / Action / Concat
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/vendor/autoload.php';

use atoum;

/**
 * Test class for Concat.
 *
 * @author florian
 */
class Concat extends atoum {

    public function testReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\Concat();
        $action->setStart('\'');
        $subject = '010114';
        $value = '\'010114';
        $this->variable($value)
                ->isEqualTo($action->replace($subject));
    }

}
