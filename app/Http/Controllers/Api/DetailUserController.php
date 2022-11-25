<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\DetailUser;
use App\Models\DetailVehicle;
use App\Models\Position;
use App\Models\User;
use App\Models\Role;

class DetailUserController extends Controller
{
    //
    public function index(){
        $detail_user = DetailUser::with(['position','business_unit', 'user'])->where('status','active')->paginate(5, ['*'],'page',request('page'));
        return response()->json($detail_user,200);
    }

    public function store(Request $request)
    {
        try{
        $rules = [
            'nip' => 'required',
            'name' => 'required',
            'position_id' => 'required',
            'business_unit_id' => 'required',
            'phone_number' => 'required',
            // 'detail_vehicle_id' => '',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $position = Position::find($request->position_id);
        $role = Role::where('name',$position->name)->first();
        // return response()->json($role,200);
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->is_active = 1;
        $user->is_ldap = 0;
        $user->role_id = $role->id;

        $user->save();

        $this->validate($request, $rules, $messages);
        $detail_user = new DetailUser;
        $detail_user->timestamps = false;
        $detail_user->nip = $request->nip;
        $detail_user->position_id = $request->position_id;
        $detail_user->business_unit_id = $request->business_unit_id;
        $detail_user->phone_number = $request->phone_number;
        // $detail_user->detail_vehicle_id = $request->detail_vehicle_id;
        $detail_user->user_id = $user->id;


        $detail_user->save();
        return response()->json(["data" => $detail_user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'nip' => 'required',
            'name' => 'required',
            'position_id' => 'required',
            'business_unit_id' => 'required',
            'phone_number' => 'required',
            // 'detail_vehicle_id' => 'required'

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );

        $this->validate($request, $rules, $messages);
        $position = Position::find($request->position_id);
        $role = Role::where('name',$position->name)->first();

        $detail_user = DetailUser::find($id);
        $detail_user->timestamps = false;
        $detail_user->nip = $request->nip;
        $detail_user->position_id = $request->position_id;
        $detail_user->business_unit_id = $request->business_unit_id;
        $detail_user->phone_number = $request->phone_number;
        $detail_user->save();

        $user =  User::find($detail_user->user_id);
        $user->name = $request->name;
        $user->role_id = $role->id;
        $user->save();

        // $detail_user->detail_vehicle_id = $request->detail_vehicle_id;



        return response()->json(["data" => $detail_user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

public function get_data_by_id($id){
    $detail_user= DetailUser::with(['user'])->find($id);
    return response()->json(["data" => $detail_user, "message" => "Ok"], 200);
}

public function delete($id)
    {
        try{
        $detail_user = DetailUser::find($id);
        $detail_user->status = 'deleted';

        $detail_user->save();
        return response()->json(["data" => $detail_user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}


}
