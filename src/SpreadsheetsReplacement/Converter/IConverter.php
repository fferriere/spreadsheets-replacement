<?php

namespace SpreadsheetsReplacement\Converter;

/**
 *
 * @author florian
 */
interface IConverter {

    /**
     * Converts a column name to index in array.
     * @param string $name the name
     */
    public function convert($name);

}
