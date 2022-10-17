<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Position;

class PositionController extends Controller
{
    //
    public function index(){
        $position = Position::all();
        return response()->json($position,200);
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
        $position = new Position;
        $position->timestamps = false;
        $position->name = $request->name;

        $position->save();
        return response()->json(["data" => $position, "message" => "Ok"], 200);
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
        $position = Position::find($id);
        $position->timestamps = false;
        $position->name = $request->name;

        $position->save();
        return response()->json(["data" => $position, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}



}
