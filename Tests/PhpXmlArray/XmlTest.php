<?php

namespace Tests\PhpXmlArray;

use PHPUnit\Framework\TestCase;
use \PhpXmlArray\XML;
use \PhpXmlArray\ParseList;

/**
 * FactoryTest unit class
 */
class XmlTest extends TestCase
{
    /**
     * Initialisation tests
     */
    public function setUp()
    {
        $this->xml = new XML();

        $this->parseList = $this->getMockBuilder(ParseList::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();

        $this->xml->setParseList($this->parseList);
    }

    /**
     * Test unformatted XML parse array
     */
    public function testUnformattedParseList()
    {
        $xml = "<Root><Niveau1><Niveau2><Niveau3>test</Niveau3></Niveau2></Niveau1></Root>";
        $array = [
            "Root" => [
                [
                    "Niveau1" => [
                        "Niveau2" => [
                            "Niveau3" => "test"
                        ]
                    ]
                ]
            ]
        ];
        $this->parseList->method('convertArrayToXml')->willReturn($xml);

        $this->assertXmlStringEqualsXmlString($xml, $this->xml->xmlFromArray($array));
    }

    /**
     * Test formatted XML parse array
     */
    public function testFormattedParseList()
    {
        $xml = "<Root><Niveau1><Niveau2><Niveau3>test</Niveau3></Niveau2></Niveau1></Root>";

        $xmlExpected = "<?xml version=\"1.0\"?>
<Root>
    <Niveau1>
        <Niveau2>
            <Niveau3>test</Niveau3>
        </Niveau2>
    </Niveau1>
</Root>";

        $array = [
            "Root" => [
                [
                    "Niveau1" => [
                        "Niveau2" => [
                            "Niveau3" => "test"
                        ]
                    ]
                ]
            ]
        ];
        
        $this->parseList->method('convertArrayToXml')->willReturn($xml);

        $this->assertXmlStringEqualsXmlString($xmlExpected, $this->xml->xmlFromArray($array, true));
    }

    /**
     * Test if a SimpleXMLElement instance or null returned
     */
    public function testGetSimpleXmlElement()
    {
        $this->assertNull($this->xml->getSimpleXmlElement());

        $xml = "<Root><Niveau1><Niveau2><Niveau3>test</Niveau3></Niveau2></Niveau1></Root>";

        $array = [
            "Root" => [
                [
                    "Niveau1" => [
                        "Niveau2" => [
                            "Niveau3" => "test"
                        ]
                    ]
                ]
            ]
        ];
        $this->parseList->method('convertArrayToXml')->willReturn($xml);
        $this->xml->xmlFromArray($array, true);
        $this->assertInstanceOf(\SimpleXMLElement::class, $this->xml->getSimpleXmlElement());
    }
}
