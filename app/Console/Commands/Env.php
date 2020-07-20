<?php

namespace App\Console\Commands;

use App\Helpers\Classes\EnvHelper;
use Illuminate\Console\Command;

class Env extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env {key} {value}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Writes an env value.';

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
    public function handle(): void
    {
        $key = $this->argument('key');
        $value = $this->argument('value');

        EnvHelper::write($key, $value);
        $this->info('Write env: '."{$key}={$value}");
    }
}
