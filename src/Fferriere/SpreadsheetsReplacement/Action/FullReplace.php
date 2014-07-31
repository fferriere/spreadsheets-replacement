<?php

namespace Fferriere\SpreadsheetsReplacement\Action;

/**
 * Description of FullReplace
 *
 * @author florian
 */
class FullReplace extends Action {

    protected $search;

    protected $replace;

    public function __construct($search = null, $replacement = null) {
        $this->search = $search;
        $this->replace = $replacement;
    }

    /**
     * Returns the search element.
     * @return string
     */
    public function getSearch() {
        return $this->search;
    }

    /**
     * Modify the search element.
     * @param string $search
     */
    public function setSearch($search) {
        $this->search = $search;
    }

    /**
     * Returns the replace element.
     * @return string
     */
    public function getReplace() {
        return $this->replace;
    }

    /**
     * Modify the replace element
     * @param string $replace
     */
    public function setReplace($replace) {
        $this->replace = $replace;
    }

    /**
     * {@inheritDoc}
     */
    public function replace($value) {
        if ($value == $this->search) {
            return $this->replace;
        }
        return $value;
    }

}
