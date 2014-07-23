<?php

namespace SpreadsheetsReplacement\Sheet;

/**
 *
 * @author florian
 */
interface ISheet {

    /**
     * Returns list of columns to change or copy.
     * @return \Iterator the list of IColumn
     */
    public function getColumns();

}
