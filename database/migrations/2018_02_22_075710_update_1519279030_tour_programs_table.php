<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1519279030TourProgramsTable extends Migration
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
            if(Schema::hasColumn('tour_programs', 'medical_representative')) {
                $table->dropColumn('medical_representative');
            }
            
        });
Schema::table('tour_programs', function (Blueprint $table) {
            
if (!Schema::hasColumn('tour_programs', 'month')) {
                $table->enum('month', array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'))->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'select_date')) {
                $table->date('select_date')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'medical_representative_name')) {
                $table->string('medical_representative_name')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'area')) {
                $table->string('area')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'modification')) {
                $table->string('modification')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'remarks')) {
                $table->text('remarks')->nullable();
                }
if (!Schema::hasColumn('tour_programs', 'work_with_manager')) {
                $table->string('work_with_manager')->nullable();
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
                        $table->string('month')->nullable();
                $table->string('medical_representative')->nullable();
                
        });

    }
}
