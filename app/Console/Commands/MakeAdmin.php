<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Helpers\ScopesHelper;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the admin account.';
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
     * @return void
     */
    public function handle(): void
    {
        $user = User::where('email', config('admin.email'))->first();
        if ($user === null) {
            DB::table('users')->insert([
                'name'     => config('admin.name'),
                'email'    => config('admin.email'),
                'password' => Hash::make(config('admin.password')),
                'can_login' => 1,
                'meta_id'  => 0,
                'locale'   => 'en',
                'scopes'   => ScopesHelper::asString()
            ]);
            $this->info('Admin user created.');
            // @todo Make this code DRY.
            $admin = User::where('email', config('admin.email'))->get(self::TABLE_HEADERS);
            $this->table(self::TABLE_HEADERS, $admin);
        } else {
            $this->info('Admin account already created');
        }
    }
}
