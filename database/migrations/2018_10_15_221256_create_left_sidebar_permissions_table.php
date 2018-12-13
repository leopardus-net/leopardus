<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeftSidebarPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('left_sidebar_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('sidebar_id')->unsigned();
            
            $table->foreign('sidebar_id')
                 ->references('id')->on('left_sidebars')
                 ->onDelete('cascade');

            $table->integer('permission_id')->unsigned();

            $permissionTable = config('permission.table_names')['permissions'];
            $table->foreign('permission_id')
                 ->references('id')->on($permissionTable)
                 ->onDelete('cascade');
                 
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
        Schema::dropIfExists('left_sidebar_permissions');
    }
}
