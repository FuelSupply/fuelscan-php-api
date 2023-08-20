<?php

namespace App\Http\Controllers;




class HeaderController extends Controller
{
    public function Index()
    {

        $limit = request()->get("limit", 10);
        if ($limit > 50) {
            $limit = 50;
        }

        $blocks = \App\Models\Block::orderby("height", "desc")->paginate($limit);
        return response()->json($blocks);
    }

    public function Detail($hash)
    {
        if (empty($hash)) {
            return response()->json(["error" => "Block not found"], 404);
        }

        $block = [];
        if (strlen($hash) == 64) {
            $hash = strtolower($hash);
        }

        $block = \App\Models\Block::where("id", $hash)->first();
        if (empty($block)) {
            $block = \App\Models\Block::where("height", $hash)->first();
        }

        if (empty($block)) {
            return response()->json(["error" => "Block not found"], 404);
        }

        $block->transactions = \App\Models\Transaction::where("block_hash", $block->id)->get();
        foreach ($block->transactions as &$tx) {
            $tx->input = json_decode($tx->input, true, 512, JSON_THROW_ON_ERROR);
            $tx->output = json_decode($tx->output, true, 512, JSON_THROW_ON_ERROR);
        }

        return response()->json($block);
    }
}
