<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = PaymentTransaction::orderBy('payment_transaction_id', 'desc')
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    public function showCart($transaction_id)
    {
        $carts = Cart::select('tbl_products.name', 'tbl_products.price', 'tbl_carts.quantity')
            ->leftJoin('tbl_products', 'tbl_carts.product_id', '=', 'tbl_products.product_id')
            ->where('tbl_carts.payment_transaction_id', $transaction_id)
            ->get();

        return view('transaction.view_cart', compact('carts'));
    }
}
