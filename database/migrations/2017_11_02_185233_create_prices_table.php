<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->boolean('is_active');
            $table->integer('currency')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->index('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
/* Example Data
ID  ORGANIZATION_ID     CODE            NAME                    IS_ACTIVE
1   1                   US_RETAIL       US Retail Pricing       1
2   1                   US_XFER         US Transfer Pricing     1
3   1                   US_SAMPLE       US Sample Pricing       1
4   3                   EU_RETAIL       EU Retail Pricing       1
5   3                   EU_XFER         EU Transfer Pricing     1
6   8                   TINELI          Tineli OEM Pricing      1
*/