<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\ManagementQuota;
use App\Models\Log;
use App\Models\DetailDistribution;
use App\Models\DetailVehicle;

class ManagementQuotaController extends Controller
{
    public function index(){
        $management_quota = ManagementQuota::with(['detail_distribution.detail_vehicle', 'detail_distribution.detail_vehicle.petrol', 'detail_distribution.detail_vehicle.business_unit', 'detail_distribution.detail_vehicle.user'])->paginate();
        return response()->json($management_quota,200);
    }
    // public function indexpengajuan(){
    //     $management_quota = management_quota::with(['detail_vehicle','gas_station','transaction_type', 'detail_vehicle.petrol', 'detail_vehicle.business_unit', 'detail_vehicle.user'])->where('management_type_id',2)->paginate();
    //     return response()->json($management_quota,200);
    // }

    public function store(Request $request)
    {
        try{
        $rules = [
            'quota' => 'required',
            'detail_distribution_id' => 'required',
            'note' => 'required',
            // 'updated_by' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $management_quota = new ManagementQuota;
        $management_quota->quota = $request->quota;
        $management_quota->note = $request->note;
        // $management_quota->gas_station_id = $request->gas_station_id ?? NULL;
        $management_quota->detail_distribution_id = $request->detail_distribution_id;

        $management_quota->save();
        return response()->json(["data" => $management_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
//     public function edit(Request $request, $id)
//     {
//         try{
//         $rules = [
//             'quota' => 'required',
//             'note' => 'required',
//             'detail_distribution_id' => 'required',
//             'updated_by' => 'required',

//         ];
//         $messages = array(
//             'required' => 'The :attribute field is required.',
//         );
//         $this->validate($request, $rules, $messages);
//         $management_quota = ManagementQuota::find($id);
//         $management_quota->quota = $request->quota;
//         // $management_quota->gas_station_id = $request->gas_station_id ?? NULL;
//         $management_quota->detail_distribution_id = $request->detail_distribution_id;

//         $management_quota->save();
//         return response()->json(["data" => $management_quota, "message" => "Ok"], 200);
//     } catch (Exception $e) {
//         return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
//     }

// }

    public function add_quota(Request $request, $id)
    {
        try{
        $rules = [
            'quota' => 'required',
            'note' => 'required',
            'detail_distribution_id' => 'required',
            'updated_by' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $management_quota = new ManagementQuota;
        // return response()->json(["data" => $management_quota, "message" => "Ok"], 200);
        $management_quota->quota = $request->quota;
        // $management_quota->gas_station_id = $request->gas_station_id ?? NULL;
        $management_quota->detail_distribution_id = $request->detail_distribution_id;
        $management_quota->note = $request->note;
        $management_quota->updated_by = $request->updated_by;

        $management_quota->save();

        $detail_distribution = DetailDistribution::find($request->detail_distribution_id);
        $detail_distribution->quota = ((int) $detail_distribution->quota + (int)$request->quota);

        $detail_distribution->save();

        $this->validate($request, $rules, $messages);
        $log =  new Log;
        $log->transaction_type_id = 2;
        $log->management_type_id = 1;
        $log->quota = $management_quota->quota;
        $log->note = $management_quota->note;
        $log->detail_distribution_id = $management_quota->detail_distribution_id;
        $log->updated_by = $management_quota->updated_by;
        $log->save();
        return response()->json(["data" => $management_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

    public function reduce_quota(Request $request, $id)
    {
        try{
        $rules = [
            'quota' => 'required',
            'note' => 'required',
            'detail_distribution_id' => 'required',
            'updated_by' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $management_quota = ManagementQuota::find($id);
        $management_quota->quota = $request->quota;
        // $management_quota->gas_station_id = $request->gas_station_id ?? NULL;
        $management_quota->detail_distribution_id = $request->detail_distribution_id;
        $management_quota->note = $request->note;
        $management_quota->updated_by = $request->updated_by;

        $management_quota->save();

        $detail_distribution = DetailDistribution::find($request->detail_distribution_id);
        $detail_distribution->quota = ((int) $detail_distribution->quota - (int)$request->quota);

        $detail_distribution->save();

        $this->validate($request, $rules, $messages);
        $log =  new Log;
        $log->transaction_type_id = 1;
        $log->management_type_id = 1;
        $log->quota = $management_quota->quota;
        $log->note = $management_quota->note;
        $log->detail_distribution_id = $management_quota->detail_distribution_id;
        $log->updated_by = $management_quota->updated_by;
        $log->save();
        return response()->json(["data" => $management_quota, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

}
