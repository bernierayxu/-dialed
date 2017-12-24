<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->unique();
            $table->integer('type')->unsigned();
            $table->string('name');
            $table->string('number');
            $table->string('bill_addr1');
            $table->string('bill_addr2');
            $table->string('bill_city');
            $table->string('bill_state');
            $table->string('bill_postal');
            $table->string('bill_country');
            $table->string('bill_email');
            $table->string('bill_phone');
            $table->string('ship_addr1');
            $table->string('ship_addr2');
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_postal');
            $table->string('ship_country');
            $table->string('ship_email');
            $table->string('ship_phone');
            $table->string('ship_method');
            $table->string('ship_acct_no');
            $table->integer('parent')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}

/* example organizations
 ID     CODE            NAME                            TYPE            PARENT
 1      CUORE           Cuore Parent Org                1 (PARENT)      0
 2      USA             USA Sales Organization          2 (INTERNAL)    1
 3      EU              EU Sales Organization           2 (INTERNAL)    1
 4      SA              South Africa Sales Organization 2 (INTERNAL)    3
 5      CH              CH Sales Organization           2 (INTERNAL)    1
 6      AUS             Australia Sales Organization    2 (INTERNAL)    1
 7      ASIA            ASIA Sales Organization         2 (INTERNAL)    1
 8      ASIA_TH         TH Sales Organization           2 (INTERNAL)    7
 9      OEM_STRAVA      OEM Strava                      3 (OEM)         0
 10     OEM_TINELI      OEM Tineli                      3 (OEM)         0
*/