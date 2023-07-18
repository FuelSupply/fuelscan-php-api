<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use BaoPham\DynamoDb\DynamoDbModel;


class Fuelscan extends DynamoDbModel
{
    use HasFactory;

    protected $table = 'fuelscan';
}
