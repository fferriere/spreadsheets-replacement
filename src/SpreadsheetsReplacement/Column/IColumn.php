<?php

namespace SpreadsheetsReplacement\Column;

/**
 * Interface of Column for the replacement.
 * It's a actions group for on column to rewrite in destination spreadsheet.
 * @author florian
 */
interface IColumn {

    /**
     * Returns the name of the column.
     * Put what you want.
     * It can be the same of $source but if you have another group replacement you can increment the name.
     * Exemple: A, A1, A2, B, C, D
     * @return string the name
     */
    public function getName();

    /**
     * Returns the name of the source column.
     * @return string the source name
     */
    public function getSource();

    /**
     * Returns the name of the destination column.
     * @return string the destination name
     */
    public function getDestination();

    /**
     * Returns list of actions for this column.
     * @return \IteratorAggregate the list of IAction
     */
    public function getActions();

}
