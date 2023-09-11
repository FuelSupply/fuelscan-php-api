<?php

namespace App\Http\Controllers;


class IndexController extends Controller
{
    public function Index()
    {
        $fiften = 60 * 15;
        $block_count = \App\Models\Block::count();
        $transaction_count = \App\Models\Transaction::count();
        $address_count = \App\Models\Address::where("account_type", "account")->count();
        $contract_count = \App\Models\Contract::count();

        $contract_tps_count = \App\Models\Contract::whereBetween('timestamp', [time() - $fiften, time()])->count();

        return response()->json([
            "address_count" => $address_count,
            "contract_count" => $contract_count,
            "transaction_count" => $transaction_count,
            "block_count" => $block_count,
            "tps" => $contract_tps_count / $fiften,
        ]);
    }
}
