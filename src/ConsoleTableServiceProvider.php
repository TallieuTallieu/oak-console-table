<?php

namespace Tnt\ConsoleTable;

use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;

class ConsoleTableServiceProvider extends ServiceProvider
{
    protected $isLazy = true;

    public function boot(ContainerInterface $app)
    {
        //
    }

    public function register(ContainerInterface $app)
    {
        $app->set(Table::class, Table::class);
    }

    public function provides(): array
    {
        return [Table::class,];
    }
}