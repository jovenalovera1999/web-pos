<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $table = 'tbl_payment_transactions';
    protected $primaryKey = 'payment_transaction_id';
    protected $fillable = [
        'transaction_no',
        'total_price',
        'amount',
        'discount_id',
        'change',
        'is_deleted'
    ];
}
