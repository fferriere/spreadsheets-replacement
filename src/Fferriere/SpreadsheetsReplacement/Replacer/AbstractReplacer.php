<?php

namespace Fferriere\SpreadsheetsReplacement\Replacer;

use Fferriere\SpreadsheetsReplacement\Sheet\SheetInterface;
use Fferriere\SpreadsheetsReplacement\Column\ColumnInterface;
use Fferriere\SpreadsheetsReplacement\Converter\ConverterInterface;
use Fferriere\SpreadsheetsReplacement\Action\ActionInterface;

/**
 * Description of Replacer
 *
 * @author florian
 */
 class AbstractReplacer implements ReplacerInterface {

    /**
     * @var SheetInterface
     */
    private $sheet;

    /**
     * @var ColumnInterface[];
     */
    private $columns;

    /**
     * @var ConverterInterface
     */
    private $converter;

    public function __construct($sheet = null, $converter = null) {
        $this->setSheet($sheet);
        $this->setConverter($converter);
    }

    /**
     * {@inheritDoc}
     */
    public function getSheet() {
        if (! $this->sheet instanceof SheetInterface) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\DependencyException();
        }
        return $this->sheet;
    }

    /**
     * {@inheritDoc}
     */
    public function getConverter() {
        if (! $this->converter instanceof ConverterInterface) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\DependencyException();
        }
        return $this->converter;
    }

    /**
     * {@inheritDoc}
     */
    public function setSheet($sheet) {
        if($sheet && !$sheet instanceof SheetInterface) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\DependencyException('sheet must be SheetInterface.');
        }
        $this->sheet = $sheet;
    }

    /**
     * {@inheritDoc}
     */
    public function setConverter($converter) {
        if($converter && !$converter instanceof ConverterInterface) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\DependencyException('converter must be ConverterInterface.');
        }
        $this->converter = $converter;
    }

    /**
     * Returns columns list.
     * @return ColumnInterface[]
     */
    protected function getColumns() {
        if(!$this->columns instanceof \Iterator
                && $this->sheet instanceof SheetInterface) {
            $this->columns = $this->sheet->getColumns();
        }
        return $this->columns;
    }

    /**
     * Replaces values in a row.
     * @param array $row
     * @param array result;
     */
    public function replaceRow($row) {
        $columns = $this->getColumns();
        if(empty($columns)) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\DependencyException('There are no columns.');
        }
        $result = array();
        foreach($columns as $column) {
            $value = $this->replaceByColumn($column, $row);
            $dest = $this->getConverter()->convert($column->getDestination());
            $result[$dest] = $value;
        }
        return $result;
    }

    /**
     * Replace value IColumn by IColumn.
     * @param \Fferriere\SpreadsheetsReplacement\Column\ColumnInterface $column the column "config" for replacement
     * @param array $row the row
     * @return string the value replaced
     * @throws \Fferriere\SpreadsheetsReplacement\Exception\ArrayIndexOutOfBoundException throw this exception when $column->getSource() inexists in row
     */
    private function replaceByColumn(ColumnInterface $column, $row) {
        $name = $column->getSource();
        $index = $this->getConverter()->convert($name);
        if (!isset($row[$index])) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\ArrayIndexOutOfBoundException('Index '.$index.' is too long.');
        }
        $value = $row[$index];
        return $this->replaceWithActions($column, $value);
    }

    /**
     * Replace values with actions in column.
     * @param \Fferriere\SpreadsheetsReplacement\Column\ColumnInterface $column the column contains actions
     * @param string $value the value to replace
     * @return string the value replaced
     */
    private function replaceWithActions(ColumnInterface $column, $value) {
        $actions = $column->getActions();
        foreach($actions as $action) {
            $value = $this->actionReplace($action, $value);
        }
        return $value;
    }

    /**
     * Replace a value with an IAction.
     * @param \Fferriere\SpreadsheetsReplacement\Action\ActionInterface $action the IAction
     * @param string $value value to replace
     * @return string the value replaced
     */
    private function actionReplace(ActionInterface $action, $value) {
        return $action->replace($value);
    }

}
