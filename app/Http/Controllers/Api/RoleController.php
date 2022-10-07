<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index(){
        $role = Role::all();
        return response()->json([$role],200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'name' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $role = new Role;
        $role->timestamps = false;
        $role->name = $request->name;

        $role->save();
        return response()->json(["data" => $role, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'name' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $role = Role::find($id);
        $role->timestamps = false;
        $role->name = $request->name;

        $role->save();
        return response()->json(["data" => $role, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}



}
