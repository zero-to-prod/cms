<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogTable extends Migration
{

    protected const TABLE = 'request_log';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            // @todo Add more request params.
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->char('path')->comment('Records the request path.')->nullable();
            $table->float('request_response_time_delta')->comment('Records the difference between the request and the response.')->nullable();
            $table->boolean('error')->default(0)->comment('Records if there is an error.');
            $table->text('error_message')->comment('Records an error message.')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
