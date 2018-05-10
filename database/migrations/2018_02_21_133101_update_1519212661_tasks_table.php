<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519212661TasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            if(! Schema::hasColumn('tasks', 'deleted_at')) {
                $table->softDeletes();
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
        Schema::table('tasks', function (Blueprint $table) {
            if(Schema::hasColumn('tasks', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
            
        });

    }
}
