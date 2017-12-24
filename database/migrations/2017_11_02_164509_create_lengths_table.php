<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLengthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lengths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->integer('length_type')->unsigned();   //0 = body   1 = arm   2 = leg
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('c_name');
            $table->integer('display_order');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['organization_id', 'length_type', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lengths');
    }
}

/* Example Records
ID  ORGANIZATION_ID LENGTH_TYPE CODE        NAME
1   1               0           BODY        Normal Length
2   1               0           B+2.5       B +2.5cm
3   1               0           B+5.0       B +5.0cm
4   1               0           B-2.5       B -2.5cm
5   1               0           B-5.0       B -5.0cm
1   1               1           ARM         Normal Length
2   1               1           A+2.5       A +2.5cm
3   1               1           A+4.0       A +4.0cm
4   1               1           A-2.5       A -2.5cm
5   1               1           A-4.0       A -4.0cm

*/