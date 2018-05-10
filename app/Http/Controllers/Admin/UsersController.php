<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('User.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('User.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = User::query();
            $query->with("role");
            $query->with("created_by");
            $template = 'actionsTemplate';
            
            $query->select([
                'users.id',
                'users.name',
                'users.email',
                'users.password',
                'users.remember_token',
                'users.created_by_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_';
                $routeKey = 'admin.users';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('password', function ($row) {
                return '---';
            });
            $table->editColumn('role.title', function ($row) {
                if(count($row->role) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->role->pluck('title')->toArray()) . '</span>';
            });
            $table->editColumn('remember_token', function ($row) {
                return $row->remember_token ? $row->remember_token : '';
            });
            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions','role.title']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.users.create', compact('roles', 'created_bies'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $user = User::create($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles', 'created_bies'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->role()->sync(array_filter((array)$request->input('role')));



        return redirect()->route('admin.users.index');
    }


    /**
     * Display User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $roles = \App\Role::get()->pluck('title', 'id');

        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$user_actions = \App\UserAction::where('user_id', $id)->get();$tour_programs = \App\TourProgram::where('created_by_id', $id)->get();$internal_notifications = \App\InternalNotification::whereHas('users',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$users = \App\User::where('created_by_id', $id)->get();$tasks = \App\Task::where('user_id', $id)->get();

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user', 'user_actions', 'tour_programs', 'internal_notifications', 'users', 'tasks'));
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
