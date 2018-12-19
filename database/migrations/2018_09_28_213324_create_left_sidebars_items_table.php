<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeftSidebarsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('left_sidebars_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->string('route')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();

            $table->foreign('parent_id')
                    ->references('id')
                    ->on('left_sidebars_items')
                    ->onDelete('cascade');

            $table->integer('sidebar_id')->unsigned();
            $table->foreign('sidebar_id')
                    ->references('id')
                    ->on('left_sidebars')
                    ->onDelete('cascade');

            $table->integer('order')->default(0);
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
        Schema::dropIfExists('left_sidebars_items');
    }
}
