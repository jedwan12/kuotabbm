<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    //
    public function index(){
        $transaction_type = TransactionType::all();
        return response()->json($transaction_type,200);
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
        $transaction_type = new TransactionType;
        $transaction_type->timestamps = false;
        $transaction_type->type = $request->type;

        $transaction_type->save();
        return response()->json(["data" => $transaction_type, "message" => "Ok"], 200);
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
        $transaction_type = TransactionType::find($id);
        $transaction_type->timestamps = false;
        $transaction_type->type = $request->type;

        $transaction_type->save();
        return response()->json(["data" => $transaction_type, "message" => "Ok"], 200);
    } catch (Exception $e) {
        return response()->json(["message" => $e, 'code' => $e->getCode()], 403);
    }

}

}
