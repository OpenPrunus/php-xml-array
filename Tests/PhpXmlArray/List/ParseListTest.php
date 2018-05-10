<?php

namespace Tests\PhpXmlArray;

use PHPUnit\Framework\TestCase;
use \PhpXmlArray\ParseList;

/**
 * FactoryTest unit class
 */
class ParseArrayTest extends TestCase
{
    /**
     * Initialisation method
     */
    public function setUp()
    {
        $this->parseList = new ParseList();
    }

    /**
     * test convert array to xml DOM
     */
    public function testConvertArrayToXml()
    {
        $array = [
            "Root" => [
                ["Level1" => "value1"],
                ["Level1" => "value2"],
                ["Level1" => "value3"],
                "Test" => "value2",
                "TestAvecAttribut" => [
                    "Attributes" => [
                        "foo" => "bar"
                    ],
                    "Value" => "value :)"
                ],
                [
                    "Toto" => [
                        "Level2" => "valueLevel2"
                    ]
                ],
                [
                    "Toto" => [
                        "Level2" => "valueLevel2",
                        "LevelIdem" => 4
                    ]
                ]
            ]
        ];

        $expectedXml = "<Root><Level1>value1</Level1><Level1>value2</Level1><Level1>value3</Level1><Test>value2</Test><TestAvecAttribut foo=\"bar\">value :)</TestAvecAttribut><Toto><Level2>valueLevel2</Level2></Toto><Toto><Level2>valueLevel2</Level2><LevelIdem>4</LevelIdem></Toto></Root>";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));

        $array = [
            "Root" => [
                [
                    "Level1" => [
                        "Level2" => [
                            "Level3" => "test"
                        ]
                    ]
                ]
            ]
        ];

        $expectedXml = "<Root><Level1><Level2><Level3>test</Level3></Level2></Level1></Root>";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));

        $array = [
            "Root" => [
                [
                    "Level1" => "value"
                ],
                [
                    "Level1" => [
                        [
                            "Level2" => "Level 2 value"
                        ],
                        [
                            "Level2" => [
                                "Attributes" => [
                                    "attrbidule" => "toto"
                                ],
                                "Value" => "value de Level 2"
                            ]
                        ],
                        "AutreBalise" => "valeur"
                    ]
                ],
                [
                    "Level1" => [
                        "Attributes" => [
                            "attrLevel1" => "titi"
                        ],
                        "Value" => "value"
                    ]
                ]
            ]
        ];

        $expectedXml = "<Root><Level1>value</Level1><Level1><Level2>Level 2 value</Level2><Level2 attrbidule=\"toto\">value de Level 2</Level2><AutreBalise>valeur</AutreBalise></Level1><Level1 attrLevel1=\"titi\">value</Level1></Root>";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));

        $array = [
            "Root" => [
                "Attributes" => [
                    "test" => "value"
                ],
                "Value" => [
                    "Level1" => [
                        "Level2" => [
                            "Level3" => "test"
                        ]
                    ]
                ]
            ]
        ];

        $expectedXml = "<Root test=\"value\"><Level1><Level2><Level3>test</Level3></Level2></Level1></Root>";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));

        $array = [
            "Root" => [
                "Attributes" => [
                    "test" => "value"
                ]
            ]
        ];

        $expectedXml = "<Root test=\"value\" />";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));

        $array = [
            "Root" => [
                "Alone"
            ]
        ];

        $expectedXml = "<Root><Alone /></Root>";

        $this->assertXmlStringEqualsXmlString($expectedXml, $this->parseList->convertArrayToXml($array));
    }
}
