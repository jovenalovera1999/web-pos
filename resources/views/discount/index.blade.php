@extends('layout.main')

@section('title', 'DISCOUNTS')

@section('content')

    <div class="container-fluid">
        @include('include.nav')
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">DISCOUNTS</h5>
                    <a href="/discount/add" class="btn btn-primary">ADD DISCOUNT</a>
                </div>
                <div class="mt-3 mb-3">
                    @include('include.message')
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>TYPE OF DISCOUNT</th>
                                <th>DISCOUNT PERCENTAGE</th>
                                <th>DATE CREATED</th>
                                <th>DATE UPDATED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{ $discount->type_of_discount }}</td>
                                    <td>{{ $discount->discount_percentage }}</td>
                                    <td>{{ $discount->created_at }}</td>
                                    <td>{{ $discount->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
