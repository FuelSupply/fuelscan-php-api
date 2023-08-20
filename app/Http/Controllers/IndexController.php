<?php

namespace App\Http\Controllers;


class IndexController extends Controller
{
    public function Index()
    {
        $block_count = \App\Models\Block::count();
        $transaction_count = \App\Models\Transaction::count();
        //$address_count = \App\Models\Address::count();
        $contract_count = \App\Models\Contract::count();


        return response()->json([
            "address_count" => 0,
            "contract_count" => $contract_count,
            "transaction_count" => $transaction_count,
            "block_count" => $block_count,
            "tps" => 0,
        ]);
    }
}
