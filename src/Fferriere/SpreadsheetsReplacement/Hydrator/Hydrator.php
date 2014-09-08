<?php

namespace Fferriere\SpreadsheetsReplacement\Hydrator;

use Fferriere\SpreadsheetsReplacement\Column\ColumnInterface;
use Fferriere\SpreadsheetsReplacement\Action\ActionInterface;
use Fferriere\SpreadsheetsReplacement\Factory;

use Zend\Stdlib\Hydrator\HydratorInterface as ZendHydratorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Description of Hydrator
 *
 * @author florian
 */
class Hydrator implements HydratorInterface {

    protected $columnFactory;
    protected $actionFactory;
    protected $hydrator;

    /**
     * Returns column's factory.
     * @return \Fferriere\SpreadsheetsReplacement\Factory\FactoryInterface the factory
     */
    public function getColumnFactory() {
        if (!$this->columnFactory) {
            $this->columnFactory = new Factory\ColumnFactory();
        }
        return $this->columnFactory;
    }

    /**
     * Update column's factory
     * @param \Fferriere\SpreadsheetsReplacement\Factory\FactoryInterface $columnFactory the column's factory
     */
    public function setColumnFactory(Factory\FactoryInterface $columnFactory) {
        $this->columnFactory = $columnFactory;
    }

    /**
     * Returns action's factory
     * @return \Fferriere\SpreadsheetsReplacement\Factory\FactoryInterface the factory
     */
    public function getActionFactory() {
        if (!$this->actionFactory) {
            $this->actionFactory = new Factory\ActionFactory();
        }
        return $this->actionFactory;
    }

    /**
     * Update action's factory.
     * @param \Fferriere\SpreadsheetsReplacement\Factory\FactoryInterface $actionFactory the factory
     */
    public function setActionFactory(Factory\FactoryInterface $actionFactory) {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Returns the hydrator.
     * @return \Zend\Stdlib\Hydrator\HydratorInterface the hydrator
     */
    public function getHydrator() {
        if(!$this->hydrator) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }

    /**
     * Update the hydrator.
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     */
    public function setHydrator(ZendHydratorInterface $hydrator) {
        $this->hydrator = $hydrator;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($params) {
        if (isset($params['columns'])) {
            $params = $params['columns'];
        }

        if (empty($params)) {
            return array();
        }

        $columns = array();
        foreach ($params as $param) {
            $column = $this->hydrateColumn($param);
            if ($column instanceof ColumnInterface) {
                $columns[] = $column;
            }
        }

        return $columns;
    }

    /**
     * Create and hydrate a column with parameters.
     * @param array $params parameters
     * @return null|ColumnInterface the column
     */
    private function hydrateColumn($params) {
        if (empty($params)) {
            return null;
        }
        $column = $this->getColumnFactory()->create('');
        $actions = (isset($params['actions'])) ? $params['actions'] : array();
        unset($params['actions']);
        $column = $this->getHydrator()->hydrate($params, $column);
        foreach ($actions as $param) {
            $action = $this->hydrateAction($param);
            if ($action instanceof ActionInterface) {
                $column->addAction($action);
            }
        }

        return $column;
    }

    /**
     * Create and hydrate an action with parameters.
     * @param array $params parameters
     * @return null|ActionInterface the action
     */
    private function hydrateAction($params) {
        if (empty($params) || !isset($params['type'])) {
            return null;
        }

        $name = $params['type'];
        try {
            $action = $this->getActionFactory()->create($name);
        } catch (Fferriere\SpreadsheetsReplacement\Exception\FactoryException $e) {
            return null;
        }

        $action = $this->getHydrator()->hydrate($params, $action);

        return $action;
    }

}
