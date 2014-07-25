<?php

namespace SpreadsheetsReplacement\Action;

/**
 * Description of StrReplace
 *
 * @author florian
 */
class StrReplace extends FullReplace {

    /**
     * {@inheritDoc}
     */
    public function replace($value) {
        return str_replace($this->search, $this->replace, $value);
    }

}
