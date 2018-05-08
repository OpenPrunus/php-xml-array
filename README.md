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

$xmlInstance = new Xml();

// For unformatted XML
$unformattedConvertedXmlToArray = $xml->xmlFromArray($array);

// For formatted XML
$formattedConvertedXmlToArray = $xml->xmlFromArray($array, true);


```

### Results

```
$unformattedConvertedXmlToArray =

<Root><Niveau1>value</Niveau1><Niveau1><Niveau2>niveau 2 value</Niveau2><Niveau2 attrbidule=\"toto\">value de niveau 2</Niveau2><AutreBalise>valeur</AutreBalise></Niveau1><Niveau1 attrNiveau1=\"titi\">value</Niveau1></Root>


$formattedConvertedXmlToArray =

<?xml version="1.0"?>
<Root>
  <Niveau1>value</Niveau1>
  <Niveau1>
    <Niveau2>niveau 2 value</Niveau2>
    <Niveau2 attrbidule="toto">value de niveau 2</Niveau2>
    <AutreBalise>valeur</AutreBalise>
  </Niveau1>
  <Niveau1 attrNiveau1="titi">value</Niveau1>
</Root>

```
