<?php

namespace Fferriere\SpreadsheetsReplacement\Hydrator;

/**
 *
 * @author florian
 */
interface HydratorInterface {

    /**
     * Convert array to list of ColumnInterface fill by ActionInterface
     * @param array $params
     * @return ColumnInterface[]
     */
    public function hydrate($params);

}
