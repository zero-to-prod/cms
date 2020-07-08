<?php

namespace App\Console\Commands;

use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Console\Command;

class Test extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command used for testing';

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
     * @return void
     */
    public function handle()
    {
        echo 'Test command fired.'.PHP_EOL;
        $user = factory(User::class)->create();
        event(new UserRegistered($user));
    }
}
