<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128)->index()->commit("商品名称");
            $table->string('desc',128)->commit("简短描述");
            $table->text('content')->commit("详情");
            $table->decimal('price',8,2)->unsigned()->commit("价格");
            $table->decimal('market_price',8,2)->unsigned()->commit("市场价格");
            $table->smallInteger('storage')->unsigned()->commit("库存");
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
        Schema::dropIfExists('goods');
    }
}
