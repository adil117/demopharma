<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1519277851TourProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('tour_programs')) {
            Schema::create('tour_programs', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('month', array('Select Month', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'));
                $table->date('select_date')->nullable();
                $table->string('medical_representative_name');
                $table->string('area');
                $table->string('modification');
                $table->text('remarks');
                $table->string('work_with_manager');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_programs');
    }
}
