<?php

namespace Fferriere\SpreadsheetsReplacement\Converter;

/**
 * Description of Converter
 *
 * @author florian
 */
class Converter implements ConverterInterface {

    /**
     * {@inheritDoc}
     */
    public function convert($name) {
        $name = $this->cleanName($name);
        $base = ord('A');
        $tab = str_split($name);
        $index = 0;
        for ($i = 0, $size = count($tab); $i < $size; $i++) {
            // convert letter to ascii number
            $ascii = ord($tab[$i]) + 1;
            // convert ascii to integer index
            $number = $ascii - $base;
            // calculate the exponent
            $exp = $size - $i - 1;
            // calculate the index
            $index += pow(26, $exp) * $number;
        }
        return $index - 1;
    }

    /**
     * Clean the column name for remove other chars.
     * Exemple : A1 => 1, B2 => B
     * @param string $name the to clean
     * @return string the name cleaned
     */
    public function cleanName($name) {
        $name = strtoupper($name);
        $pattern = '#([A-Z]*)#';
        $results = array();
        preg_match($pattern, $name, $results);
        return isset($results[1]) ? $results[1] : '';
    }

}
