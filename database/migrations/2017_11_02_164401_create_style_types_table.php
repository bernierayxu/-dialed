<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStyleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('style_types', function (Blueprint $table) {
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
        Schema::dropIfExists('style_types');
    }
}

/* Example records

ID      ORGANIZATION_ID CODE        NAME
1       1               54          Suits
2       1               64          WMN Suits
3       1               70          Short
4       1               80          WMN Short
5       7               LSJERSEY    Long Sleeve Jersey  
6       7               JERSEY      Short Sleve Jersey
7       7               TRISHORT    Tri Short                     

*/