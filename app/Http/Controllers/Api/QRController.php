<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\QR;

class QRController extends Controller
{

    public function index(){
        $qr = QR::with(['vehicle_type','user','business_unit', 'petrol'])->where('status','active')->paginate();
        return response()->json($qr,200);
    }
    public function generate_qr(Request $request)
    {
        try{
        $rules = [
            'detail_distribution_id' => 'required',
            'expired' => 'required',


        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $qr = new QR;
        $qr->timestamps = false;
        $qr->detail_distribution_id = $request->detail_distribution_id;
        $qr->expired = $request->expired;
        // $qr->quota = $request->quota ?? NULL;


        $qr->save();
        return response()->json(["data" => $qr, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

    public function get_qr_by_id($id){
        $qr= QR::with(['detail_distribution','detail_distribution.detail_vehicle', 'detail_distribution.detail_vehicle.detail_user', 'detail_distribution.detail_vehicle.detail_user.position',
        'detail_distribution.detail_vehicle.detail_user.business_unit', 'detail_distribution.detail_vehicle.vehicle_type' ,'detail_distribution.detail_vehicle.business_unit', 'detail_distribution.detail_vehicle.petrol', 'detail_distribution.detail_vehicle.user'])->find($id);
        return response()->json(["data" => $qr, "message" => "Ok"], 200);
    }


    public function delete($id)
    {
        try{
        $qr = QR::find($id);
        $qr->status = 'deleted';

        $qr->save();
        return response()->json(["data" => $qr, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}
}
  //
