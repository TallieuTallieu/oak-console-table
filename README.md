# oak-console-table
### Console tables for Oak

#### Installation

```ssh
composer require reinvanoyen/oak-console-table
```

#### Example usage

```php
<?php

$table = new \Tnt\ConsoleTable\Table($output); // $output = OutputInterface

$table->setHeaders(['Id', 'Username', 'Email address',]);
$table->setRows([
    [1, 'Rein', 'reinvanoyen@gmail.com',],
    [2, 'JohnDoe21', 'johndoe@hotmail.com',],
    [3, 'butterfly1982', 'butterfly54@gmail.com',],
]);

$table->addRow([4, 'user45', 'johndoe122@gmail.com',]);

$table->output();

```