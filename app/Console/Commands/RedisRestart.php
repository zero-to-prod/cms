<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisRestart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restarts redis-server.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(exec('sudo /etc/init.d/redis-server restart'));
    }
}
