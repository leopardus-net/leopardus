<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeftSidebarItemsPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('left_sidebar_items_permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('sidebar_item_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->foreign('sidebar_item_id')
                 ->references('id')->on('left_sidebars')
                 ->onDelete('cascade');

            $permissionTable = config('permission.table_names')['permissions'];
            $table->foreign('permission_id')
                 ->references('id')
                 ->on($permissionTable)
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
        Schema::dropIfExists('left_sidebar_items_permissions');
    }
}
