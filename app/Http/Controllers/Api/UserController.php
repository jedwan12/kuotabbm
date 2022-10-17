<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $user = User::with(['role'])->paginate();
        return response()->json($user,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_active' => 'required',
            'is_ldap' => 'required',
            'role_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_active = $request->is_active;
        $user->is_ldap = $request->is_ldap;
        $user->role_id = $request->role_id;

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
            'email' => 'required',
            'password' => 'required',
            'is_active' => 'required',
            'is_ldap' => 'required',
            'role_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->is_active = $request->is_active;
        $user->is_ldap = $request->is_ldap;
        $user->role_id = $request->role_id;

        $user->save();
        return response()->json(["data" => $user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
