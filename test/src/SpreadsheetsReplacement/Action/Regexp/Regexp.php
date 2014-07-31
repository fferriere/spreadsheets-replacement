<?php

namespace Fferriere\SpreadsheetsReplacement\Action\Regexp\tests\units;

// / tests / src / SpreadsheetsReplacement / Action / Regexp / Regexp
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/vendor/autoload.php';

use atoum;

/**
 * Test class for Regexp.
 *
 * @author florian
 */
class Regexp extends atoum {

    public function testReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\Regexp\Regexp();
        $action->setPattern('#^411(.*)$#');
        $action->setReplacement('CL$1');
        $subject = '411000030';
        $value = 'CL000030';
        $this->variable($value)
                ->isEqualTo($action->replace($subject));
    }

    public function testConcatenation() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\Regexp\Regexp();
        $action->setPattern('#^(.*)$#');
        $action->setReplacement('re$0r');
        $subject = 'programme';
        $value = 'reprogrammer';
        $this->variable($value)
                ->isEqualTo($action->replace($subject));
    }

}
