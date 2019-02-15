<?php

use PHPUnit\Framework\TestCase;
use erguncaner\Table\Table;
use erguncaner\Table\TableColumn;
use erguncaner\Table\TableCell;
use erguncaner\Table\TableRow;
use erguncaner\Table\Attribute;

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

        $this->assertEquals(' class="active" id="item-1"', $str);
    }

    public function testRowsAndCells()
    {
        $cells = [
            new TableCell('1'),
            new TableCell('Title', ['class'=>'title']),
        ];

        $row = new TableRow($cells, ['class'=>'active']);

        $this->assertEquals("   <tr class=\"active\"><td>1</td><td class=\"title\">Title</td></tr>", $row->html());
    }

    public function testTableHtml()
    {
        $table = new Table([
            'id' => 'post-table',
            'class' => 'table table-striped'
        ]);
        
        $table->addColumn('id', new TableColumn(['label'=>'ID']));
        $table->addColumn('title', new TableColumn(['label'=>'TITLE']));

        foreach($this->data as $row){

            $cells = [
                'title' => new TableCell($row['title']),
                'id' => new TableCell($row['id']),                
            ];

            $attrs = [
                'id' => 'row-'.$row['id']
            ];

            $table->addRow(new TableRow($cells, $attrs));
        }

        $expectedHtml = "<table id=\"post-table\" class=\"table table-striped\">
        <thead>
            <tr><th>ID</th><th>TITLE</th></tr>
        </thead>
        <tbody>
            <tr id=\"row-1\"><td>1</td><td>A</td></tr>
            <tr id=\"row-2\"><td>2</td><td>B</td></tr>
            <tr id=\"row-3\"><td>3</td><td>C</td></tr>
            <tr id=\"row-4\"><td>4</td><td>D</td></tr>
        </tbody>
        <tfoot></tfoot>
        </table>";

        $expectedDom = new DomDocument();
        $expectedDom->loadXML($expectedHtml);
    
        $actualDom = new DomDocument();
        $actualDom->loadXML($table->html());
    
        $this->assertXmlStringEqualsXmlString($expectedDom->saveHTML(), $actualDom->saveHTML());
    }
}