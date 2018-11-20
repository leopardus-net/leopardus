<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slogan');
            $table->string('company_name')->nullable();
            $table->integer('lang')->nullable();
            $table->string('company_email')->nullable();
            $table->string('site_email')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_type')->nullable();
            $table->boolean('enable_register')->default(1)->nullable();
            $table->boolean('enable_auth_fb')->default(0)->nullable();
            $table->boolean('enable_auth_tw')->default(0)->nullable();
            $table->boolean('enable_auth_google')->default(0)->nullable();
            $table->string('version')->default('0.8.5')->nullable();
            $table->integer('keycode')->nullable();
            $table->string('logo_icon')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo_text')->nullable();
            $table->integer('rol_default')->default(1)->nullable();
            $table->integer('maintenance')->default(0)->nullable();
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
        Schema::dropIfExists('settings');
    }
}
