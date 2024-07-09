<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'tbl_carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'payment_transaction_id',
        'product_id',
        'quantity',
        'is_deleted'
    ];
}
