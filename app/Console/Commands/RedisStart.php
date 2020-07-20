<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:start';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts redis-server.';

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
        $this->info(exec('sudo /etc/init.d/redis-server start --protected-mode no'));
    }
}
