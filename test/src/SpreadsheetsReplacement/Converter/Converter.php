<?php

namespace SpreadsheetsReplacement\Converter\tests\units;


// / tests / src / SpreadsheetsReplacement / Converter / Converter
require_once dirname(dirname(dirname(dirname(__DIR__)))).'/vendor/autoload.php';

use atoum;

/**
 * Test class for Converter.
 *
 * @author florian
 */
class Converter extends atoum {

    public function testConvert() {
        $data = array(
            'A' => 0,
            'B' => 1,
            'C' => 2,
            'D' => 3,
            'E' => 4,
            'F' => 5,
            'G' => 6,
            'H' => 7,
            'I' => 8,
            'J' => 9,
            'K' => 10,
            'L' => 11,
            'M' => 12,
            'N' => 13,
            'O' => 14,
            'P' => 15,
            'Q' => 16,
            'R' => 17,
            'S' => 18,
            'T' => 19,
            'U' => 20,
            'V' => 21,
            'W' => 22,
            'X' => 23,
            'Y' => 24,
            'Z' => 25,
            'AA' => 26,
            'AB' => 27,
            'AZ' => 51,
            'BA' => 52,
            'BB' => 53,
            'ABC' => 730,
            'ALU' => 1008,
            'AMJ' => 1023,
            'A1' => 0,
            'F34' => 5,
            'AC 54 R5' => 28
        );

        $converter = new \SpreadsheetsReplacement\Converter\Converter();

        foreach($data as $letter => $result) {
            $this->variable($result)
                    ->isEqualTo($converter->convert($letter));
        }
    }

}
