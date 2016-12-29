<?php

namespace Box\Spout\Reader\CSV;

use Box\Spout\Reader\IteratorInterface;

/**
 * Class SheetIterator
 * Iterate over CSV unique "sheet".
 *
 * @package Box\Spout\Reader\CSV
 */
class SheetIterator implements IteratorInterface
{
    /** @var \Box\Spout\Reader\CSV\Sheet The CSV unique "sheet" */
    protected $sheet;

    /** @var bool Whether the unique "sheet" has already been read */
    protected $hasReadUniqueSheet = false;

    /**
     * @param resource $filePointer
     * @param string $fieldDelimiter Character that delimits fields
     * @param string $fieldEnclosure Character that enclose fields
     * @param string $encoding Encoding of the CSV file to be read
     * @param \Box\Spout\Common\Helper\GlobalFunctionsHelper $globalFunctionsHelper
     */
    public function __construct($filePointer, $fieldDelimiter, $fieldEnclosure, $encoding, $endOfLineCharacter, $globalFunctionsHelper)
    {
        $this->sheet = new Sheet($filePointer, $fieldDelimiter, $fieldEnclosure, $encoding, $endOfLineCharacter, $globalFunctionsHelper);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     *
     * @return void
     */
    public function rewind()
    {
        $this->hasReadUniqueSheet = false;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.p