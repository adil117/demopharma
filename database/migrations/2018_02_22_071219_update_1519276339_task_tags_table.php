<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519276339TaskTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_tags', function (Blueprint $table) {
            if(! Schema::hasColumn('task_tags', 'deleted_at')) {
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
        Schema::table('task_tags', function (Blueprint $table) {
            if(Schema::hasColumn('task_tags', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
            
        });

    }
}
