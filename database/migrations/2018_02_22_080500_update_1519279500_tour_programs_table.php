<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519279500TourProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_programs', function (Blueprint $table) {
            if(Schema::hasColumn('tour_programs', 'month')) {
                $table->dropColumn('month');
            }
            
        });
Schema::table('tour_programs', function (Blueprint $table) {
            
if (!Schema::hasColumn('tour_programs', 'month')) {
                $table->enum('month', array('Select Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'))->nullable();
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
        Schema::table('tour_programs', function (Blueprint $table) {
            $table->dropColumn('month');
            
        });
Schema::table('tour_programs', function (Blueprint $table) {
                        $table->enum('month', array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'))->nullable();
                
        });

    }
}
