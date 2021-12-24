<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale__items', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('rate');
            $table->integer('quantity');
            $table->double('amount',10,2);
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
        Schema::dropIfExists('sale__items');
    }
}
