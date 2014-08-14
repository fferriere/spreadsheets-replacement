<?php

namespace Fferriere\SpreadsheetsReplacement\Action\tests\units;

// / tests / src / Fferriere / SpreadsheetsReplacement / Action / Copy
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/vendor/autoload.php';

use mageekguy\atoum;

/**
 * Test class for Copy.
 *
 * @author florian
 */
class Copy extends atoum\test {

    public function testReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\Copy();
        $value = 'spreadsheets';
        $this->variable($value)
                ->isEqualTo($action->replace($value));
    }

}
