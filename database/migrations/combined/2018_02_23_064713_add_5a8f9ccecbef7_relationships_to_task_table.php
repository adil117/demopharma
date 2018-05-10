<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5a8f9ccecbef7RelationshipsToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '121332_5a8d269759ef8')->references('id')->on('task_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '121332_5a8d269763d07')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if(Schema::hasColumn('tasks', 'status_id')) {
                $table->dropForeign('121332_5a8d269759ef8');
                $table->dropIndex('121332_5a8d269759ef8');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('tasks', 'user_id')) {
                $table->dropForeign('121332_5a8d269763d07');
                $table->dropIndex('121332_5a8d269763d07');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
