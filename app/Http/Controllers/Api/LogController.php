<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use App\Models\Log;
class LogController extends Controller
{
    //
    public function index(){
        $log = Log::with(['detail_vehicle','gas_station','transaction_type', 'detail_vehicle.petrol', 'detail_vehicle.user'])->paginate();
        return response()->json($log,200);
    }

    public function store(Request $request)
    {
        try{
        $rules = [
            'transaction_type_id' => 'required',
            'quota' => 'required',
            'gas_station_id' => '',
            'detail_vehicle_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $log = new Log;
        $log->transaction_type_id = $request->transaction_type_id;
        $log->quota = $request->quota;
        $log->gas_station_id = $request->gas_station_id ?? NULL;
        $log->detail_vehicle_id = $request->detail_vehicle_id;

        $log->save();
        return response()->json(["data" => $log, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'transaction_type_id' => 'required',
            'quota' => 'required',
            'gas_station_id' => '',
            'detail_vehicle_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $log = Log::find($id);
        $log->transaction_type_id = $request->transaction_type_id;
        $log->quota = $request->quota;
        $log->gas_station_id = $request->gas_station_id ?? NULL;
        $log->detail_vehicle_id = $request->detail_vehicle_id;

        $log->save();
        return response()->json(["data" => $log, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}




}
