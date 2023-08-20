<?php

namespace App\Http\Controllers;


class IndexController extends Controller
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
}
