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
 * Table row class
 * 
 * @author Caner Ergün <erguncaner@gmail.com>
 */
class TableRow
{
    /**
     * References to parent Table class
     * 
     * @var Table
     */
    protected $table = null;

    /**
     * Row cells
     * 
     * @var array
     */
    protected $cells;

    /**
     * Row tr element attributes
     * 
     * @var array
     */
    protected $attributes;

    /**
     * Class constructor
     * 
     * @param array $cells
     * @param array $attributes
     */
    public function __construct($cells, $attributes = [])
    {
        $this->cells = $cells;
        $this->attributes = $attributes;
    }

    /**
     * Sets parent Table reference
     * 
     * @param Table $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * Adds a new cell to row
     * 
     * @param TableCell $cell
     */
    public function addCell(TableCell $cell)
    {
        $cell->setRow($this);

        $this->cells[] = $cell;
    }

    /**
     * Returns html of row
     * 
     * @return string
     */
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