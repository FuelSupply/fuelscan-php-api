<?php

namespace App\Http\Controllers;


class SearchController extends Controller
{
    public function Index($hash)
    {
        if (empty($hash)) {
            return response()->json(["error" => "Block not found"], 404);
        }

        $block = [];
        if (strstr($hash, "0x")) {
            $hash = strtolower(substr($hash, 2));
        } else {
            $hash = strtolower($hash);
        }

        $block = \App\Models\Block::where("id", $hash)->first();
        if (empty($block)) {
            if (is_int($hash)) {
                $block = \App\Models\Block::where("height", $hash)->first();
            }
        }

        if (!empty($block)) {
            return response()->json([
                "key" => "block",
                "value" => $block->id,
            ]);
        }

        $tx = \App\Models\Transaction::where("id", $hash)->first();
        if (!empty($tx)) {
            return response()->json([
                "key" => "tx",
                "value" => $tx->id,
            ]);
        };

        $account = \App\Models\Address::where("account_hash", "0x" . $hash)->first();
        if (!empty($account)) {
            return response()->json([
                "key" => $account->account_type,
                "value" => $account->account_hash,
            ]);
        };

        return response()->json(["error" => "Block not found"], 404);
    }
}
