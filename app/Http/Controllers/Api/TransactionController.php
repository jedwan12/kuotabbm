<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Transaction;
use App\Models\DetailDistribution;
use App\Models\Log;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with(['gas_station', 'petrol',
         'detail_distribution', 'detail_distribution.detail_vehicle',
        'detail_distribution.detail_vehicle.petrol', 'detail_distribution.detail_vehicle.business_unit',
        'detail_distribution.detail_vehicle.user'])->paginate();
        return response()->json($transaction,200);
    }

    public function get_data_by_id($id){
        $transaction = Transaction::with(['gas_station', 'petrol',
         'detail_distribution', 'detail_distribution.detail_vehicle',
        'detail_distribution.detail_vehicle.petrol', 'detail_distribution.detail_vehicle.business_unit',
        'detail_distribution.detail_vehicle.user'])->join('detail_distributions' , 'detail_distributions.id','=', 'transactions.detail_distribution_id')->join('detail_vehicles' , 'detail_vehicles.id','=', 'detail_distributions.detail_vehicle_id')->select('transactions.*')->where('detail_vehicles.user_id',$id)->paginate();
        return response()->json($transaction,200);
    }


    public function store(Request $request)
    {
        try{
        $rules = [
            'gas_station_id' => 'required',
            'petrol_id' => 'required',
            'detail_distribution_id' => 'required',
            'quota' => 'required',
            // 'updated_by' => 'required',

        ];
        $messages = array(
            'required' => 'The :attribute field is required.',
        );
        $this->validate($request, $rules, $messages);
        $transaction = new Transaction;
        $transaction->gas_station_id = $request->gas_station_id;
        $transaction->petrol_id = $request->petrol_id;
        $transaction->detail_distribution_id = $request->detail_distribution_id;
        $transaction->quota = $request->quota;
        $transaction->created_by = $request->created_by;
        // $transaction->gas_station_id = $request->gas_station_id ?? NULL;

        $transaction->save();
        return response()->json(["data" => $transaction, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
    }

}

public function confirmed(Request $request, $id)
{
    try{

    $transaction = Transaction::find($id);
    $transaction->status = 'accept';
    $transaction->save();
    // return response()->json(["data" => (int)$transaction->total_request, "message" => "Ok"], 200);

        $detail_distribution = DetailDistribution::find($transaction->detail_distribution_id);
        $detail_distribution->quota = ((int) $detail_distribution->quota - (int)$transaction->quota);

        $detail_distribution->save();

         $log = new Log;
         $log->transaction_type_id = 1;
         $log->management_type_id = 3;
         $log->quota =  $transaction->quota;
         $log->gas_station_id =  $transaction->gas_station_id;
        //  $log->note =  $request->note;
         $log->detail_distribution_id =  $transaction->detail_distribution_id;
         $log->updated_by = $transaction->created_by;
         $log->save();

    return response()->json(["data" => $transaction, "message" => "Ok"], 200);
} catch (Exception $e) {
    return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
}
}

public function rejected(Request $request, $id)
{
    try{

    $transaction = Transaction::find($id);

    $transaction->status = "rejected";
    // $transaction->total_request = $request->total_request;
    $transaction->save();
    return response()->json(["data" => $transaction, "message" => "Ok"], 200);
} catch (Exception $e) {
    return response()->json(["message" => $e->getMessage(), 'code' => $e->getCode()], 403);
}
}

}
