@extends('layout.main')

@section('title', 'ADD PRODUCT')

@section('content')

    <div class="container-fluid">
        @include('include.nav')
        <div class="d-flex justify-content-center">
            <div class="card col-sm-6 mt-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">ADD PRODUCT</h5>
                    </div>
                    <form action="/product/store" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">NAME</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" />
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price">PRICE</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ old('price') }}" />
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity">QUANTITY</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                value="{{ old('quantity') }}" />
                            @error('quantity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="/products" class="btn btn-secondary">BACK</a>
                            <button type="submit" class="btn btn-primary">SAVE PRODUCT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
