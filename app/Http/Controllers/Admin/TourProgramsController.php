<?php

namespace App\Http\Controllers\Admin;

use App\TourProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTourProgramsRequest;
use App\Http\Requests\Admin\UpdateTourProgramsRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TourProgramsController extends Controller
{
    /**
     * Display a listing of TourProgram.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('TourProgram.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('TourProgram.filter', 'my');
            }
        }

        
        if (request()->ajax()) {
            $query = TourProgram::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'tour_programs.id',
                'tour_programs.month',
                'tour_programs.select_date',
                'tour_programs.medical_representative_name',
                'tour_programs.area',
                'tour_programs.modification',
                'tour_programs.remarks',
                'tour_programs.work_with_manager',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'tour_program_';
                $routeKey = 'admin.tour_programs';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.tour_programs.index');
    }

    /**
     * Show the form for creating new TourProgram.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        $enum_month = TourProgram::$enum_month;
            
        return view('admin.tour_programs.create', compact('enum_month'));
    }

    /**
     * Store a newly created TourProgram in storage.
     *
     * @param  \App\Http\Requests\StoreTourProgramsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourProgramsRequest $request)
    {
        $tour_program = TourProgram::create($request->all());



        return redirect()->route('admin.tour_programs.index');
    }


    /**
     * Show the form for editing TourProgram.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        $enum_month = TourProgram::$enum_month;
            
        $tour_program = TourProgram::findOrFail($id);

        return view('admin.tour_programs.edit', compact('tour_program', 'enum_month'));
    }

    /**
     * Update TourProgram in storage.
     *
     * @param  \App\Http\Requests\UpdateTourProgramsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourProgramsRequest $request, $id)
    {
        $tour_program = TourProgram::findOrFail($id);
        $tour_program->update($request->all());



        return redirect()->route('admin.tour_programs.index');
    }


    /**
     * Display TourProgram.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour_program = TourProgram::findOrFail($id);

        return view('admin.tour_programs.show', compact('tour_program'));
    }


    /**
     * Remove TourProgram from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_program = TourProgram::findOrFail($id);
        $tour_program->delete();

        return redirect()->route('admin.tour_programs.index');
    }

    /**
     * Delete all selected TourProgram at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = TourProgram::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore TourProgram from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $tour_program = TourProgram::onlyTrashed()->findOrFail($id);
        $tour_program->restore();

        return redirect()->route('admin.tour_programs.index');
    }

    /**
     * Permanently delete TourProgram from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        $tour_program = TourProgram::onlyTrashed()->findOrFail($id);
        $tour_program->forceDelete();

        return redirect()->route('admin.tour_programs.index');
    }
}
