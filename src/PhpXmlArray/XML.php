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

    /** @var \SimpleXMLElement */
    protected $simpleXmlElement = null;

    /** @var string */
    protected $xml = "";

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parseList = new ParseList();
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public function xmlFromArray(array $array, $indented = false)
    {
        $this->xml = $this->parseList->convertArrayToXml($array);

        if ($indented) {
            $this->simpleXmlElement = new \SimpleXMLElement($this->xml);
            $dom = dom_import_simplexml($this->simpleXmlElement)->ownerDocument;
            $dom->formatOutput = true;
            $this->xml = $dom->saveXML();
        }

        return $this->xml;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getSimpleXmlElement()
    {
        return $this->simpleXmlElement;
    }

    /**
     * @param ParseList $parseList
     *
     * @return XML
     */
    public function setParseList(ParseList $parseList)
    {
        $this->parseList = $parseList;

        return $this;
    }
}
