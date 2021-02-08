<?php 
/*
 * This file is part of the erguncaner/table.
 * (c) Caner Ergün <erguncaner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace erguncaner\Table;

/**
 * Main Table class, you can add columns and rows to it
 * 
 * @author Caner Ergün <erguncaner@gmail.com>
 */
class Table
{
    /**
     * Table tag attributes
     * 
     * @var array
     */
    protected $attributes = [];

    /**
     * Table columns
     * 
     * @var array
     */
    protected $columns = [];

    /**
     * Table rows
     * 
     * @var array
     */
    protected $rows = [];

    /**
     * Table data
     * 
     * @var array
     */
    protected $data = [];

    /**
     * Constructor
     * 
     * @param arary $attributes
     */
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Adds a new Column
     * 
     * @param string $name
     * @param TableColumn $column
     */
    public function addColumn($name, TableColumn $column)
    {
        $this->columns[$name] = $column;
    }

    /**
     * Returns columns array
     * 
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Adds a new Row
     * 
     * @param TableRow $row
     */
    public function addRow(TableRow $row)
    {
        $row->setTable($this);

        $this->rows[] = $row;
    }

    /**
     * Returns rows
     * 
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Generates html
     * 
     * @return string
     */
    public function html()
    {
        $html  = "\n<table".Attribute::str($this->attributes).">\n";
        $html .= $this->headHtml();
        $html .= $this->bodyHtml();
        $html .= $this->footHtml();
        $html .= "</table>\n";

        return $html;
    }

    /**
     * Returns table information as an array
     * 
     * @return array
     */
    public function array()
    {
        $data = [
            'attributes' => $this->attributes,            
        ];

        foreach($this->columns as $name => $column) {
            $data['columns'][$name] = $column->array();
        }

        foreach($this->rows as $row) {
            $data['rows'][] = $row->array();
        }

        return $data;
    }

    /**
     * Generates thead html
     * 
     * @return string
     */
    public function headHtml()
    {
        $html = "<thead>\n    <tr>";        
        foreach($this->columns as $col){
            $html .= $col->html();
        }
        $html .= "</tr>\n</thead>\n";

        return $html;
    }
    
    /**
     * Generates tbody html
     * 
     * @return string
     */
    public function bodyHtml()
    {
        $html = "<tbody>\n";
        foreach($this->rows as $row){
            $html .= $row->html()."\n";
        }
        $html .= "</tbody>\n";

        return $html;
    }

    /**
     * Generates tfoot html
     * 
     * @return string
     */
    public function footHtml()
    {
        return "<tfoot></tfoot>\n";
    }
}