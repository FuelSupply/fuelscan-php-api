<?php

namespace App\Http\Controllers;

use BaoPham\DynamoDb\RawDynamoDbQuery;


class HeaderController extends Controller
{
    public function Index()
    {
        $headers = \App\Models\Fuelscan::where("type","headers")->limit(10)->get();
        return response()->json($headers);
    }
}
