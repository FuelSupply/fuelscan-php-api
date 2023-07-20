<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class TransactionController extends Controller
{
    public function Index()
    {
        $txs = \App\Models\Transaction::decorate(function (RawDynamoDbQuery $raw) {
            $raw->op = "Query";
            $raw->query['ScanIndexForward'] = false;
            $raw->query['KeyConditionExpression'] = 'table_type = :table_type';
            $raw->query['ExpressionAttributeValues'] = [
                ':table_type' => ['S' => 'transactions'],
            ];
        })->limit(10)->get();

        foreach ($txs as &$tx) {
            $tx->status = json_decode($tx->status, true);
            $tx->input = json_decode($tx->input, true);
            $tx->output = json_decode($tx->output, true);
        }
        return response()->json($txs);
    }
}
