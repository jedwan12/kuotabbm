<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(){
        $user = User::with(['role'])->paginate(5, ['*'],'page',request('page'));
        return response()->json($user,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $role = Role::find($request->role_id);
        $this->validate($request, $rules, $messages);
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->is_active = 1;
        $user->is_ldap = 0;
        $user->role_id = $request->role_id;
        $user->gas_station_id = $request->gas_station_id ?? NULL;
        $user->updated_by = Null;

        $user->save();

        return response()->json(["data" => $user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            'is_active' => 'required',
            'is_ldap' => 'required',
            'role_id' => 'required',
            'updated_by' => 'required'

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_active = $request->is_active;
        $user->is_ldap = $request->is_ldap;
        $user->role_id = $request->role_id;
        $user->gas_station_id = $request->gas_station_id ?? NULL;
        $user->updated_by = $request->updated_by;

        $user->save();
        return response()->json(["data" => $user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

public function get_data_by_id($id){
    $user= User::with(['role'])->find($id);
    return response()->json(["data" => $user, "message" => "Ok"], 200);
}

}
