<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedTransactionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'total_amount',
        'timestamp',
        'status',
    ];
}
