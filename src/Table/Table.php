<?php 

namespace Table;

class Table
{
    protected $attributes = [];

    protected $columns = [];

    protected $rows = [];

    protected $data = [];

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;

        $this->initData();
        $this->initColumns();
        $this->initRows();
    }
    
    protected function initColumns()
    {

    }

    protected function initRows()
    {
        
    }

    protected function initData()
    {
        
    }

    public function columns()
    {
        return $this->columns;
    }

    public function rows()
    {
        return $this->rows;
    }

    public function addColumn($name, TableColumn $column)
    {
        $this->columns[$name] = $column;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addRow(TableRow $row)
    {
        $row->setTable($this);

        $this->rows[] = $row;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function html()
    {
        $html  = "\n<table".Attribute::str($this->attributes).">\n";
        $html .= $this->headHtml();
        $html .= $this->bodyHtml();
        $html .= $this->footHtml();
        $html .= "</table>\n";

        return $html;
    }

    public function headHtml()
    {
        $html = "<thead>\n    <tr>";        
        foreach($this->columns as $col){
            $html .= $col->html();
        }
        $html .= "</tr>\n</thead>\n";

        return $html;
    }
    
    public function bodyHtml()
    {
        $html = "<tbody>\n";
        foreach($this->rows as $row){
            $html .= $row->html()."\n";
        }
        $html .= "</tbody>\n";

        return $html;
    }

    public function footHtml()
    {
        return "<tfoot></tfoot>\n";
    }
}