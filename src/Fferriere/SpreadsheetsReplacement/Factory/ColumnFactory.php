<?php

namespace Fferriere\SpreadsheetsReplacement\Factory;

use Fferriere\SpreadsheetsReplacement\Column\Column;

/**
 * Description of ColumnFactory
 *
 * @author florian
 */
class ColumnFactory implements FactoryInterface {

    /**
     * Create an new instance of ColumnInterface
     * @param string $name
     * @return ColumnInterface $column
     */
    public function create($name) {
        return new Column();
    }

}
