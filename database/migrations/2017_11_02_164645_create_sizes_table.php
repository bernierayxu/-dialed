<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('code', 10);
            $table->string('name');
            $table->integer('display_order');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['organization_id', 'display_order']);
            $table->unique(['organization_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
/*  Example data
ID  ORGANIZATION_ID CODE            NAME                DISPLAY_ORDER
1   1               116             Childrens 116       1
1   1               128             Childrens 128       2
1   1               XXXS            Three Extra Small   3
1   1               XXS             Two Extra Small     4
1   1               XS              Extra Small         5
*/