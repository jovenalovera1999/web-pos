<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::where('tbl_discounts.is_deleted', 0)
            ->get();

        return view('discount.index', compact('discounts'));
    }

    public function create()
    {
        return view('discount.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_of_discount' => ['required'],
            'discount_percentage' => ['required', 'numeric']
        ]);

        Discount::create([
            'type_of_discount' => $validated['type_of_discount'],
            'discount_percentage' => $validated['discount_percentage']
        ]);

        return redirect('/discounts')->with('message_success', 'Discount successfully added.');
    }
}
