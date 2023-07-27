<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use BaoPham\DynamoDb\DynamoDbModel;


class Block extends DynamoDbModel
{
    use HasFactory;

    protected $table = 'blocks';

    protected $dynamoDbIndexKeys = [
        'block-hash-index' => [
            'hash' => 'block_hash',
        ],
    ];

    protected $compositeKey = ['table_type', 'height'];
}
