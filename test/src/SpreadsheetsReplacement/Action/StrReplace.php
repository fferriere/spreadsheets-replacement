<?php

namespace Fferriere\SpreadsheetsReplacement\Action\tests\units;

// / tests / src / SpreadsheetsReplacement / Action / StrReplace
require_once dirname(dirname(dirname(dirname(__DIR__)))).'/vendor/autoload.php';

use atoum;

/**
 * Test class for StrReplace.
 *
 * @author florian
 */
class StrReplace extends atoum {

    public function testReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\StrReplace('VE', 'VTE');
        $value = 'VE';
        $this->variable('VTE')
                ->isEqualTo($action->replace($value));
    }

    public function testNoReplace() {
        $action = new \Fferriere\SpreadsheetsReplacement\Action\StrReplace('VE', 'VTE');
        $value = 'AC';
        $this->variable($value)
                ->isEqualTo($action->replace($value));
    }

    public function testReplace1() {
        $search = array('No', 'e');
        $replace = array('Ul', 'ra');
        $action = new \Fferriere\SpreadsheetsReplacement\Action\StrReplace($search, $replace);
        $value = 'Notebook';
        $result = 'Ultrabook';
        $this->variable($result)
                ->isEqualTo($action->replace($value));
    }

    public function testReplace2() {
        $search = array('445710001', '411');
        $replace = array('4457100', 'CL');
        $action = new \Fferriere\SpreadsheetsReplacement\Action\StrReplace($search, $replace);
        $this->variable('4457100')
                ->isEqualTo($action->replace('445710001'))
            ->variable('CL000326')
                ->isEqualTo($action->replace('411000326'));
    }

}
