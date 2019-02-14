<?php 

namespace Table;

class TableCell
{
    protected $content;

    protected $attributes;

    public function __construct($content, $attributes = [])
    {
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function html()
    {
        return '<td'.Attribute::str($this->attributes).'>'.$this->content.'</td>';
    }
}