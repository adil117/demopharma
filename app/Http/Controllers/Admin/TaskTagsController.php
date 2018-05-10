<?php

namespace App\Http\Controllers\Admin;

use App\TaskTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTaskTagsRequest;
use App\Http\Requests\Admin\UpdateTaskTagsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TaskTagsController extends Controller
{
    /**
     * Display a listing of TaskTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        if (request()->ajax()) {
            $query = TaskTag::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'task_tags.id',
                'task_tags.name',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'task_tag_';
                $routeKey = 'admin.task_tags';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.task_tags.index');
    }

    /**
     * Show the form for creating new TaskTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.task_tags.create');
    }

    /**
     * Store a newly created TaskTag in storage.
     *
     * @param  \App\Http\Requests\StoreTaskTagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskTagsRequest $request)
    {
        $task_tag = TaskTag::create($request->all());



        return redirect()->route('admin.task_tags.index');
    }


    /**
     * Show the form for editing TaskTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_tag = TaskTag::findOrFail($id);

        return view('admin.task_tags.edit', compact('task_tag'));
    }

    /**
     * Update TaskTag in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskTagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskTagsRequest $request, $id)
    {
        $task_tag = TaskTag::findOrFail($id);
        $task_tag->update($request->all());



        return redirect()->route('admin.task_tags.index');
    }


    /**
     * Display TaskTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = \App\Task::whereHas('tag',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $task_tag = TaskTag::findOrFail($id);

        return view('admin.task_tags.show', compact('task_tag', 'tasks'));
    }


    /**
     * Remove TaskTag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task_tag = TaskTag::findOrFail($id);
        $task_tag->delete();

        return redirect()->route('admin.task_tags.index');
    }

    /**
     * Delete all selected TaskTag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = TaskTag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
