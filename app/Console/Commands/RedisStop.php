<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisStop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:stop';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stops redis-server.';

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
     */
    public function handle()
    {
        $this->info(exec('sudo /etc/init.d/redis-server stop'));
    }
}
