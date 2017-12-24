<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_types', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('contact_types');
    }
}

/* Example records

ID      CODE        NAME
1       BILLING     Billing Contact
2       SHIPPING    Shipping Contact
3       DESIGN      Design Contact
4       MANUF       Manufacturing Contact
5       OTHER       Other Contact
6       CLIENT      Client Contact                   

*/