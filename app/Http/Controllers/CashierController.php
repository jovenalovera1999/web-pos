<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\PaymentTransaction;
use App\Models\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name', 'asc')
            ->where('tbl_products.is_deleted', 0)
            ->get();

        $discounts = Discount::where('tbl_discounts.is_deleted', 0)
            ->get();

        return view('cashier.index', compact('products', 'discounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'discount' => ['required'],
            'change' => ['required', 'numeric'],
            'cart_items.*.product_id' => ['required', 'exists:tbl_products,product_id'],
            'cart_items.*.quantity' => ['required', 'numeric']
        ]);

        $transactionNo = strval(random_int(10000000000, 99999999999));

        $paymentTransaction = PaymentTransaction::create([
            'transaction_no' => $transactionNo,
            'total_price' => $request->total_price,
            'amount' => $validated['amount'],
            'discount_id' => $validated['discount'],
            'change' => $validated['change']
        ]);

        foreach ($validated['cart_items'] as $item) {
            Cart::create([
                'payment_transaction_id' => $paymentTransaction->payment_transaction_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity']
            ]);
        }

        return back()->with('message_success', 'Transaction successfully saved.');
    }
}
