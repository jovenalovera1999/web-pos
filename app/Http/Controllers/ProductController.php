<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name', 'asc')
            ->where('tbl_products.is_deleted', 0)
            ->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:55'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ]);

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity']
        ]);

        return redirect('/products')->with('message_success', 'Product successfully added.');
    }
}
