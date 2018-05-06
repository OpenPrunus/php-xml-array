<?php

namespace PhpXmlArray;

/**
 * ParseList class
 */
class ParseList
{
    /**
     * @param array $array
     *
     * @return string
     */
    public function convertArrayToXml(array $array)
    {
        $str = "";
        $child = "";
        $attributes = " ";

        foreach ($array as $key => $element) {
            if (is_array($element)) {
                if (isset($element["Attributes"]) && isset($element['Value'])) {
                    foreach ($element['Attributes'] as $name => $value) {
                        $attributes .= $name . "=\"" . $value . "\" ";
                    }
                    if (!is_numeric($key)) {
                        $str .= sprintf("<%s%s>%s</%s>", $key, rtrim($attributes), $element["Value"], $key);
                    }
                } else {
                    $child = $this->convertArrayToXml($element);
                    if (!is_numeric($key)) {
                        $str .= sprintf("<%s>%s</%s>", $key, $child, $key);
                    } else {
                        $str .= $child;
                    }
                }
            } else {
                if (!is_numeric($key)) {
                    $str .= sprintf("<%s>%s</%s>", $key, $element, $key);
                }
            }
        }

        return $str;
    }
}
