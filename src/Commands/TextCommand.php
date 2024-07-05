<?php

namespace Conquest\Text\Commands;

use Illuminate\Console\Command;

class TextCommand extends Command
{
    public $signature = 'text';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
