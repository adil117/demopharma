<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TourProgramTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateTourProgram()
    {
        $admin = \App\User::find(1);
        $tour_program = factory('App\TourProgram')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $tour_program) {
            $browser->loginAs($admin)
                ->visit(route('admin.tour_programs.index'))
                ->clickLink('Add new')
                ->select("month", $tour_program->month)
                ->type("select_date", $tour_program->select_date)
                ->type("medical_representative_name", $tour_program->medical_representative_name)
                ->type("area", $tour_program->area)
                ->type("modification", $tour_program->modification)
                ->type("remarks", $tour_program->remarks)
                ->type("work_with_manager", $tour_program->work_with_manager)
                ->press('Save')
                ->assertRouteIs('admin.tour_programs.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $tour_program->month)
                ->assertSeeIn("tr:last-child td[field-key='select_date']", $tour_program->select_date)
                ->assertSeeIn("tr:last-child td[field-key='medical_representative_name']", $tour_program->medical_representative_name)
                ->assertSeeIn("tr:last-child td[field-key='area']", $tour_program->area)
                ->assertSeeIn("tr:last-child td[field-key='modification']", $tour_program->modification)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $tour_program->remarks)
                ->assertSeeIn("tr:last-child td[field-key='work_with_manager']", $tour_program->work_with_manager);
        });
    }

    public function testEditTourProgram()
    {
        $admin = \App\User::find(1);
        $tour_program = factory('App\TourProgram')->create();
        $tour_program2 = factory('App\TourProgram')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $tour_program, $tour_program2) {
            $browser->loginAs($admin)
                ->visit(route('admin.tour_programs.index'))
                ->click('tr[data-entry-id="' . $tour_program->id . '"] .btn-info')
                ->select("month", $tour_program2->month)
                ->type("select_date", $tour_program2->select_date)
                ->type("medical_representative_name", $tour_program2->medical_representative_name)
                ->type("area", $tour_program2->area)
                ->type("modification", $tour_program2->modification)
                ->type("remarks", $tour_program2->remarks)
                ->type("work_with_manager", $tour_program2->work_with_manager)
                ->press('Update')
                ->assertRouteIs('admin.tour_programs.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $tour_program2->month)
                ->assertSeeIn("tr:last-child td[field-key='select_date']", $tour_program2->select_date)
                ->assertSeeIn("tr:last-child td[field-key='medical_representative_name']", $tour_program2->medical_representative_name)
                ->assertSeeIn("tr:last-child td[field-key='area']", $tour_program2->area)
                ->assertSeeIn("tr:last-child td[field-key='modification']", $tour_program2->modification)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $tour_program2->remarks)
                ->assertSeeIn("tr:last-child td[field-key='work_with_manager']", $tour_program2->work_with_manager);
        });
    }

    public function testShowTourProgram()
    {
        $admin = \App\User::find(1);
        $tour_program = factory('App\TourProgram')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $tour_program) {
            $browser->loginAs($admin)
                ->visit(route('admin.tour_programs.index'))
                ->click('tr[data-entry-id="' . $tour_program->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $tour_program->month)
                ->assertSeeIn("td[field-key='select_date']", $tour_program->select_date)
                ->assertSeeIn("td[field-key='medical_representative_name']", $tour_program->medical_representative_name)
                ->assertSeeIn("td[field-key='area']", $tour_program->area)
                ->assertSeeIn("td[field-key='modification']", $tour_program->modification)
                ->assertSeeIn("td[field-key='remarks']", $tour_program->remarks)
                ->assertSeeIn("td[field-key='work_with_manager']", $tour_program->work_with_manager);
        });
    }

}
