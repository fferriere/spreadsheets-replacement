<?php

namespace SpreadsheetsReplacement\Replacer;

use SpreadsheetsReplacement\Sheet\SheetInterface;
use SpreadsheetsReplacement\Column\ColumnInterface;
use SpreadsheetsReplacement\Converter\ConverterInterface;
use SpreadsheetsReplacement\Action\ActionInterface;

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
            throw new \SpreadsheetsReplacement\Exception\DependencyException();
        }
        return $this->sheet;
    }

    /**
     * {@inheritDoc}
     */
    public function getConverter() {
        if (! $this->converter instanceof ConverterInterface) {
            throw new \SpreadsheetsReplacement\Exception\DependencyException();
        }
        return $this->converter;
    }

    /**
     * {@inheritDoc}
     */
    public function setSheet($sheet) {
        if($sheet && !$sheet instanceof SheetInterface) {
            throw new \SpreadsheetsReplacement\Exception\DependencyException('sheet must be SheetInterface.');
        }
        $this->sheet = $sheet;
        if($this->sheet) {
            $this->columns = $sheet->getColumns();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setConverter($converter) {
        if($converter && !$converter instanceof ConverterInterface) {
            throw new \SpreadsheetsReplacement\Exception\DependencyException('converter must be ConverterInterface.');
        }
        $this->converter = $converter;
    }

    /**
     * Replaces values in a row.
     * @param array $row
     * @param array result;
     */
    public function replaceRow($row) {
        if(empty($this->columns)) {
            throw new \SpreadsheetsReplacement\Exception\DependencyException('There are no columns.');
        }
        $result = array();
        foreach($this->columns as $column) {
            $value = $this->replaceByColumn($column, $row);
            $dest = $this->getConverter()->convert($column->getDestination());
            $result[$dest] = $value;
        }
        return $result;
    }

    /**
     * Replace value IColumn by IColumn.
     * @param \SpreadsheetsReplacement\Column\ColumnInterface $column the column "config" for replacement
     * @param array $row the row
     * @return string the value replaced
     * @throws \SpreadsheetsReplacement\Exception\ArrayIndexOutOfBoundException throw this exception when $column->getSource() inexists in row
     */
    private function replaceByColumn(ColumnInterface $column, $row) {
        $name = $column->getSource();
        $index = $this->getConverter()->convert($name);
        if (!isset($row[$index])) {
            throw new \SpreadsheetsReplacement\Exception\ArrayIndexOutOfBoundException('Index '.$index.' is too long.');
        }
        $value = $row[$index];
        return $this->replaceWithActions($column, $value);
    }

    /**
     * Replace values with actions in column.
     * @param \SpreadsheetsReplacement\Column\ColumnInterface $column the column contains actions
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
     * @param \SpreadsheetsReplacement\Action\ActionInterface $action the IAction
     * @param string $value value to replace
     * @return string the value replaced
     */
    private function actionReplace(ActionInterface $action, $value) {
        return $action->replace($value);
    }

}
