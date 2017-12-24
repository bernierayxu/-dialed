<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_person', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('display_order');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['organization_id', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_person');
    }
}

/*  Example Records
ID  ORGANIZATION_ID     CODE        NAME            EMAIL               PHONE           DISPLAY_ORDER
1   4                   DJ          Drew Johnson    djohnson@cuore.ch   303-555-1212    1
2   1                   JE          Juergen Eckmann jeckmann@cuore.ch   303-555-1213    1
3   1                   RS          Rebekah Smith   rsmith@cuore.ch     303-555-1234    2
                      
*/