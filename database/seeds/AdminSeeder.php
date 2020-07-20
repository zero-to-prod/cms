<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class AdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Artisan::call('make:admin');
    }
}
