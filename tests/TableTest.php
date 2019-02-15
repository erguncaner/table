<?php

use PHPUnit\Framework\TestCase;
use Table\Table;
use Table\TableColumn;
use Table\TableCell;
use Table\TableRow;
use Table\Attribute;

class TableTest extends TestCase
{
    private $data;

    public function setUp()
    {
        $this->data = [
            ['id' => 1, 'title' => 'A'],
            ['id' => 2, 'title' => 'B'],
            ['id' => 3, 'title' => 'C'],
            ['id' => 4, 'title' => 'D'],
        ];
    }

    public function testAttributes()
    {
        $attrs = ['class'=>'active', 'id'=>'item-1'];
        $str = Attribute::str($attrs);

        $this->assertEquals($str, ' class="active" id="item-1"');
    }

    public function testRowsAndCells()
    {
        $cells = [
            new TableCell('1'),
            new TableCell('Title', ['class'=>'title']),
        ];

        $row = new TableRow($cells, ['class'=>'active']);

        $this->assertEquals($row->html(), "\t<tr class=\"active\"><td>1</td><td class=\"title\">Title</td></tr>");
    }

    public function testTable()
    {
        $table = new Table();
        
        $table->addColumn('id', new TableColumn(['label'=>'ID']));
        $table->addColumn('title', new TableColumn(['label'=>'TITLE']));

        foreach($this->data as $row){

            $cells = [
                'title' => new TableCell($row['title']),
                'id' => new TableCell($row['id']),                
            ];

            $table->addRow(new TableRow($cells));
        }

        echo $table->html();
    }
}