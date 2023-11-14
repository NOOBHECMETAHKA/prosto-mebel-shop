<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisClearMemoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Чистит все переменные в redis!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Cache::clear();
    }
}
