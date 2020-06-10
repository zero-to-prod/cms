<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    protected const TABLE = 'products';

    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Primary key of table.');
            $table->string('name')->comment('Stores the primary name of the product.');
            $table->string('slug')->comment('The slug of the product name.');
            $table->text('description')->comment('Stores the description of the product.');
            $table->integer('product_type_id')->comment('References the product type id.')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->index(['name', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
