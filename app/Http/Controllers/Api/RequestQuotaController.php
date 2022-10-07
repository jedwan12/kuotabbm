<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\RequestQuota;


class RequestQuotaController extends Controller
{
    //
    public function index(){
        $request_quota = RequestQuota::with(['user','detail_vehicle', 'detail_vehicle.petrol' ,'detail_vehicle.business_unit'])->paginate();
        return response()->json($request_quota,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'total_request' => 'required',
            'approval1' => '',
            'approval2' => '',
            'detail_vehicle_id' => 'required',
            'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $request_quota = new RequestQuota;
        $request_quota->total_request = $request->total_request;
        $request_quota->approval1 = $request->approval1;
        $request_quota->approval2 = $request->approval2;
        $request_quota->detail_vehicle_id = $request->detail_vehicle_id;
        $request_quota->user_id = $request->user_id;



        $request_quota->save();
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'total_request' => 'required',
            'approval1' => 'required',
            'approval2' => 'required',
            'detail_vehicle_id' => 'required',
            'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $request_quota = RequestQuota::find($id);
        $request_quota->total_request = $request->total_request;
        $request_quota->approval1 = $request->approval1;
        $request_quota->approval2 = $request->approval2;
        $request_quota->detail_vehicle_id = $request->detail_vehicle_id;
        $request_quota->user_id = $request->user_id;



        $request_quota->save();
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
