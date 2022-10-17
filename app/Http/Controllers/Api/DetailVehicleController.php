<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\DetailVehicle;

class DetailVehicleController extends Controller
{
    //
    public function index(){
        $detail_vehicle = DetailVehicle::with(['vehicle_type','user','business_unit', 'petrol'])->paginate();
        return response()->json($detail_vehicle,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'car_name' => 'required',
            'vehicle_type_id' => 'required',
            'plat_number' => 'required',
            'business_unit_id' => 'required',
            'petrol_id' => 'required',
            'user_id' => 'required',
            // 'quota' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $detail_vehicle = new DetailVehicle;
        $detail_vehicle->timestamps = false;
        $detail_vehicle->car_name = $request->car_name;
        $detail_vehicle->vehicle_type_id = $request->vehicle_type_id;
        $detail_vehicle->plat_number = $request->plat_number;
        $detail_vehicle->business_unit_id = $request->business_unit_id;
        $detail_vehicle->petrol_id = $request->petrol_id;
        $detail_vehicle->user_id = $request->user_id;
        $detail_vehicle->quota = 0;


        $detail_vehicle->save();
        return response()->json(["data" => $detail_vehicle, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request ,$id){
        try{
            // $rules = [
            //     'car_name' => 'required',
            //     'vehicle_type_id' => 'required',
            //     'plat_number' => 'required',
            //     'business_unit_id' => 'required',
            //     'petrol_id' => 'required',
            //     'user_id' => 'required',
            //     'quota' => 'required',

            // ];
            // $messages = array(
            //     'required' => 'The :attribute field is required.',
            // );
            // $this->validate($request, $messages);
            $detail_vehicle = DetailVehicle::find($id);
            $detail_vehicle->timestamps = false;
            $detail_vehicle->car_name = $request->car_name ?? $detail_vehicle->car_name;
            $detail_vehicle->vehicle_type_id = $request->vehicle_type_id ?? $detail_vehicle->vehicle_type_id;
            $detail_vehicle->plat_number = $request->plat_number ?? $detail_vehicle->plat_number;
            $detail_vehicle->business_unit_id = $request->business_unit_id ?? $detail_vehicle->business_unit_id;
            $detail_vehicle->petrol_id = $request->petrol_id ?? $detail_vehicle->petrol_id;
            $detail_vehicle->user_id = $request->user_id  ?? $detail_vehicle->user_id;
            $detail_vehicle->quota = $request->quota  ?? $detail_vehicle->quota;


            $detail_vehicle->save();
            return response()->json(["data" => $detail_vehicle, "message" => "Ok"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
        }
    }

    public function get_data_by_id($id){
        $detail_vehicle= DetailVehicle::find($id);
        return response()->json(["data" => $detail_vehicle, "message" => "Ok"], 200);
    }

    public function vehicle_by_id($id){
        $detail_vehicle = DetailVehicle::with(['vehicle_type','user','business_unit', 'petrol'])->where('user_id',$id)->paginate();
        return response()->json($detail_vehicle,200);
    }
}
