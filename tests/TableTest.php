<?php

use PHPUnit\Framework\TestCase;
use erguncaner\Table\Table;
use erguncaner\Table\TableColumn;
use erguncaner\Table\TableCell;
use erguncaner\Table\TableRow;
use erguncaner\Table\Attribute;

class TableTest extends TestCase
{
    /**
     * Sample data
     * 
     * @var array
     */
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

    /**
     * Tests attribute generation
     */
    public function testAttributes()
    {
        $attrs = ['class'=>'active', 'id'=>'item-1'];
        $str = Attribute::str($attrs);

        $this->assertEquals(' class="active" id="item-1"', $str);
    }

    /**
     * Tests row and cell generation
     */
    public function testRowsAndCells()
    {
        $cells = [
            new TableCell('1'),
            new TableCell('Title', ['class'=>'title']),
        ];

        $row = new TableRow($cells, ['class'=>'active']);

        $this->assertEquals("   <tr class=\"active\"><td>1</td><td class=\"title\">Title</td></tr>", $row->html());
    }

    /**
     * Tests html generation
     */
    public function testTableHtml()
    {
        $table = new Table([
            'id' => 'post-table',
            'class' => 'table table-striped'
        ]);
        
        $table->addColumn('id', new TableColumn('#', ['class'=>'id-column']));
        $table->addColumn('title', new TableColumn('Title'));

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
            <tr><th class=\"id-column\">#</th><th>Title</th></tr>
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

    public function testAsArray()
    {
        $table = new Table([
            'id' => 'post-table',
            'class' => 'table table-striped'
        ]);
        
        $table->addColumn('id', new TableColumn('#', ['class'=>'id-column']));
        $table->addColumn('title', new TableColumn('Title'));

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

        $expected = [
            'attributes' => [
                'id' => 'post-table',
                'class' => 'table table-striped'
            ],
            'columns' => [
                'id' => ['content'=>'#', 'attributes'=>['class'=>'id-column']],
                'title' => ['content'=>'Title', 'attributes'=>[]]
            ],
            'rows' => [
                [
                    'cells'=>[
                        'id' => ['content'=>'1', 'attributes'=>[]],
                        'title' => ['content'=>'A', 'attributes'=>[]],
                    ], 
                    'attributes'=>[
                        'id' => 'row-1'
                    ]
                ],
                [
                    'cells'=>[
                        'id' => ['content'=>'2', 'attributes'=>[]],
                        'title' => ['content'=>'B', 'attributes'=>[]],
                    ], 
                    'attributes'=>[
                        'id' => 'row-2'
                    ]
                ],
                [
                    'cells'=>[
                        'id' => ['content'=>'3', 'attributes'=>[]],
                        'title' => ['content'=>'C', 'attributes'=>[]],
                    ], 
                    'attributes'=>[
                        'id' => 'row-3'
                    ]
                ],
                [
                    'cells'=>[
                        'id' => ['content'=>'4', 'attributes'=>[]],
                        'title' => ['content'=>'D', 'attributes'=>[]],
                    ], 
                    'attributes'=>[
                        'id' => 'row-4'
                    ]
                ],
            ]
        ];

        $this->assertEquals($expected, $table->array());
    }
}