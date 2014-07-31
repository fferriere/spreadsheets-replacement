<?php

namespace Fferriere\SpreadsheetsReplacement\Replacer\tests\units;

// / tests / src / SpreadsheetsReplacement / Replacer / ArrayReplacer
require_once dirname(dirname(dirname(dirname(__DIR__)))).'/vendor/autoload.php';

use atoum;

use Fferriere\SpreadsheetsReplacement\Action;
use Fferriere\SpreadsheetsReplacement\Converter\Converter;
use Fferriere\SpreadsheetsReplacement\Column\Column;
use Fferriere\SpreadsheetsReplacement\Sheet\Sheet;

/**
 * Test class for ArrayReplacer.
 *
 * @author florian
 */
class ArrayReplacer extends atoum {

    public function testReplacement() {
        $convert = new Converter();
        $sheet = new Sheet();

        $column = new Column('B', 'A');
        $column->addAction(new Action\Concat('\''));
        $sheet->addColumn($column);

        $column = new Column('C', 'B');
        $column->addAction(new Action\FullReplace('VE', 'VTE'));
        $sheet->addColumn($column);

        $column = new Column('D', 'C');
        $column->addAction(new Action\StrReplace('447510001', '4457101'));
        $column->addAction(new Action\Regexp\Regexp('#^411(.)*$#', '4110000'));
        $column->addAction(new Action\Regexp\Regexp('#^7(.{4}).*(.{2})$$#', '7$1$2'));
        $sheet->addColumn($column);

        $column = new Column('D', 'D', 'D1');
        $column->addAction(new Action\Regexp\Regexp('#^(?!411)(.)*$#', ''));
        $column->addAction(new Action\Regexp\Regexp('#^411(.*)$#', 'CL$1'));
        $sheet->addColumn($column);

        $column = new Column('I', 'E');
        $sheet->addColumn($column);

        $column = new Column('H', 'F');
        $column->addAction(new Action\StrReplace('.', ','));
        $sheet->addColumn($column);

        $column = new Column('F', 'G');
        $sheet->addColumn($column);

        $column = new Column('G', 'H');
        $sheet->addColumn($column);

        $replacer = new \Fferriere\SpreadsheetsReplacement\Replacer\ArrayReplacer($sheet, $convert);

        $rows = array(
            array(
                '2',
                '03062014',
                'VE',
                '411000001',
                '',
                'Fact Foo Bar FC n°FC030614 du 03/06/14',
                'FC030614',
                '15.65',
                'C',
                '',
                '',
                'EUR'
            ),
            array(
                '3',
                '03062014',
                'VE',
                '708500003',
                '',
                'Fact Foo Bar FC n°FC030614 du 03/06/14',
                'FC030614',
                '15.65',
                'C',
                '',
                '',
                'EUR'
            ),
        );

        $result = array (
            array (
                '\'03062014',
                'VTE',
                '4110000',
                'CL000001',
                'C',
                '15,65',
                'Fact Foo Bar FC n°FC030614 du 03/06/14',
                'FC030614',
            ),
            array (
                '\'03062014',
                'VTE',
                '7085003',
                '',
                'C',
                '15,65',
                'Fact Foo Bar FC n°FC030614 du 03/06/14',
                'FC030614',
            ),
        );
        for($i = 0, $size = count($rows); $i < $size; $i++) {
            $replacer->replaceRow($rows[$i]);
        }
        $this->array($result)
                ->isEqualTo($replacer->getResults());
    }

}
