<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\DetailDistribution;

class DetailDistributionController extends Controller
{
    public function index($id, $userid){
        $detail_distribution = DetailDistribution::with(['distribution','detail_vehicle', 'detail_vehicle.detail_user', 'detail_vehicle.detail_user.position',
        'detail_vehicle.detail_user.business_unit', 'detail_vehicle.vehicle_type' ,'detail_vehicle.business_unit', 'detail_vehicle.petrol', 'detail_vehicle.user'])
        ->join('detail_vehicles' , 'detail_vehicles.id','=', 'detail_vehicle_id')->select('detail_distributions.*')->user(['user' => $userid])
        ->where('detail_distributions.status','active')->where('distribution_id', $id)->paginate();
        return response()->json($detail_distribution,200);
    }
    public function store(Request $request)
    {
        try{
        $rules = [
            'detail_vehicle_id' => 'required',
            'distribution_id' => 'required',
            // 'quota' => '',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $detail_distribution = new DetailDistribution;
        // $detail_distribution->timestamps = false;
        $detail_distribution->detail_vehicle_id = $request->detail_vehicle_id;
        $detail_distribution->distribution_id = $request->distribution_id;
        $detail_distribution->quota = $request->quota ?? NULL;


        $detail_distribution->save();

        return response()->json(["data" => $detail_distribution, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

    public function edit(Request $request ,$id){
        try{
            $detail_distribution = DetailDistribution::find($id);
            $detail_distribution->timestamps = false;
            $detail_distribution->detail_vehicle_id = $request->detail_vehicle_id ?? $detail_distribution->detail_vehicle_id;
            $detail_distribution->distribution_id = $request->distribution_id ?? $detail_distribution->distribution_id;

            $detail_distribution->quota = $request->quota  ?? $detail_distribution->quota;


            $detail_distribution->save();
            return response()->json(["data" => $detail_distribution, "message" => "Ok"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
        }
    }

    public function get_data_by_id($id){
        $detail_distribution= DetailDistribution::with(['distribution','detail_vehicle', 'detail_vehicle.detail_user', 'detail_vehicle.detail_user.position',
        'detail_vehicle.detail_user.business_unit', 'detail_vehicle.vehicle_type' ,'detail_vehicle.business_unit', 'detail_vehicle.petrol', 'detail_vehicle.user'])->find($id);
        return response()->json(["data" => $detail_distribution, "message" => "Ok"], 200);
    }

    public function vehicle_by_id($id){
        $detail_vehicle = DetailVehicle::with(['detail_user','vehicle_type','user','business_unit', 'petrol'])->where('user_id',$id)->paginate();
        return response()->json($detail_vehicle,200);
    }

    // public function distribution_by_id($id){
    //     $detail_distribution = DetailDistribution::with(['distribution','user','business_unit', 'petrol'])->where('user_id',$id)->paginate();
    //     return response()->json($detail_distribution,200);
    // }

    // public function vehicle_by_id($id){
    //     $detail_distribution = DetailDistribution::with([ 'detail_user','vehicle_type','user','business_unit', 'petrol'])->where('user_id',$id)->paginate();
    //     return response()->json($detail_vehicle,200);
    // }

    public function delete($id)
    {
        try{
        $detail_distribution = DetailDistribution::find($id);
        $detail_distribution->status = 'deleted';

        $detail_distribution->save();
        return response()->json(["data" => $detail_distribution, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
}
