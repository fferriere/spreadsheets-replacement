<?php

namespace Fferriere\SpreadsheetsReplacement\Sheet;

/**
 * Description of CsvSheet
 *
 * @author florian
 */
class CsvSheet extends Sheet {

    private $readFilepath;

    private $writeFilepath;

    private $readFileHandle;

    private $writeFileHandle;

    protected $csvReadLength = 1024;
    protected $csvReadSeparator = ',';
    protected $csvReadEnclosure = '"';
    protected $csvReadEscape = '\\';

    protected $csvWriteDelimiter = ';';
    protected $csvWriteEnclosure = '"';

    public function __construct($readFilepath = null) {
        parent::__construct();
        $this->readFilepath = $readFilepath;
    }

    /**
     * Returns the path of readed file.
     * @return string the path
     */
    public function getReadFilepath() {
        return $this->readFilepath;
    }

    /**
     * Changes the read file's path.
     * @param string $readFilePath the path
     */
    public function setReadFilePath($readFilePath) {
        $this->readFilepath = (string) $readFilePath;
    }

    /**
     * Returne the path of writed file.
     * @return string the path
     */
    public function getWriteFilepath() {
        return $this->writeFilepath;
    }

    /**
     * Initialize the write filepath with add -result before file extension.
     */
    private function initWriteFilePath() {
        if (!is_file($this->readFilepath)) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\FileNotFoundException($this->readFilepath . ' not found');
        }
        $parts = pathinfo($this->readFilepath);
        $this->writeFilepath = $parts['dirname'] . DIRECTORY_SEPARATOR
                             . $parts['filename'] . '-result.'
                             . $parts['extension'];
    }

    /**
     * Returns the max length of a csv line read.
     * Default value is 1024.
     * @return int the length
     */
    public function getCsvReadLength() {
        return $this->csvReadLength;
    }

    /**
     * Modify the max length of a csv line read.
     * @param type $csvReadLength
     */
    public function setCsvReadLength($csvReadLength) {
        $this->csvReadLength = (string) $csvReadLength;
    }

    /**
     * Returns the separator of csv line read.
     * Default value is ','.
     * @return string separator
     */
    public function getCsvReadSeparator() {
        return $this->csvReadSeparator;
    }

    /**
     * Modify the separator for the csv line readed.
     * @param string $csvReadSeparator the separator
     */
    public function setCsvReadSeparator($csvReadSeparator) {
        $this->csvReadSeparator = (string) $csvReadSeparator;
    }

    /**
     * Returns the string encolure for the csv readed line.
     * Default value is '"'.
     * @return string enclosure
     */
    public function getCsvReadEnclosure() {
        return $this->csvReadEnclosure;
    }

    /**
     * Modify the string enclosure for the csv readed line.
     * @param string $csvReadEnclosure enclosure
     */
    public function setCsvReadEnclosure($csvReadEnclosure) {
        $this->csvReadEnclosure = (string) $csvReadEnclosure;
    }

    /**
     * Returns the escape character for the csv readed line.
     * Default value is '\\'.
     * @return string escape
     */
    public function getCsvReadEscape() {
        return $this->csvReadEscape;
    }

    /**
     * Modify the escape character for the csv readed line.
     * @param string $csvReadEscape escape
     */
    public function setCsvReadEscape($csvReadEscape) {
        $this->csvReadEscape = (string) $csvReadEscape;
    }

    /**
     * Returns the delimiter for the csv writed.
     * Default value is ';'.
     * @return string delimiter
     */
    public function getCsvWriteDelimiter() {
        return $this->csvWriteDelimiter;
    }

    /**
     * Modify the delimiter for the csv writed.
     * @param string $csvWriteDelimiter delimiter
     */
    public function setCsvWriteDelimiter($csvWriteDelimiter) {
        $this->csvWriteDelimiter = (string) $csvWriteDelimiter;
    }

    /**
     * Returns string enclosure for the csv writed.
     * Default value is '"'.
     * @return string enclosure
     */
    public function getCsvWriteEnclosure() {
        return $this->csvWriteEnclosure;
    }

    /**
     * Modify string enclosure for the csv writed.
     * @param string $csvWriteEnclosure enclosure
     */
    public function setCsvWriteEnclosure($csvWriteEnclosure) {
        $this->csvWriteEnclosure = (string) $csvWriteEnclosure;
    }

    /**
     * Open files.
     */
    public function open() {
        $this->openRead();
        $this->openWrite();
    }

    /**
     * Open readed file.
     * @throws \Fferriere\SpreadsheetsReplacement\Exception\FileNotFoundException if file not found
     */
    protected function openRead() {
        if (!is_file($this->readFilepath)) {
            throw new \Fferriere\SpreadsheetsReplacement\Exception\FileNotFoundException($this->readFilepath . ' not found');
        }
        $this->readFileHandle = fopen($this->readFilepath, 'r');
    }

    /**
     * Open writed file.
     */
    protected function openWrite() {
        $this->initWriteFilePath();
        $this->writeFileHandle = fopen($this->writeFilepath, 'w');
    }

    /**
     * Close files.
     */
    public function close() {
        $this->closeRead();
        $this->closeWrite();
    }

    /**
     * Close readed file.
     */
    protected function closeRead() {
        if (is_resource($this->readFileHandle)) {
            fclose ($this->readFileHandle);
        }
    }

    /**
     * Close writed file.
     */
    protected function closeWrite() {
        if (is_resource($this->writeFileHandle)) {
            fclose ($this->writeFileHandle);
        }
    }

    /**
     * Read one row from readed CSV file with fgetcsv.
     * @return array row
     */
    public function readOneRow() {
        return fgetcsv($this->readFileHandle,
                    $this->getCsvReadLength(),
                    $this->getCsvReadSeparator(),
                    $this->getCsvReadEnclosure(),
                    $this->getCsvReadEscape()
                );
    }

    /**
     * Write one row to write CSV file with fputcsv.
     * @param array $row the row.
     * @return int the length of the written string or FALSE on failure.
     */
    public function writeOneRow($row) {
        return fputcsv($this->writeFileHandle,
                    $row,
                    $this->getCsvWriteDelimiter(),
                    $this->getCsvWriteEnclosure()
                );
    }

}
