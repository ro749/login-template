<?php

namespace Ro749\LoginTemplate\Commands;

use Illuminate\Console\Command;

class LoginTemplateCommand extends Command
{
    public $signature = 'login-template';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
