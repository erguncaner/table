<?php 

namespace Table;

class TableColumn
{
    protected $label;

    protected $attributes;

    protected $params;

    public function __construct($params = [])
    {
        $this->label = isset($params['label']) ? $params['label'] : null;
    }

    public function html()
    {
        return '<th>'.$this->label.'</th>';
    }
}
