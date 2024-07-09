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
                                <th>TRANSACTION NO.</th>
                                <th>DATE CREATED</th>
                                <th>DATE UPDATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_no }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->updated_at }}</td>
                                    <td><a href="/transaction/view/cart/{{ $transaction->payment_transaction_id }}"
                                            class="btn btn-primary">VIEW CART</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
