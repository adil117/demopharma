<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTasksRequest;
use App\Http\Requests\Admin\UpdateTasksRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TasksController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = Task::query();
            $query->with("status");
            $query->with("tag");
            $query->with("user");
            $template = 'actionsTemplate';
            
            $query->select([
                'tasks.id',
                'tasks.name',
                'tasks.description',
                'tasks.status_id',
                'tasks.attachment',
                'tasks.due_date',
                'tasks.user_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'task_';
                $routeKey = 'admin.tasks';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('status.name', function ($row) {
                return $row->status ? $row->status->name : '';
            });
            $table->editColumn('tag.name', function ($row) {
                if(count($row->tag) == 0) {
                    return '';
                }

                return '<span class="label label-info label-many">' . implode('</span><span class="label label-info label-many"> ',
                        $row->tag->pluck('name')->toArray()) . '</span>';
            });
            $table->editColumn('attachment', function ($row) {
                if($row->attachment) { return '<a href="'.asset(env('UPLOAD_PATH').'/'.$row->attachment) .'" target="_blank">Download file</a>'; };
            });
            $table->editColumn('due_date', function ($row) {
                return $row->due_date ? $row->due_date : '';
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions','tag.name','attachment']);

            return $table->make(true);
        }

        return view('admin.tasks.index');
    }

    /**
     * Show the form for creating new Task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $statuses = \App\TaskStatus::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $tags = \App\TaskTag::get()->pluck('name', 'id');

        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.tasks.create', compact('statuses', 'tags', 'users'));
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param  \App\Http\Requests\StoreTasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasksRequest $request)
    {
        $request = $this->saveFiles($request);
        $task = Task::create($request->all());
        $task->tag()->sync(array_filter((array)$request->input('tag')));



        return redirect()->route('admin.tasks.index');
    }


    /**
     * Show the form for editing Task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $statuses = \App\TaskStatus::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $tags = \App\TaskTag::get()->pluck('name', 'id');

        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $task = Task::findOrFail($id);

        return view('admin.tasks.edit', compact('task', 'statuses', 'tags', 'users'));
    }

    /**
     * Update Task in storage.
     *
     * @param  \App\Http\Requests\UpdateTasksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTasksRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $task = Task::findOrFail($id);
        $task->update($request->all());
        $task->tag()->sync(array_filter((array)$request->input('tag')));



        return redirect()->route('admin.tasks.index');
    }


    /**
     * Display Task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('admin.tasks.show', compact('task'));
    }


    /**
     * Remove Task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index');
    }

    /**
     * Delete all selected Task at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Task::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
