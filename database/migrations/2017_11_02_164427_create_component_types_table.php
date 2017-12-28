<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('c_name');
            $table->softDeletes();
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
        Schema::dropIfExists('component_types');
    }
}

/* Example records

ID      ORGANIZATION_ID CODE        NAME
1       1               FABRIC      Fabrics
2       1               ZIPPER      Zippers
3       1               LABEL       Labels
4       1               CHAMOIS     Chamois
5       7               T_FABRIC    Tineli Fabrics  
6       7               T_ZIP       Tineli Zippers
7       7               T_CHAMOIS   Tineli Chamois                     

*/