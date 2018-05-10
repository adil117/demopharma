<?php

namespace App\Http\Controllers\Api\V1;

use App\UserAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserActionsRequest;
use App\Http\Requests\Admin\UpdateUserActionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UserActionsController extends Controller
{
    public function index()
    {
        return UserAction::all();
    }

    public function show($id)
    {
        return UserAction::findOrFail($id);
    }

    public function update(UpdateUserActionsRequest $request, $id)
    {
        $user_action = UserAction::findOrFail($id);
        $user_action->update($request->all());
        

        return $user_action;
    }

    public function store(StoreUserActionsRequest $request)
    {
        $user_action = UserAction::create($request->all());
        

        return $user_action;
    }

    public function destroy($id)
    {
        $user_action = UserAction::findOrFail($id);
        $user_action->delete();
        return '';
    }
}
