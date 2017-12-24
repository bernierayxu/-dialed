<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitOfMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_of_measures', function (Blueprint $table) {
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
        Schema::dropIfExists('unit_of_measures');
    }
}
/*  Example data
ID  ORGANIZATION_ID CODE            NAME            DISPLAY_ORDER
1   1               PIECE           Piece           1
1   1               EACH            Each            2
1   1               SET             Set             3
1   1               M               Meter           4
1   1               Y               Yard            5
1   1               KG              Kilogram        6
1   1               CM              Centimeter      7
1   1               IN              Inch            8
*/