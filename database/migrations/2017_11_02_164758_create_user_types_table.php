<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('user_types');
    }
}

/* Example Data
ID  ORGANIZATION_ID CODE    NAME
1   1               SYSTEM  System Admin User
2   1               ADMIN   Administrative User
3   1               MGR     Manager
4   1               LEAD    Team Lead
5   1               DESIGN  Designer
6   1               CUT     Cutting Team
7   7               OEM_1   OEM Tineli User
8   8               OEM_2   OEM Strava User        
*/