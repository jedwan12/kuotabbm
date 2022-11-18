<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\GasStation;

class GasStationController extends Controller
{
    //
    public function index(){
        $gas_station = GasStation::all()->where('status','active');
        return response()->json($gas_station,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'name_pt' => 'required',
            'location' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $gas_station = new GasStation;
        $gas_station->timestamps = false;
        $gas_station->name_pt = $request->name_pt;
        $gas_station->location = $request->location;

        $gas_station->save();
        return response()->json(["data" => $gas_station, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'name_pt' => 'required',
            'location' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $gas_station = GasStation::find($id);
        $gas_station->timestamps = false;
        $gas_station->name_pt = $request->name_pt;
        $gas_station->location = $request->location;

        $gas_station->save();
        return response()->json(["data" => $gas_station, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

public function get_data_by_id($id){
    $gas_station= GasStation::find($id);
    return response()->json(["data" => $gas_station, "message" => "Ok"], 200);
}

public function delete($id)
    {
        try{
        $gas_station = GasStation::find($id);
        $gas_station->status = 'deleted';

        $gas_station->save();
        return response()->json(["data" => $gas_station, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
