<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    //
    public function index(){
        $vehicle_type = VehicleType::all();
        return response()->json([$vehicle_type],200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'type' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $vehicle_type = new VehicleType;
        $vehicle_type->timestamps = false;
        $vehicle_type->type = $request->type;

        $vehicle_type->save();
        return response()->json(["data" => $vehicle_type, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'type' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $vehicle_type = VehicleType::find($id);
        $vehicle_type->timestamps = false;
        $vehicle_type->type = $request->type;

        $vehicle_type->save();
        return response()->json(["data" => $vehicle_type, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
