<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Helpers\Classes\AdminHelper;
use App\Models\Site;
use Illuminate\Support\Collection;

class MakeSite extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:site';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a new site.';
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
     * @return void
     */
    public function handle(): void
    {
        // Site
        $site_name = $this->ask('What is the site name');

        // Site
        $site = new Site();
        $site->user_id = AdminHelper::id();
        $site->name = $site_name;
        $site->save();

        $table = Site::where('id', $site->id)->get(self::TABLE_HEADERS);
        $this->table(self::TABLE_HEADERS, $table);
    }

    /**
     * Turns a collection into an array of strings.
     *
     * @param  Collection  $collection
     *
     * @return array
     */
    protected function makeCommandList(Collection $collection): array
    {
        $list = [];
        // @todo use a collection method instead of foreach()
        foreach ($collection as $value) {
            $list[] = $value->name;
        }

        return $list;
    }
}
