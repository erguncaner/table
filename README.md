Yet another very simple html table generator for PHP

```
composer require erguncaner/table dev-master
```

Generate a table structure as shown below

```php
require_once __DIR__.'/vendor/autoload.php';

use erguncaner\Table\Table;
use erguncaner\Table\TableColumn;
use erguncaner\Table\TableRow;
use erguncaner\Table\TableCell;

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
$table->addColumn('id', new TableColumn('ID', ['class'=>'id-column']));
$table->addColumn('title', new TableColumn('TITLE'));

// Then add rows
foreach($posts as $post){
    
    // Associate cells with columns
    $cells = [
        'id' => new TableCell($post['id'], ['class'=>'id-cell']),
        'title' => new TableCell($post['title']),
    ];

    // define row attributes
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
    <tr><th class="id-column">ID</th><th>TITLE</th></tr>
</thead>
<tbody>
    <tr id="post-1"><td class="id-cell">1</td><td>Title 1</td></td>
    <tr id="post-2"><td class="id-cell">2</td><td>Title 2</td></td>
    <tr id="post-3"><td class="id-cell">3</td><td>Title 3</td></td>
</tbody>
<tfoot></tfoot>
</table>
```