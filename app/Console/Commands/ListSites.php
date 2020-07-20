<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Site;
use Illuminate\Database\Eloquent\Collection;

class ListSites extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list:sites';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected const TABLE_HEADERS = ['id', 'user_id', 'name'];

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
        $this->table(self::TABLE_HEADERS, $this->getSites());
    }

    /**
     * @return Site[]|Collection
     */
    protected function getSites()
    {
        return Site::all(self::TABLE_HEADERS);
    }
}
