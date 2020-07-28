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
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->char('title')->nullable();
            $table->char('first_name')->nullable();
            $table->char('middle_name')->nullable();
            $table->char('last_name')->nullable();
            $table->char('alias')->nullable();
            $table->char('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->char('company')->nullable();
            $table->char('job_title')->nullable();
            $table->char('email')->nullable();
            $table->char('email_other')->nullable();
            $table->char('phone_number_mobile')->nullable();
            $table->char('phone_number_home')->nullable();
            $table->char('phone_number_work')->nullable();
            $table->char('phone_number_other')->nullable();
            $table->char('fax_number_home')->nullable();
            $table->char('fax_number_work')->nullable();
            $table->char('fax_number_other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
