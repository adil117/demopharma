<?php

namespace App\Http\Controllers\Api\V1;

use App\TourProgram;
use Illuminate\Http\Request;
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
    public function index()
    {
        return TourProgram::all();
    }

    public function show($id)
    {
        return TourProgram::findOrFail($id);
    }

    public function update(UpdateTourProgramsRequest $request, $id)
    {
        $tour_program = TourProgram::findOrFail($id);
        $tour_program->update($request->all());
        

        return $tour_program;
    }

    public function store(StoreTourProgramsRequest $request)
    {
        $tour_program = TourProgram::create($request->all());
        

        return $tour_program;
    }

    public function destroy($id)
    {
        $tour_program = TourProgram::findOrFail($id);
        $tour_program->delete();
        return '';
    }
}
