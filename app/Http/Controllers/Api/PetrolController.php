<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Petrol;

class PetrolController extends Controller
{
    //
    public function index(){
        $petrol = Petrol::all();
        return response()->json($petrol,200);
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
        $petrol = new Petrol;
        $petrol->timestamps = false;
        $petrol->type = $request->type;

        $petrol->save();
        return response()->json(["data" => $petrol, "message" => "Ok"], 200);
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
        $petrol = Petrol::find($id);
        $petrol->timestamps = false;
        $petrol->type = $request->type;

        $petrol->save();
        return response()->json(["data" => $petrol, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}


}
