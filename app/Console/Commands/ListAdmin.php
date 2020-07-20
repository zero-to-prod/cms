<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListAdmin extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:admin';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists the Admin account.';
    protected const TABLE_HEADERS = ['id', 'name', 'email'];

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
     */
    public function handle(): void
    {
        $admin = User::where('email', config('admin.email'))->get(self::TABLE_HEADERS);
        if ($admin === null) {
            $this->info('Admin not found');
        }
        $this->table(self::TABLE_HEADERS, $admin);
    }
}
