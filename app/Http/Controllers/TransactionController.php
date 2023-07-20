<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class TransactionController extends Controller
{
    public function Index()
    {
        $tx = \App\Models\Transaction::decorate(function (RawDynamoDbQuery $raw) {
            $raw->op = "Query";
            $raw->query['ScanIndexForward'] = false;
            $raw->query['KeyConditionExpression'] = 'table_type = :table_type';
            $raw->query['ExpressionAttributeValues'] = [
                ':table_type' => ['S' => 'transactions']
            ];
        })->limit(10)->get();

        return response()->json($tx);
    }
}
