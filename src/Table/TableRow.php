<?php 

namespace erguncaner\Table;

class TableRow
{
    protected $table = null;

    protected $cells;

    protected $attributes;

    public function __construct($cells, $attributes = [])
    {
        $this->cells = $cells;
        $this->attributes = $attributes;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function addCell($cell)
    {
        $cell->setRow($this);

        $this->cells[] = $cell;
    }

    public function html()
    {
        $html = "   <tr".Attribute::str($this->attributes).">";

        // if table ref is set
        if ($this->table){
            $columns = $this->table->getColumns();
            foreach($columns as $colKey => $col){
                $html .= isset($this->cells[$colKey]) ? $this->cells[$colKey]->html() : '';
            }
        // There is no ref for parent table
        } else {
            foreach($this->cells as $cell){
                $html .= $cell->html();
            }
        }

        $html .= "</tr>";

        return $html;
    }
}