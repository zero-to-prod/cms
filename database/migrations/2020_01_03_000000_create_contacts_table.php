<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    protected const TABLE = 'contacts';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('alias')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->string('phone_number_mobile')->nullable();
            $table->string('phone_number_home')->nullable();
            $table->string('phone_number_work')->nullable();
            $table->string('phone_number_other')->nullable();
            $table->string('fax_number_home')->nullable();
            $table->string('fax_number_work')->nullable();
            $table->string('fax_number_other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
