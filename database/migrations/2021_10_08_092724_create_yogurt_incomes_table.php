<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYogurtIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yogurt_incomes', function (Blueprint $table) {
            $table->id();
            $table->string("capacity");
            $table->integer("price");
            $table->integer("quantity");
            $table->integer("amount");
            $table->string("added_by");
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
        Schema::dropIfExists('yogurt_incomes');
    }
}
