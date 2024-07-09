@extends('layout.main')

@section('title', 'PRODUCTS')

@section('content')

    <div class="container-fluid">
        @include('include.nav')
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">PRODUCTS</h5>
                    <a href="/product/add" class="btn btn-primary">ADD PRODUCT</a>
                </div>
                <div class="mt-3 mb-3">
                    @include('include.message')
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>DATE CREATED</th>
                                <th>DATE UPDATED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
