<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // "id" field
            $table->string('product_id')->unique(); // "product_id" field, unique identifier for the product
            $table->string('store_id'); // "store_id" field, referencing the store
            $table->string('title'); // "title" field
            $table->decimal('price', 8, 2); // "price" field with precision and scale
            $table->text('description'); // "description" field
            $table->string('category'); // "category" field
            $table->integer('quantity'); // "quantity" field, representing the product quantity
            $table->string('image'); // "image" field (storing file path)
            $table->decimal('rating_rate', 3, 1)->default('3'); // "rating_rate" field with precision and scale
            $table->integer('rating_count')->nullable();  // "rating_count" field
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
