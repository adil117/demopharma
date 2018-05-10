<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('tasks', 'TasksController', ['except' => ['create', 'edit']]);

        Route::resource('permissions', 'PermissionsController', ['except' => ['create', 'edit']]);

        Route::resource('task_statuses', 'TaskStatusesController', ['except' => ['create', 'edit']]);

        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        Route::resource('task_tags', 'TaskTagsController', ['except' => ['create', 'edit']]);

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('user_actions', 'UserActionsController', ['except' => ['create', 'edit']]);

        Route::resource('tour_programs', 'TourProgramsController', ['except' => ['create', 'edit']]);

});
