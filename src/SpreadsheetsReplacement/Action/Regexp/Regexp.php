<?php

namespace SpreadsheetsReplacement\Action\Regexp;

use SpreadsheetsReplacement\Action\Action;

/**
 * Action to modify column's value with preg_replace.
 *
 * @author florian
 */
class Regexp extends Action implements RegexpInterface {

    private $pattern;

    private $replacement;

    public function __construct($pattern = null, $replacement = null) {
        $this->pattern = $pattern;
        $this->replacement = $replacement;
    }

    /**
     * {@inheritDoc}
     */
    public function getPattern() {
        return $this->pattern;
    }

    /**
     * Modify the pattern.
     * @param string $pattern the pattern.
     */
    public function setPattern($pattern) {
        $this->pattern = $pattern;
    }

    /**
     * {@inheritDoc}
     */
    public function getReplacement() {
        return $this->replacement;
    }

    /**
     * Modify the replacement.
     * @param string $replacement the replacement
     */
    public function setReplacement($replacement) {
        $this->replacement = $replacement;
    }

    /**
     * {@inheritDoc}
     */
    public function replace($value) {
        return preg_replace($this->getPattern(), $this->getReplacement(), $value);
    }

}
