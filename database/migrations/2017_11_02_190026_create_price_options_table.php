<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price_id')->unsigned();
            $table->string('code', 10);
            $table->string('name');
            $table->decimal('unit_cost', 8,2);
            $table->integer('price_type')->unsigned(); 
            $table->boolean('in_base');   
            $table->integer('display_order');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['price_id', 'code']);
            $table->index(['price_id', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_options');
    }
}
/* Example Data
ID  PRICE_ID    CODE        NAME                UNIT_COST       PRICE_TYPE      IN_BASE     DISPLAY_ORDER
1   1           J_COVER     Jersey Cover Stitch 1.70            1 (OPTION)      0 (FALSE)   1
2   1           REFLECT     Reflective Package  1.40            1 (OPTION)      0 (FALSE)   2
3   1           MEDIA       Media Pocket        1.70            1 (OPTION)      0 (FALSE)   3
4   1           J_F_DESIGN  Jersey Full Design  40.00           3 (LINE)        0 (FALSE)   10
5   1           J_M_DESIGN  Jersey Minor Design 8.00            3 (LINE)        0 (FALSE)   11
6   1           TAILOR      Custom Tailor       4.50            3 (UNIT)        0 (FALSE)   12
7   1           PHOTO       Include Photo       30.00           3 (LINE)        0 (FALSE)   13
8   1           TEAM_BULK   Team Pack Bulk      .75             5 (ORDER_UNIT)  0 (FALSE)   20
9   1           PROCESS     Order Processing    25.00           4 (ORDER)       0 (FALSE)   30
1   3           J_COVER     Jersey Cover Stitch 1.70            1 (OPTION)      0 (FALSE)   1
2   3           REFLECT     Reflective Package  1.40            1 (OPTION)      0 (FALSE)   2
3   3           MEDIA       Media Pocket        1.70            1 (OPTION)      0 (FALSE)   3
4   3           J_F_DESIGN  Jersey Full Design  40.00           3 (LINE)        0 (FALSE)   10
5   3           J_M_DESIGN  Jersey Minor Design 8.00            3 (LINE)        0 (FALSE)   11
6   3           TAILOR      Custom Tailor       12.50           3 (UNIT)        0 (FALSE)   12
7   3           PHOTO       Include Photo       30.00           3 (LINE)        0 (FALSE)   13
8   3           TEAM_BULK   Team Pack Bulk      .75             5 (ORDER_UNIT)  0 (FALSE)   20
9   3           PROCESS     Order Processing    25.00           4 (ORDER)       0 (FALSE)   30
*/
