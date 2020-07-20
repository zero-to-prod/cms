<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\User;

class ListUsers extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @todo Add a dynamic limit.
     * @var string
     */
    protected $signature = 'list:users';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists the users';
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
        $this->table(self::TABLE_HEADERS, $this->getUsers());
    }

    /**
     * @return mixed
     */
    protected function getUsers()
    {
        return User::latest()->limit(10)->get(self::TABLE_HEADERS);
    }
}
