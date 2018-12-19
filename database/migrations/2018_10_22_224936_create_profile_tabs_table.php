<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_tabs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon')->nullable();
            $table->string('slug');
            $table->string('route');
            $table->integer('order')->default(0);
            $table->string('type')->default('profile');
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
        Schema::dropIfExists('profile_tabs');
    }
}
