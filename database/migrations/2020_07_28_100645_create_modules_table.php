<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{

    protected const TABLE = 'modules';

    public function up(): void
    {
        Schema::create(
            self::TABLE,
            static function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('meta_id');
                $table->char('name');
                $table->char('slug');
                $table->boolean('is_enabled')->default(0);
                $table->char('path');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
