<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('summary');
            $table->longText('description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->unsignedBigInteger('cat_id');
//            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->string('photo');
            $table->float('price')->default(0);
            $table->float('offer_price')->default(0);
            $table->float('discount')->default(0);
            $table->enum('conditions',['new','popular','winter'])->default('new');
            $table->enum('status',['active','inactive'])->default('active');
            $table->string('added_by')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();

            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
