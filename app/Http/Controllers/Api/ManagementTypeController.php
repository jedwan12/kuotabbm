<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\ManagementType;

class ManagementTypeController extends Controller
{
    public function index(){
        $management_type = ManagementType::all();
        return response()->json($management_type,200);
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
        $management_type = new managementType;
        $management_type->timestamps = false;
        $management_type->type = $request->type;

        $management_type->save();
        return response()->json(["data" => $management_type, "message" => "Ok"], 200);
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
        $management_type = ManagementType::find($id);
        $management_type->timestamps = false;
        $management_type->type = $request->type;

        $management_type->save();
        return response()->json(["data" => $management_type, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
