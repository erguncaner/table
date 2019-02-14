<?php 

namespace Table;

class TableRow
{
    protected $cells;

    protected $attributes;

    public function __construct($cells, $attributes = [])
    {
        $this->cells = $cells;
        $this->attributes = $attributes;
    }

    public function html()
    {
        

        $html = "\t<tr".Attribute::str($this->attributes).">";

        foreach($this->cells as $cell){
            $html .= $cell->html();
        }

        $html .= "</tr>";

        return $html;
    }
}