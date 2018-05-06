<?php

namespace PhpXmlArray\Array;

/**
 * ParseArray class
 */
class ParseArray
{
    /** @var array */
    protected $array;

    /** @var array */
    protected $elements

    /** @var array */
    protected $attributes;

    /**
     * ParseArray constructor
     */
    public function construct()
    {
        $this->array = [];
        $this->elements = [];
        $this->attributes = [];
    }

    public function parse(array $array)
    {
        $this->array = $array;
    }
}
