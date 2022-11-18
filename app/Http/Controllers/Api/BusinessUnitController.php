<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\BusinessUnit;

class BusinessUnitController extends Controller
{
    //
    public function index(){
        $business_unit = BusinessUnit::all()->where('status','active');
        return response()->json($business_unit,200);
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
        $business_unit = new BusinessUnit;
        $business_unit->timestamps = false;
        $business_unit->name = $request->name;

        $business_unit->save();
        return response()->json(["data" => $business_unit, "message" => "Ok"], 200);
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
        $business_unit = BusinessUnit::find($id);
        $business_unit->timestamps = false;
        $business_unit->name = $request->name;

        $business_unit->save();
        return response()->json(["data" => $business_unit, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

public function get_data_by_id($id){
    $business_unit= BusinessUnit::find($id);
    return response()->json(["data" => $business_unit, "message" => "Ok"], 200);
}

public function delete($id)
    {
        try{
        $business_unit = BusinessUnit::find($id);
        $business_unit->status = 'deleted';

        $business_unit->save();
        return response()->json(["data" => $business_unit, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}



}
