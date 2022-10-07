<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\DetailUser;

class DetailUserController extends Controller
{
    //
    public function index(){
        $detail_user = DetailUser::with(['position','business_unit', 'detail_vehicle', 'user'])->paginate();
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
            'detail_vehicle_id' => 'required',
            'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $detail_user = new DetailUser;
        $detail_user->timestamps = false;
        $detail_user->nip = $request->nip;
        $detail_user->name = $request->name;
        $detail_user->position_id = $request->position_id;
        $detail_user->business_unit_id = $request->business_unit_id;
        $detail_user->phone_number = $request->phone_number;
        $detail_user->detail_vehicle_id = $request->detail_vehicle_id;
        $detail_user->user_id = $request->user_id;


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
            'detail_vehicle_id' => 'required',
            'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $detail_user = DetailUser::find($id);
        $detail_user->timestamps = false;
        $detail_user->nip = $request->nip;
        $detail_user->name = $request->name;
        $detail_user->position_id = $request->position_id;
        $detail_user->business_unit_id = $request->business_unit_id;
        $detail_user->phone_number = $request->phone_number;
        $detail_user->detail_vehicle_id = $request->detail_vehicle_id;
        $detail_user->user_id = $request->user_id;


        $detail_user->save();
        return response()->json(["data" => $detail_user, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}




}
