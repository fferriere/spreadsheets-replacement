<?php

namespace Fferriere\SpreadsheetsReplacement\Hydrator\tests\units;

// / tests / src / Fferriere / SpreadsheetsReplacement / Hydrator / Hydrator
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/vendor/autoload.php';

use atoum;

use Fferriere\SpreadsheetsReplacement\Action;
use Fferriere\SpreadsheetsReplacement\Column\Column;

/**
 * Test class for Hydrator.
 *
 * @author florian
 */
class Hydrator extends atoum {

    public function testHydrate() {
        $columns = $this->getClassColumns();
        $params = $this->getArrayColumns();

        $hydrator = new \Fferriere\SpreadsheetsReplacement\Hydrator\Hydrator();

        $result = $hydrator->hydrate($params);

        $this->variable($columns)
                ->isEqualTo($result);
    }

    private function getClassColumns() {
        $columns = array();
        $column = new Column('B', 'A');
        $column->addAction(new Action\Concat('\''));
        $columns[] = $column;

        $column = new Column('C', 'B');
        $column->addAction(new Action\FullReplace('VE', 'VTE'));
        $columns[] = $column;

        $column = new Column('D', 'C');
        $column->addAction(new Action\StrReplace('447510001', '4457101'));
        $column->addAction(new Action\Regexp\Regexp('#^411(.)*$#', '4110000'));
        $column->addAction(new Action\Regexp\Regexp('#^7(.{4}).*(.{2})$#', '7$1$2'));
        $columns[] = $column;

        $column = new Column('D', 'D', 'D1');
        $column->addAction(new Action\Regexp\Regexp('#^(?!411)(.)*$#', ''));
        $column->addAction(new Action\Regexp\Regexp('#^411(.*)$#', 'CL$1'));
        $columns[] = $column;

        $column = new Column('I', 'E');
        $columns[] = $column;

        $column = new Column('H', 'F');
        $column->addAction(new Action\StrReplace('.', ','));
        $columns[] = $column;

        $column = new Column('F', 'G');
        $columns[] = $column;

        $column = new Column('G', 'H');
        $columns[] = $column;

        return $columns;
    }

    private function getArrayColumns() {
        // src / Fferriere / SpreadsheetsReplacement / Hydrator / Hydrator.php
        return include dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'config.php';
    }

}
