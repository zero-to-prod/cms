<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    protected const TABLE = 'password_resets';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->char('email')->index();
            $table->char('token');
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
