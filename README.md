Yet another very simple html table generator for PHP

Generate a table structure as shown below

```php
use erguncaner\Table;
use erguncaner\TableColumn;
use erguncaner\TableRow;
use erguncaner\TableCell;

// Sample data
$posts = [
    ['id'=>1, 'title'=>'Title 1'],
    ['id'=>2, 'title'=>'Title 2'],
    ['id'=>3, 'title'=>'Title 3'],
];

// First create a table
$table = new Table([
    'id'=>'post-table'
]);

// Create table columns with a column key and column object
$table->addColumn('id', new TableColumn(['label'=>'ID']));
$table->addColumn('title', new TableColumn(['label'=>'TITLE']));

// Then add rows
foreach($posts as $post){
    
    // Associate cells with columns
    $cells = [
        'id' => new TableCell($post['id'], ['class'=>'id-cell']),
        'title' => new TableCell($post['title']),
    ];

    $attrs = [
        'id' => 'post-'.$post['id']
    ];

    $table->addRow(new TableRow($cells, $attrs));
}

// Finally generate html
$html = $table->html();
```

This will generate html below

```html
<table id="post-table">
<thead>
    <tr><th>ID</th><th>TITLE</th></tr>
</thead>
<tbody>
    <tr id="post-1"><td class="id-cell">1</td><td>Title 1</td></td>
    <tr id="post-2"><td class="id-cell">2</td><td>Title 2</td></td>
    <tr id="post-3"><td class="id-cell">3</td><td>Title 3</td></td>
</tbody>
<tfoot></tfoot>
</table>
```