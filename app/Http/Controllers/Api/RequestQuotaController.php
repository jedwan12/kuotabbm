<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\RequestQuota;
use App\Models\Log;
use App\Models\DetailDistribution;
use App\Models\DetailVehicle;


class RequestQuotaController extends Controller
{
    //
    public function index(){
        $request_quota = RequestQuota::with(['detail_distribution', 'detail_distribution.detail_vehicle.user' ,'detail_distribution.detail_vehicle', 'detail_distribution.detail_vehicle.petrol' ,'detail_distribution.detail_vehicle.business_unit'])->latest()->paginate(10);
        return response()->json($request_quota,200);
    }

    public function store(Request $request)
    {
        try{
        $rules = [
            'total_request' => 'required',
            'reason_request' => 'required',
            // 'is_approval1' => '',
            // 'is_approval2' => '',

            'detail_distribution_id' => 'required',
            // 'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $request_quota = new RequestQuota;
        $request_quota->total_request = $request->total_request;
        $request_quota->is_approval = NULL;
        $request_quota->reason_request = $request->reason_request;
        $request_quota->detail_distribution_id = $request->detail_distribution_id;
        $request_quota->save();
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage() , 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request, $id)
    {
        try{
        $rules = [
            'total_request' => 'required',
            'is_approval' => 'required',
            // 'is_approval2' => 'required',
            'detail_distribution_id' => 'required',
            'updated_by'=>'required',
            'user_id' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $request_quota = RequestQuota::find($id);
        $request_quota->total_request = $request->total_request;
        $request_quota->is_approval = $request->is_approval;
        // $request_quota->is_approval2 = $request->is_approval2;
        $request_quota->detail_distribution_id = $request->detail_distribution_id;
        $request_quota->updated_by = $request->updated_by;
        $request_quota->user_id = $request->user_id;
        $request_quota->save();
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

    public function approval(Request $request,$status, $id)
    {
        try{

        $request_quota = RequestQuota::find($id);

        $request_quota->is_approval = $status;
        // $request_quota->note = $request->note;
        // $request_quota->total_request = $request->total_request;
        $request_quota->save();
        // return response()->json(["data" => (int)$request_quota->total_request, "message" => "Ok"], 200);
        if($status){
            $detail_distribution = DetailDistribution::find($request_quota->detail_distribution_id);
            $detail_distribution->quota = ((int) $detail_distribution->quota + (int)$request_quota->total_request);

            $detail_distribution->save();

             $log = new Log;
             $log->transaction_type_id = 2;
             $log->management_type_id = 2;
             $log->quota =  $request_quota->total_request;
             $log->note =  $request->note;
             $log->detail_distribution_id =  $request_quota->detail_distribution_id;
             $log->updated_by = $request_quota->updated_by;
             $log->save();
        }
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }
}

    public function reject(Request $request, $id)
    {
        try{

        $request_quota = RequestQuota::find($id);

        $request_quota->is_approval = 0;
        $request_quota->reason_reject = $request->reason_reject;
        // $request_quota->total_request = $request->total_request;
        $request_quota->save();
        return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }
}

//     public function is_approval2($status, $id)
//     {
//         try{
//         $request_quota = RequestQuota::find($id);
//         $request_quota->is_approval2 = $status;

//         $request_quota->save();
//         return response()->json(["data" => $request_quota, "message" => "Ok"], 200);
//     } catch (Exception $e) {
//         return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
//     }

// }

    public function request_quota_by_id($id){
        $request_quota = RequestQuota::with(['detail_distribution.detail_vehicle','detail_distribution.detail_vehicle.user', 'detail_distribution.detail_vehicle.petrol', 'detail_distribution.detail_vehicle.business_unit'])->where('user_id',$id)->paginate();
        return response()->json($request_quota,200);
    }

}
