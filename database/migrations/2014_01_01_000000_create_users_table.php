<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    protected const TABLE = 'users';

    public function up(): void
    {
        Schema::create(
            self::TABLE,
            static function (Blueprint $table) {
                $table->bigIncrements('id')->comment('Primary key.');
                $table->bigInteger('meta_id')->nullable();
                $table->bigInteger('contact_id')->nullable()->comment('References the contacts table.');
                $table->char('name')->nullable()->comment('Used as the string identifier.');
                $table->char('email')->unique()->comment('Used as the primary contact.');
                $table->timestamp('email_verified_at')->nullable()->comment('Used indicate a verified account.');
                $table->string('password');
                $table->char('locale')->nullable()->comment('Defines the default local of the user.');
                $table->rememberToken();
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
