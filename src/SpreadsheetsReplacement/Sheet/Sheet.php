<?php

namespace SpreadsheetsReplacement\Sheet;

use SpreadsheetsReplacement\PriorityList;

use SpreadsheetsReplacement\Column\IColumn;

class Sheet implements ISheet {

    /**
     * List of columns
     * @var PriorityList
     */
    private $columns;

    public function __construct() {
        $this->columns = new PriorityList();
        $this->columns->setFIFO();
    }

    /**
     * {@inheritDoc}
     */
    public function getColumns() {
        return $this->columns->toArray();
    }

    /**
     * Add a column into the columns list.
     * @param \SpreadsheetsReplacement\Column\IColumn $column the column
     * @param int $priority the priority
     */
    public function addColumn(IColumn $column, $priority = 0) {
        $this->columns->insert($column->getName(), $column, $priority);
    }

    /**
     * Remove a column into the columns list.
     * @param string $name the column name.
     */
    public function removeColumn($name) {
        $this->columns->remove($name);
    }

}

