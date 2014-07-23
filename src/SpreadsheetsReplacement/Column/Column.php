<?php

namespace SpreadsheetsReplacement\Column;

use Zend\Stdlib\PriorityQueue;
use SpreadsheetsReplacement\Action\IAction;

class Column implements IColumn {

    private $name;

    private $source;

    private $destination;

    /**
     * List of actions.
     * @var PriorityQueue
     */
    private $actions;

    public function __construct($name, $source, $destination) {
        $this->name = $name;
        $this->source = $source;
        $this->destination = $destination;
        $this->actions = new PriorityQueue();
    }

    /**
     * {@inheritDoc}
     */
    public function getName() {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getSource() {
        return $this->source;
    }

    /**
     * {@inheritDoc}
     */
    public function getDestination() {
        return $this->destination;
    }

    /**
     * {@inheritDoc}
     */
    public function getActions() {
        return $this->actions;
    }

    /**
     * Add an action on this column.
     * @param \SpreadsheetsReplacement\Action\IAction $action the action
     * @param int $priority the priority
     */
    public function addAction(IAction $action, $priority = 0) {
        $this->actions->insert($action, $priority);
    }

}
