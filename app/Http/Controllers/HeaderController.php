<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class HeaderController extends Controller
{
    public function Index()
    {
        $blocks = \App\Models\Block::orderby("height","desc")->limit(10)->get();
        return response()->json($blocks);
    }

    public function Detail($hash)
    {
        $block = \App\Models\Block::where("id",$hash)->first();
        if (empty($block)) {
            $block = \App\Models\Block::where("height",$hash)->first();
        }

        if (empty($block)) {
            return response()->json(["error"=>"Block not found"],404);
        }

        $block->transactions = \App\Models\Transaction::where("block_hash",$block->id)->get();
        foreach ($block->transactions as &$tx) {
            $tx->input = json_decode($tx->input, true, 512, JSON_THROW_ON_ERROR);
            $tx->output = json_decode($tx->output, true, 512, JSON_THROW_ON_ERROR);
        }

        return response()->json($block);
    }
}
