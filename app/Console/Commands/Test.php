<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Events\UserRegisteredEvent;
use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Test extends BaseCommand
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
     * @return Application|ResponseFactory|Response
     */
    public function handle()
    {
        $modules = Module::where('is_enabled', true)->get(['id','path']);
        $patterns = null;
        foreach($modules as $key => $module){
            $patterns[] = $module->path;
        }
        print_r($patterns[0]);
    }
}
