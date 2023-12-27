<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_group_id');
            $table->bigInteger('item_sub_group_id');
            $table->string('photo')->nullable();
            $table->string('item_code')->nullable();
            $table->string('color_code')->nullable();
            $table->string('item_name');
            $table->string('scale')->nullable();
            $table->decimal('buying_price',8,2)->nullable();
            $table->dateTime('buying_date')->nullable();
            $table->integer('qty');
            $table->string('condition')->comment('0 new, 1 old, 2 second hand');
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
        Schema::dropIfExists('items');
    }
}
