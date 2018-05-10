<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Marketing Division Head(can create other users)',],
            ['id' => 2, 'title' => 'Medical Representative',],
            ['id' => 3, 'title' => 'Zonal Sales Manager',],
            ['id' => 4, 'title' => 'Divisional Sales Manager',],
            ['id' => 5, 'title' => 'Regional Sales Manager',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
