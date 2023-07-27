<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class HeaderController extends Controller
{
    public function Index()
    {

        $blocks = \App\Models\Block::decorate(function (RawDynamoDbQuery $raw) {
            $raw->op = "Query";
            $raw->query['ScanIndexForward'] = false;
            $raw->query['KeyConditionExpression'] = 'table_type = :table_type';
            $raw->query['ExpressionAttributeValues'] = [
                ':table_type' => ['S' => 'blocks']
            ];
        })->limit(10)->get();

        return response()->json($blocks);
    }

    public function BlockWithTx($hash)
    {
//        $query = $model->where('count', 10)->limit(2);
//        $items = $query->all();
//        $last = $items->last();
//        $block = \App\Models\Block::decorate(function (RawDynamoDbQuery $raw) use ($hash) {
//            $raw->op = "Query";
//            $raw->query['KeyConditionExpression'] = 'table_type = :table_type';
//            $raw->query['ExpressionAttributeValues'] = [
//                ':table_type' => ['S' => 'blocks']
//            ];
//        })->firstOrFail();

        $block = \App\Models\Block::where("block_hash",$hash)->withindex("block-hash-index")->firstOrFail();

//        $block = \App\Models\Block::where('hash', $hash)->firstOrFail();
//        $txs = \App\Models\Transaction::where('block_hash', $hash)->get();
//        foreach ($txs as &$tx) {
//            $tx->status = json_decode($tx->status, true);
//            $tx->input = json_decode($tx->input, true);
//            $tx->output = json_decode($tx->output, true);
//        }
//        $block->txs= $txs;

        return response()->json($block);
    }
}
