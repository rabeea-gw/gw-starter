<?php

namespace Gw;

use Gw\Console\InstallCommand;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(InstallCommand::class);
    }
}
