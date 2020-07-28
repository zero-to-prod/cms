<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{

    protected const TABLE = 'notes';

    public function up(): void
    {
        Schema::create(
            self::TABLE,
            static function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
