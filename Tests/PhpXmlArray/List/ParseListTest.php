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
        $array1 = [
            "Root" => [
                ["Niveau1" => "value1"],
                ["Niveau1" => "value2"],
                ["Niveau1" => "value3"],
                "Test" => "value2",
                "TestAvecAttribut" => [
                    "Attributes" => [
                        "foo" => "bar"
                    ],
                    "Value" => "value :)"
                ],
                [
                    "Toto" => [
                        "Niveau2" => "valueNiveau2"
                    ]
                ],
                [
                    "Toto" => [
                        "Niveau2" => "valueNiveau2",
                        "NiveauIdem" => 4
                    ]
                ]
            ]
        ];

        $expectedXml1 = "<Root><Niveau1>value1</Niveau1><Niveau1>value2</Niveau1><Niveau1>value3</Niveau1><Test>value2</Test><TestAvecAttribut foo=\"bar\">value :)</TestAvecAttribut><Toto><Niveau2>valueNiveau2</Niveau2></Toto><Toto><Niveau2>valueNiveau2</Niveau2><NiveauIdem>4</NiveauIdem></Toto></Root>";

        $this->assertEquals($expectedXml1, $this->parseList->convertArrayToXml($array1));

        $array2 = [
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

        $expectedXml2 = "<Root><Niveau1><Niveau2><Niveau3>test</Niveau3></Niveau2></Niveau1></Root>";

        $this->assertEquals($expectedXml2, $this->parseList->convertArrayToXml($array2));

        $array3 = [
            "Root" => [
                [
                    "Niveau1" => "value"
                ],
                [
                    "Niveau1" => [
                        [
                            "Niveau2" => "niveau 2 value"
                        ],
                        [
                            "Niveau2" => [
                                "Attributes" => [
                                    "attrbidule" => "toto"
                                ],
                                "Value" => "value de niveau 2"
                            ]
                        ],
                        "AutreBalise" => "valeur"
                    ]
                ],
                [
                    "Niveau1" => [
                        "Attributes" => [
                            "attrNiveau1" => "titi"
                        ],
                        "Value" => "value"
                    ]
                ]
            ]
        ];

        $expectedXml3 = "<Root><Niveau1>value</Niveau1><Niveau1><Niveau2>niveau 2 value</Niveau2><Niveau2 attrbidule=\"toto\">value de niveau 2</Niveau2><AutreBalise>valeur</AutreBalise></Niveau1><Niveau1 attrNiveau1=\"titi\">value</Niveau1></Root>";

        $this->assertEquals($expectedXml3, $this->parseList->convertArrayToXml($array3));
    }
}
