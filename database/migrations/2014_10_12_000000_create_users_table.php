<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    protected const TABLE = 'users';

    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primary key.');
            $table->string('name')->unique()->nullable()->comment('Used as the string identifier.');
            $table->string('email')->unique()->comment('Used as the primary contact.');
            $table->timestamp('email_verified_at')->nullable()->comment('Used indicate a verified account.');
            $table->boolean('active')->default(0)->comment('Used to mark an active user.');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
