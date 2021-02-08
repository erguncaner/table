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
 * Table column class
 * 
 * @author Caner Ergün <erguncaner@gmail.com>
 */
class TableColumn
{
    /**
     * Content of column
     * 
     * @var string
     */
    protected $content;

    /**
     * Attributes of th element
     * 
     * @param array
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
     * Returns html of row
     * 
     * @return string
     */
    public function html()
    {
        return "<th".Attribute::str($this->attributes).">".$this->content."</th>";
    }

    /**
     * Returns column as an array
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
