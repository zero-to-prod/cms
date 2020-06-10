<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypesTable extends Migration
{
    protected const TABLE = 'product_types';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id()->comment('Primary key of table.');
            $table->string('name')->comment('Stores the primary name of the product type.');
            $table->string('slug')->comment('The slug of the product type.');
            $table->text('description')->comment('Stores the description of the product type.');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
