<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519361230TourProgramsTable extends Migration
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
            if(Schema::hasColumn('tour_programs', 'select_date')) {
                $table->dropColumn('select_date');
            }
            if(Schema::hasColumn('tour_programs', 'medical_representative_name')) {
                $table->dropColumn('medical_representative_name');
            }
            if(Schema::hasColumn('tour_programs', 'area')) {
                $table->dropColumn('area');
            }
            if(Schema::hasColumn('tour_programs', 'modification')) {
                $table->dropColumn('modification');
            }
            if(Schema::hasColumn('tour_programs', 'remarks')) {
                $table->dropColumn('remarks');
            }
            if(Schema::hasColumn('tour_programs', 'work_with_manager')) {
                $table->dropColumn('work_with_manager');
            }
            
        });
Schema::table('tour_programs', function (Blueprint $table) {
            
if (!Schema::hasColumn('tour_programs', 'month')) {
                $table->enum('month', array('Select Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'));
                }
if (!Schema::hasColumn('tour_programs', 'select_date')) {
                $table->date('select_date')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'medical_representative_name')) {
                $table->string('medical_representative_name');
                }
if (!Schema::hasColumn('tour_programs', 'area')) {
                $table->string('area');
                }
if (!Schema::hasColumn('tour_programs', 'modification')) {
                $table->string('modification');
                }
if (!Schema::hasColumn('tour_programs', 'remarks')) {
                $table->text('remarks');
                }
if (!Schema::hasColumn('tour_programs', 'work_with_manager')) {
                $table->string('work_with_manager');
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
            $table->dropColumn('select_date');
            $table->dropColumn('medical_representative_name');
            $table->dropColumn('area');
            $table->dropColumn('modification');
            $table->dropColumn('remarks');
            $table->dropColumn('work_with_manager');
            
        });
Schema::table('tour_programs', function (Blueprint $table) {
                        $table->enum('month', array('Select Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'))->nullable();
                $table->date('select_date')->nullable();
                $table->string('medical_representative_name')->nullable();
                $table->string('area')->nullable();
                $table->string('modification')->nullable();
                $table->text('remarks')->nullable();
                $table->string('work_with_manager')->nullable();
                
        });

    }
}
