<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthLogTable extends Migration
{
    protected const TABLE = 'auth_log';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->boolean('login')->nullable()->default(null);
            $table->boolean('logout')->nullable()->default(null);
            $table->char('url')->nullable()->default(null);
            $table->char('full_url')->nullable()->default(null);
            $table->char('path')->nullable()->default(null);
            $table->boolean('secure')->nullable()->default(null);
            $table->char('user_agent')->nullable()->default(null);
            $table->char('fingerprint')->nullable()->default(null);
            $table->ipAddress('ip_address')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
