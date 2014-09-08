<?php

namespace Fferriere\SpreadsheetsReplacement\Column;

use Zend\Stdlib\PriorityQueue;
use Fferriere\SpreadsheetsReplacement\Action\ActionInterface;

class Column implements ColumnInterface {

    private $name;

    private $source;

    private $destination;

    /**
     * List of actions.
     * @var PriorityQueue
     */
    private $actions;

    public function __construct($source = null, $destination = null, $name = null) {
        $this->name = $name;
        $this->source = $source;
        $this->destination = $destination;
        $this->actions = new PriorityQueue();
    }

    /**
     * {@inheritDoc}
     */
    public function getName() {
        if(!$this->name) {
            $this->name = $this->source;
        }
        return $this->name;
    }

    /**
     * Modify the column name.
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * Modify the source column's name.
     * @param string $source
     */
    public function setSource($source) {
        $this->source = $source;
    }

    /**
     * {@inheritDoc}
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * Modify the destination column's name.
     * @param string $destination
     */
    public function setDestination($destination) {
        $this->destination = $destination;
    }

    /**
     * {@inheritDoc}
     */
    public function getActions() {
        return $this->actions;
    }

    /**
     * {@inheritDoc}
     */
    public function addAction(ActionInterface $action, $priority = 0) {
        $this->actions->insert($action, $priority);
    }

}
