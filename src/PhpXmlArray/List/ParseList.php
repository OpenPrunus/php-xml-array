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
                if (isset($element["_attributes"])) {
                    foreach ($element['_attributes'] as $name => $value) {
                        $attributes .= $name . "=\"" . $value . "\" ";
                    }
                    if (isset($element["_value"])) {
                        $subElement = $element["_value"];
                        if (is_array($element["_value"])) {
                            $subElement = $this->convertArrayToXml($element["_value"]);
                        }

                        if (is_string($key)) {
                            $str .= sprintf("<%s%s>%s</%s>", $key, rtrim($attributes), $subElement, $key);
                        } else {
                            $str .= $subElement;
                        }
                    } else {
                        $str .= sprintf("<%s%s />", $key, rtrim($attributes));
                    }
                } else {
                    $child = $this->convertArrayToXml($element);
                    if (is_string($key)) {
                        $str .= sprintf("<%s>%s</%s>", $key, $child, $key);
                    } else {
                        $str .= $child;
                    }
                }
            } else {
                if (is_string($key)) {
                    $str .= sprintf("<%s>%s</%s>", $key, $element, $key);
                } else {
                    $str .= sprintf("<%s />", $element);
                }
            }
        }

        return $str;
    }
}
