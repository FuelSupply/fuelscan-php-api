<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class TransactionController extends Controller
{
    public function Index()
    {
        $txs = \App\Models\Transaction::orderby("height","desc")->limit(10)->get();
        foreach ($txs as &$tx) {
            $tx->input = json_decode($tx->input, true);
            $tx->output = json_decode($tx->output, true);
        }

        return response()->json($txs);
    }

    public function Detail($hash)
    {
        $tx = \App\Models\Transaction::where("id",$hash)->first();
        $tx->input = json_decode($tx->input, true);
        $tx->output = json_decode($tx->output, true);
        return response()->json($tx);
    }
}
