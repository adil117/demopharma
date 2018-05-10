<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'user_management_create',],
            ['id' => 3, 'title' => 'user_management_edit',],
            ['id' => 4, 'title' => 'user_management_view',],
            ['id' => 5, 'title' => 'user_management_delete',],
            ['id' => 6, 'title' => 'permission_access',],
            ['id' => 7, 'title' => 'permission_create',],
            ['id' => 8, 'title' => 'permission_edit',],
            ['id' => 9, 'title' => 'permission_view',],
            ['id' => 10, 'title' => 'permission_delete',],
            ['id' => 11, 'title' => 'role_access',],
            ['id' => 12, 'title' => 'role_create',],
            ['id' => 13, 'title' => 'role_edit',],
            ['id' => 14, 'title' => 'role_view',],
            ['id' => 15, 'title' => 'role_delete',],
            ['id' => 16, 'title' => 'user_access',],
            ['id' => 17, 'title' => 'user_create',],
            ['id' => 18, 'title' => 'user_edit',],
            ['id' => 19, 'title' => 'user_view',],
            ['id' => 20, 'title' => 'user_delete',],
            ['id' => 21, 'title' => 'user_action_access',],
            ['id' => 22, 'title' => 'user_action_create',],
            ['id' => 23, 'title' => 'user_action_edit',],
            ['id' => 24, 'title' => 'user_action_view',],
            ['id' => 25, 'title' => 'user_action_delete',],
            ['id' => 26, 'title' => 'internal_notification_access',],
            ['id' => 27, 'title' => 'internal_notification_create',],
            ['id' => 28, 'title' => 'internal_notification_edit',],
            ['id' => 29, 'title' => 'internal_notification_view',],
            ['id' => 30, 'title' => 'internal_notification_delete',],
            ['id' => 31, 'title' => 'task_status_access',],
            ['id' => 32, 'title' => 'task_status_create',],
            ['id' => 33, 'title' => 'task_status_edit',],
            ['id' => 34, 'title' => 'task_status_view',],
            ['id' => 35, 'title' => 'task_status_delete',],
            ['id' => 36, 'title' => 'task_management_access',],
            ['id' => 37, 'title' => 'task_management_create',],
            ['id' => 38, 'title' => 'task_management_edit',],
            ['id' => 39, 'title' => 'task_management_view',],
            ['id' => 40, 'title' => 'task_management_delete',],
            ['id' => 41, 'title' => 'task_tag_access',],
            ['id' => 42, 'title' => 'task_tag_create',],
            ['id' => 43, 'title' => 'task_tag_edit',],
            ['id' => 44, 'title' => 'task_tag_view',],
            ['id' => 45, 'title' => 'task_tag_delete',],
            ['id' => 46, 'title' => 'task_access',],
            ['id' => 47, 'title' => 'task_create',],
            ['id' => 48, 'title' => 'task_edit',],
            ['id' => 49, 'title' => 'task_view',],
            ['id' => 50, 'title' => 'task_delete',],
            ['id' => 51, 'title' => 'task_calendar_access',],
            ['id' => 52, 'title' => 'task_calendar_create',],
            ['id' => 53, 'title' => 'task_calendar_edit',],
            ['id' => 54, 'title' => 'task_calendar_view',],
            ['id' => 55, 'title' => 'task_calendar_delete',],
            ['id' => 56, 'title' => 'tour_program_access',],
            ['id' => 57, 'title' => 'tour_program_create',],
            ['id' => 58, 'title' => 'tour_program_edit',],
            ['id' => 59, 'title' => 'tour_program_view',],
            ['id' => 60, 'title' => 'tour_program_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
