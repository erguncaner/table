<?php 

namespace erguncaner\Table;

class TableColumn
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
        return "<th".Attribute::str($this->attributes).">".$this->content."</th>";
    }
}
