<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    protected const TABLE = 'sites';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meta_id');
            $table->boolean('api_can_login')->default(1)->comment('Allows an api user to login.');
            $table->boolean('api_can_register')->default(0)->comment('Allows an api user to register.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
