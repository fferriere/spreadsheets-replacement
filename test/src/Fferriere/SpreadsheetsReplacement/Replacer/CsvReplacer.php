<?php

namespace Fferriere\SpreadsheetsReplacement\Replacer\tests\units;

// / tests / src / Fferriere / SpreadsheetsReplacement / Replacer / CsvReplacer
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/vendor/autoload.php';

use atoum;


use Fferriere\SpreadsheetsReplacement\Action;
use Fferriere\SpreadsheetsReplacement\Converter\Converter;
use Fferriere\SpreadsheetsReplacement\Column\Column;
use Fferriere\SpreadsheetsReplacement\Sheet;

/**
 * Test class for CsvReplacer.
 *
 * @author florian
 */
class CsvReplacer extends atoum {

    public function testDependencyException() {
        $sheet = new Sheet\Sheet();
        $replacer = new \Fferriere\SpreadsheetsReplacement\Replacer\CsvReplacer();
        $this->exception(
                function() use ($replacer, $sheet) {
                    $replacer->setSheet($sheet);
                }
            )
                ->isInstanceOf('\Fferriere\SpreadsheetsReplacement\Exception\DependencyException');
    }

    public function testReplace() {

        // ./ test / src / Fferriere / SpreadsheetsReplacement / Replacer / CsvReplacer.php
        $dataPath = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR .'data';
        $srcPath = $dataPath . DIRECTORY_SEPARATOR . 'source.txt';
        $resultPath = $dataPath . DIRECTORY_SEPARATOR . 'source-result.txt';
        $dstPath = $dataPath . DIRECTORY_SEPARATOR . 'destination.txt';

        $convert = new Converter();
        $sheet = new Sheet\CsvSheet($srcPath);

        $column = new Column('B', 'A');
        $column->addAction(new Action\Concat('\''));
        $sheet->addColumn($column);

        $column = new Column('C', 'B');
        $column->addAction(new Action\FullReplace('VE', 'VTE'));
        $sheet->addColumn($column);

        $column = new Column('D', 'C');
        $column->addAction(new Action\StrReplace('447510001', '4457101'));
        $column->addAction(new Action\Regexp\Regexp('#^411(.)*$#', '4110000'));
        $column->addAction(new Action\Regexp\Regexp('#^7(.{4}).*(.{2})$#', '7$1$2'));
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

        $replacer = new \Fferriere\SpreadsheetsReplacement\Replacer\CsvReplacer($sheet, $convert);
        $myResultFile = $replacer->replaceFile();

        $md5Result = md5_file($myResultFile);
        $md5Dst = md5_file($dstPath);

        $this->variable($resultPath)
                ->isEqualTo($myResultFile)
            ->variable($md5Dst)
                ->isEqualTo($md5Result);

    }

    public function testReplaceWithHydrator() {

        // ./ test / src / Fferriere / SpreadsheetsReplacement / Replacer / CsvReplacer.php
        $dataPath = dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR .'data';
        $srcPath = $dataPath . DIRECTORY_SEPARATOR . 'source.txt';
        $resultPath = $dataPath . DIRECTORY_SEPARATOR . 'source-result.txt';
        $dstPath = $dataPath . DIRECTORY_SEPARATOR . 'destination.txt';

        $convert = new Converter();
        $sheet = new Sheet\CsvSheet($srcPath);

        $params = include $dataPath . DIRECTORY_SEPARATOR . 'config.php';
        $hydrator = new \Fferriere\SpreadsheetsReplacement\Hydrator\Hydrator();

        $columns = $hydrator->hydrate($params);
        $sheet->addColumns($columns);

        $replacer = new \Fferriere\SpreadsheetsReplacement\Replacer\CsvReplacer($sheet, $convert);
        $myResultFile = $replacer->replaceFile();

        $md5Result = md5_file($myResultFile);
        $md5Dst = md5_file($dstPath);

        $this->variable($resultPath)
                ->isEqualTo($myResultFile)
            ->variable($md5Dst)
                ->isEqualTo($md5Result);

    }

}
