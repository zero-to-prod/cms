<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;

class AppInstall extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the app.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->call('migrate:fresh');
        $this->call('passport:install');
        $this->call('make:admin');
    }
}
