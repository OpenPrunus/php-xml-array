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
]

$array2 = [
    "Root" => [
        "Name" => "Doe",
        "FirstNames" => [
            "Attributes" => [
                    "foo" => "bar"
            ],
            "Value" => [
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
]

```
