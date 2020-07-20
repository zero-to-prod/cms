<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EchoServerStart extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo-server:start';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts the echo server.';

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
        $this->info(exec('laravel-echo-server start'));
    }
}
