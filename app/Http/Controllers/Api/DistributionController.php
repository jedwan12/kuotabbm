<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Distribution;

class DistributionController extends Controller
{
    public function index(){
        $distribution = Distribution::with([])->where('status','active')->paginate();
        return response()->json($distribution,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'start_date' => 'required',
            'end_date' => 'required',
            'total_quota' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $distribution = new Distribution;
        $distribution->timestamps = false;
        $distribution->start_date = $request->start_date;
        $distribution->end_date = $request->end_date;
        $distribution->total_quota = $request->total_quota;

        $distribution->save();
        return response()->json(["data" => $distribution, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'start_date' => 'required',
            'end_date' => 'required',
            'total_quota' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $distribution = Distribution::find($id);
        $distribution->timestamps = false;
        $distribution->start_date = $request->start_date;
        $distribution->end_date = $request->end_date;
        $distribution->total_quota = $request->total_quota;

        $distribution->save();
        return response()->json(["data" => $distribution, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

public function get_data_by_id($id){
    $distribution= Distribution::find($id);
    return response()->json(["data" => $distribution, "message" => "Ok"], 200);
}

public function delete($id)
    {
        try{
        $distribution = Distribution::find($id);
        $distribution->status = 'deleted';

        $distribution->save();
        return response()->json(["data" => $distribution, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
}
