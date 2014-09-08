<?php

namespace Fferriere\SpreadsheetsReplacement\Factory;

/**
 *
 * @author florian
 */
interface FactoryInterface {

    /**
     * Create a new instance.
     * @param string $name the name for the new instance
     * @return mixed the new instance
     */
    public function create($name);

}
