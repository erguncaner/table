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
 * Cell of a table row
 * 
 * @author Caner Ergün <erguncaner@gmail.com>
 */
class TableCell
{
    /**
     * Parent row reference
     * 
     * @var TableRow
     */
    protected $row = null;
    
    /**
     * Content of cell
     * 
     * @var string
     */
    protected $content;

    /**
     * Attributes of td element
     * 
     * @var array
     */
    protected $attributes;

    /**
     * Class constructor
     * 
     * @param string $content
     * @param array $attributes
     */
    public function __construct($content, $attributes = [])
    {
        $this->content = $content;
        $this->attributes = $attributes;
    }

    /**
     * Sets parent TableRow
     * 
     * @param TableRow $row
     */
    public function setRow(TableRow $row)
    {
        $this->row = $row;
    }

    /**
     * Returns row html
     * 
     * @return string
     */
    public function html()
    {
        return '<td'.Attribute::str($this->attributes).'>'.$this->content.'</td>';
    }

    /**
     * Returns cell as an array
     * 
     * @return array
     */
    public function array()
    {
        return [
            'content' => $this->content,
            'attributes' => $this->attributes
        ];
    }
}