<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->nullable();
            $table->string('color_code')->nullable();
            $table->string('item_name');
            $table->bigInteger('item_id')->nullable();
            $table->integer('qty');
            $table->string('condition')->comment('0 fix, 1 adjustments');
            $table->string('remark')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('item_adjustments');
    }
}
