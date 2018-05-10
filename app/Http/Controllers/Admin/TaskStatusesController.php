<?php

namespace App\Http\Controllers\Admin;

use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTaskStatusesRequest;
use App\Http\Requests\Admin\UpdateTaskStatusesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TaskStatusesController extends Controller
{
    /**
     * Display a listing of TaskStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = TaskStatus::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'task_statuses.id',
                'task_statuses.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'task_status_';
                $routeKey = 'admin.task_statuses';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.task_statuses.index');
    }

    /**
     * Show the form for creating new TaskStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task_statuses.create');
    }

    /**
     * Store a newly created TaskStatus in storage.
     *
     * @param  \App\Http\Requests\StoreTaskStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskStatusesRequest $request)
    {
        $task_status = TaskStatus::create($request->all());



        return redirect()->route('admin.task_statuses.index');
    }


    /**
     * Show the form for editing TaskStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_status = TaskStatus::findOrFail($id);

        return view('admin.task_statuses.edit', compact('task_status'));
    }

    /**
     * Update TaskStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskStatusesRequest $request, $id)
    {
        $task_status = TaskStatus::findOrFail($id);
        $task_status->update($request->all());



        return redirect()->route('admin.task_statuses.index');
    }


    /**
     * Display TaskStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = \App\Task::where('status_id', $id)->get();

        $task_status = TaskStatus::findOrFail($id);

        return view('admin.task_statuses.show', compact('task_status', 'tasks'));
    }


    /**
     * Remove TaskStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task_status = TaskStatus::findOrFail($id);
        $task_status->delete();

        return redirect()->route('admin.task_statuses.index');
    }

    /**
     * Delete all selected TaskStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = TaskStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
