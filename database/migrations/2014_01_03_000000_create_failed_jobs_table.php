<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    protected const TABLE = 'failed_jobs';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->char('connection');
            $table->char('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
