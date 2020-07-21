<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTable extends Migration
{
    protected const TABLE = 'meta';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('user_id_created_at')->nullable();
            $table->bigInteger('user_id_updated_at')->nullable();
            $table->bigInteger('user_id_deleted_at')->nullable();
            $table->char('name')->nullable();
            $table->char('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->text('help')->nullable();
            $table->char('link')->nullable();
            $table->char('color')->nullable();
            // @todo Add Images, Tags, Status pivot tables
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta');
    }
}
