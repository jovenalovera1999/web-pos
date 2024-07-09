@extends('layout.main')

@section('title', 'ADD DISCOUNT')

@section('content')

    <div class="container-fluid">
        @include('include.nav')
        <div class="d-flex justify-content-center">
            <div class="card col-sm-6 mt-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">ADD DISCOUNT</h5>
                    </div>
                    <form action="/discount/store" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="type_of_discount">TYPE OF DISCOUNT</label>
                            <input type="text" class="form-control" id="type_of_discount" name="type_of_discount"
                                value="{{ old('type_of_discount') }}" />
                            @error('type_of_discount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount_percentage">DISCOUNT PERCENTAGE</label>
                            <input type="text" class="form-control" id="discount_percentage" name="discount_percentage"
                                value="{{ old('discount_percentage') }}" />
                            @error('discount_percentage')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/discounts" class="btn btn-secondary">BACK</a>
                            <button type="submit" class="btn btn-primary">SAVE PRODUCT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
