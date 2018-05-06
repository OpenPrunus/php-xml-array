<?php

namespace PhpXmlArray;

use \PhpXmlArray\ParseList;

/**
 * XML class
 */
class XML
{
    /** @var ParseList */
    protected $parseList;

    /** @var string */
    protected $xml;

    /**
     * Constructor
     */
    public function __ construct()
    {
        $this->parseList = new ParseList();
        $this->xml = "";
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public function xmlFromArray(array $array)
    {
        $this->xml = $this->parseList->convertArrayToXml($array);

        return $this->xml;
    }

    /**
     * @return string
     */
    public function getXml()
    {
        return $this->xml;
    }
}
