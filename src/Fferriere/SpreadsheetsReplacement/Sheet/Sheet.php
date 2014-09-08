<?php

namespace Fferriere\SpreadsheetsReplacement\Sheet;

use Fferriere\SpreadsheetsReplacement\PriorityList;

use Fferriere\SpreadsheetsReplacement\Column\ColumnInterface;

class Sheet implements SheetInterface {

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
     * @param \Fferriere\SpreadsheetsReplacement\Column\ColumnInterface $column the column
     * @param int $priority the priority
     */
    public function addColumn(ColumnInterface $column, $priority = 0) {
        $this->columns->insert($column->getName(), $column, $priority);
    }

    /**
     * Remove a column into the columns list.
     * @param string $name the column name.
     */
    public function removeColumn($name) {
        $this->columns->remove($name);
    }

    /**
     * Add several column at sheet.
     * @param array<ColumnInterface> $columns columns
     */
    public function addColumns($columns) {
        for($i = 0, $size = count($columns); $i < $size; $i++) {
            $column = $columns[$i];
            if($column instanceof ColumnInterface) {
                $this->addColumn($column);
            }
        }
    }

}

