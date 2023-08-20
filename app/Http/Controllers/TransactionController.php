<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function Index()
    {

        $limit = request()->get("limit", 10);
        if ($limit > 50) {
            $limit = 50;
        }

        $txs = \App\Models\Transaction::orderby("height", "desc")->paginate($limit);
        return response()->json($txs);
    }

    public function Detail($hash)
    {
        $tx = \App\Models\Transaction::where("id", $hash)->first();
        $tx->input = json_decode($tx->input, true);
        $tx->output = json_decode($tx->output, true);
        return response()->json($tx);
    }
}
