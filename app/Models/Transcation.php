<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use BaoPham\DynamoDb\DynamoDbModel;


class Transaction extends DynamoDbModel
{
    use HasFactory;

    protected $table = 'transactions';
}
