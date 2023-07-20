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
}
