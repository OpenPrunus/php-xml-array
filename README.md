# PHP XML Array library

This library convert an array to an XML DOM.

## Add to your composer.json in your project

```

composer require openprunus/php-xml-array

```

## Usage

### Code example
```php

use \PhpXmlArray\XML;

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
                        "_attributes" => [
                            "attrbidule" => "toto"
                        ],
                        "_value" => "value de Level 2"
                    ]
                ],
                "AutreBalise" => "valeur"
            ]
        ],
        [
            "Level1" => [
                "_attributes" => [
                    "attrLevel1" => "titi"
                ],
                "_value" => "value"
            ]
        ]
    ]
];

$xmlInstance = new Xml();

// For unformatted XML
$unformattedConvertedXmlToArray = $xmlInstance->xmlFromArray($array);

// For formatted XML
$formattedConvertedXmlToArray = $xmlInstance->xmlFromArray($array, true);

```

### Results

```
$unformattedConvertedXmlToArray =

<Root><Level1>value</Level1><Level1><Level2>Level 2 value</Level2><Level2 attrbidule=\"toto\">value de Level 2</Level2><AutreBalise>valeur</AutreBalise></Level1><Level1 attrLevel1=\"titi\">value</Level1></Root>


$formattedConvertedXmlToArray =

<?xml version="1.0"?>
<Root>
  <Level1>value</Level1>
  <Level1>
    <Level2>Level 2 value</Level2>
    <Level2 attrbidule="toto">value de Level 2</Level2>
    <AutreBalise>valeur</AutreBalise>
  </Level1>
  <Level1 attrLevel1="titi">value</Level1>
</Root>

```

## Others array examples

```php

$array1 = [
    "Name" => "Doe",
    "FirstName" => "John",
    "Age" => 30
];

/*
<Name>Doe</Name>
<FirstName>John</FirstName>
<Age>30</Age>
*/

$array2 = [
    "Root" => [
        "Name" => "Doe",
        "FirstNames" => [
            "_attributes" => [
                    "foo" => "bar"
            ],
            "_value" => [
                ["FirstName" => "Toto"],
                ["FirstName" => "Titi"],
                ["FirstName" => "Tata"]
            ]
        ],
        "Ages" => [
            "Age1" => 30,
            "Age2" => 31,
            "Age3" => 32
        ]
    ]
];
/*
<Root>
    <Name>Doe</Name>
    <FisrtNames foo="bar">
        <FirstName>Toto</FirstName>
        <FirstName>Titi</FirstName>
        <FirstName>Tata</FirstName>
    </FirstNames
    <Ages>
        <Age1>30</Age1>
        <Age2>31</Age2>
        <Age3>32</Age3>
    </Ages>
</Root>
*/

$array3 = [
    "Root" => [
        "_attributes" => [
            "test" => "value"
        ],
        "_value" => [
            "Level1" => [
                "Level2" => [
                    "Level3" => "test"
                ]
            ]
        ]
    ]
];

/*
<Root test="value">
    <Level1>
        <Level2>
            <Level3>test</Level3>
        </Level2>
    </Level1>
</Root>
*/

$array4 = [
    "Root" => [
        "Alone"
    ]
];

/*
<Root>
    <Alone />
</Root>
*/

```
