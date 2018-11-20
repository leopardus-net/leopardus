<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileHeaderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_header_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon')->nullable();
            $table->string('slug')->nullable();
            $table->string('url')->nullable();
            $table->integer('order')->nullable();
            $table->integer('type')->default(0)->comment('0: Item, 1: Separator');
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
        Schema::dropIfExists('profile_header_items');
    }
}
