<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_id')->unsigned();
            $table->integer('min_quantity');
            $table->integer('max_quantity');
            $table->decimal('price_group_std', 5, 2);
            $table->decimal('price_group_alt1', 5, 2);
            $table->decimal('price_group_alt2', 5, 2);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['price_id', 'min_quantity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_steps');
    }
}
