<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519212479PermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            if(! Schema::hasColumn('permissions', 'deleted_at')) {
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
        Schema::table('permissions', function (Blueprint $table) {
            if(Schema::hasColumn('permissions', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
            
        });

    }
}
