<?php

namespace Fferriere\SpreadsheetsReplacement\Sheet;

/**
 *
 * @author florian
 */
interface SheetInterface {

    /**
     * Returns list of columns to change or copy.
     * @return \Iterator the list of IColumn
     */
    public function getColumns();

}
