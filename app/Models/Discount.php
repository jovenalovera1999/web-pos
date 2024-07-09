<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'tbl_discounts';
    protected $primaryKey = 'discount_id';
    protected $fillable = [
        'type_of_discount',
        'discount_percentage',
        'is_deleted'
    ];
}
