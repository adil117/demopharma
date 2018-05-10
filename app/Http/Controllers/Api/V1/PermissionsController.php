<?php

namespace App\Http\Controllers\Api\V1;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionsRequest;
use App\Http\Requests\Admin\UpdatePermissionsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PermissionsController extends Controller
{
    public function index()
    {
        return Permission::all();
    }

    public function show($id)
    {
        return Permission::findOrFail($id);
    }

    public function update(UpdatePermissionsRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        

        return $permission;
    }

    public function store(StorePermissionsRequest $request)
    {
        $permission = Permission::create($request->all());
        

        return $permission;
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return '';
    }
}
