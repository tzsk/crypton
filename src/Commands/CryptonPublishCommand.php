<?php

namespace Tzsk\Crypton\Commands;

use Illuminate\Console\Command;

class CryptonPublishCommand extends Command
{
    public $signature = 'crypton:publish';

    public $description = 'Publish crypton config file';

    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'crypton-config']);
    }
}
