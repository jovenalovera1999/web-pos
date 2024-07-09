@extends('layout.main')

@section('title', 'TRANSACTIONS')

@section('content')

    <div class="container-fluid">
        @include('include.nav')
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">TRANSACTIONS</h5>
                </div>
                <div class="mt-3 mb-3">
                    @include('include.message')
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>PRODUCT</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->price }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>{{ doubleval($cart->price) * intval($cart->quantity) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
