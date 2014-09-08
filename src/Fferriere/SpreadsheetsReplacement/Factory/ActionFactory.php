<?php

namespace Fferriere\SpreadsheetsReplacement\Factory;

use Fferriere\SpreadsheetsReplacement\Action;

/**
 * Description of ActionFactory
 *
 * @author florian
 */
class ActionFactory implements FactoryInterface {

    /**
     * Creates a new instance of ActionInterface.
     * @param string $name name of the new instance
     * @return ActionInterface new instance
     */
    public function create($name) {
        $name = strtolower((string)$name);
        switch ($name) {

            case 'concat':
                return new Action\Concat();

            case 'copy':
                return new Action\Copy();

            case 'fullreplace':
                return new Action\FullReplace();

            case 'strreplace':
                return new Action\StrReplace();

            case 'regexp':
                return new Action\Regexp\Regexp();

            default :
                throw new \Fferriere\SpreadsheetsReplacement\Exception\FactoryException('Can\'t create Action : ' . $name);
        }
    }

}
