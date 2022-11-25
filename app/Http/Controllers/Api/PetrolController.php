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
        $petrol = Petrol::where('status','active')->paginate(5, ['*'],'page',request('page'));
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

public function get_data_by_id($id){
    $petrol= Petrol::find($id);
    return response()->json(["data" => $petrol, "message" => "Ok"], 200);
}

public function delete($id)
    {
        try{
        $petrol = Petrol::find($id);
        $petrol->status = 'deleted';

        $petrol->save();
        return response()->json(["data" => $petrol, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
