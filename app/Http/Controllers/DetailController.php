<?php

namespace App\Http\Controllers;


class DetailController extends Controller
{
    public function Address($hash)
    {
        if (empty($hash)) {
            return response()->json(["error" => "Block not found"], 404);
        }

        $address = "";
        if (strstr($hash, "0x")) {
            $address = strtolower($hash);
        } else {
            $address = strtolower("0x" . $hash);
        }

        $account = \App\Models\Address::where("account_hash", $address)->first();
        if (empty($account)) {
            return response()->json(["error" => "account not found"], 404);
        };

        $assets = \App\Models\Asset::where("assets_owner", substr($address, 2))->where("asset_status", "alive")->get();


        return response()->json([]);
    }

    public function Contract($hash)
    {
        if (empty($hash)) {
            return response()->json(["error" => "Block not found"], 404);
        }

        return response()->json([
            "address_count" => "1",
        ]);
    }
}
