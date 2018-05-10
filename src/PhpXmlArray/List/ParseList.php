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
                if (isset($element["Attributes"])) {
                    foreach ($element['Attributes'] as $name => $value) {
                        $attributes .= $name . "=\"" . $value . "\" ";
                    }
                    if (isset($element["Value"])) {
                        $subElement = $element["Value"];
                        if (is_array($element["Value"])) {
                            $subElement = $this->convertArrayToXml($element["Value"]);
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
