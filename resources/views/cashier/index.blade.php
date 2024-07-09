@extends('layout.main')

@section('title', 'CASHIER')

@section('content')
    <div class="container-fluid">
        @include('include.nav')
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-start">
                    <h5 class="card-title">CASHIER</h5>
                </div>
                <div class="row">
                    @include('include.message')
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NAME</th>
                                        <th>PRICE</th>
                                        <th>QUANTITY</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-success add-to-cart"
                                                    data-id="{{ $product->product_id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    ADD TO CART
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <form action="/cashier/store" method="post">
                            @csrf
                            <div class="table-responsive mb-3">
                                @error('cart_items.*.product_id')
                                    {{ $message }}
                                @enderror
                                @error('cart_items.*.quantity')
                                    {{ $message }}
                                @enderror
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>QUANTITY</th>
                                            <th>SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart-items">
                                        <!-- Cart items will be appended here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <p class="fs-3" id="total-price">Total Price: 0</p>
                                <input type="hidden" name="total_price" id="total_price" value="0" />
                            </div>
                            <div class="mb-3">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount"
                                    value="{{ old('amount') }}" />
                                @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="discount">Discount</label>
                                <select class="form-control" name="discount" id="discount">
                                    @foreach ($discounts as $discount)
                                        <option
                                            value="{{ $discount->discount_id }}"{{ old('discount') === $discount->discount_id ? 'selected' : '' }}>
                                            {{ $discount->type_of_discount }}</option>
                                    @endforeach
                                </select>
                                @error('discount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="change">Change</label>
                                <input type="text" class="form-control" name="change" id="change" readonly />
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">SAVE TRANSACTION</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ENTER QUANTITY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="modal-quantity">QUANTITY</label>
                    <input type="number" class="form-control" name="modal-quantity" id="modal-quantity" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                    <button type="button" class="btn btn-primary" id="add-to-cart-confirm">ADD</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedProduct = {};
        let cartItems = []; // Array to store cart items

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                selectedProduct.id = this.getAttribute('data-id');
                selectedProduct.name = this.getAttribute('data-name');
                selectedProduct.price = parseFloat(this.getAttribute('data-price'));
            });
        });

        document.getElementById('add-to-cart-confirm').addEventListener('click', function() {
            const quantity = parseInt(document.getElementById('modal-quantity').value);
            const subtotal = selectedProduct.price * quantity;

            // Add item to cartItems array
            cartItems.push({
                product_id: selectedProduct.id,
                name: selectedProduct.name,
                price: selectedProduct.price,
                quantity: quantity,
                subtotal: subtotal
            });

            const newRow = `
            <tr data-id="${selectedProduct.id}">
                <td>${selectedProduct.name}</td>
                <td>${selectedProduct.price.toFixed(2)}</td>
                <td>${quantity}</td>
                <td>${subtotal.toFixed(2)}</td>
            </tr>
            `;

            document.getElementById('cart-items').insertAdjacentHTML('beforeend', newRow);
            updateTotalPrice();
            document.querySelector('#staticBackdrop .btn-close').click();
        });

        function updateTotalPrice() {
            let total = 0;
            cartItems.forEach(item => {
                total += item.subtotal;
            });
            document.getElementById('total-price').innerText = `Total Price: ${total.toFixed(2)}`;
            calculateChange();
        }

        document.getElementById('amount').addEventListener('input', calculateChange);
        document.getElementById('discount').addEventListener('change', calculateChange);

        function calculateChange() {
            const amount = parseFloat(document.getElementById('amount').value) || 0;
            const discountPercentage = parseFloat(document.getElementById('discount').value) || 0;
            const totalPrice = parseFloat(document.getElementById('total-price').innerText.split(' ')[2]) || 0;
            const discountedPrice = totalPrice * (1 - discountPercentage / 100);
            const change = amount - discountedPrice;
            document.getElementById('total-price').innerText = `Total Price: ${discountedPrice.toFixed(2)}`;

            document.getElementById('change').value = change.toFixed(2);
        }

        // Attach cartItems to form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Remove existing hidden inputs for cart_items if any
            document.querySelectorAll('input[name^="cart_items"]').forEach(input => {
                input.remove();
            });

            // Append cartItems as hidden input fields
            cartItems.forEach((item, index) => {
                const productIdInput = document.createElement('input');
                productIdInput.setAttribute('type', 'hidden');
                productIdInput.setAttribute('name', `cart_items[${index}][product_id]`);
                productIdInput.setAttribute('value', item.product_id);
                this.appendChild(productIdInput);

                const quantityInput = document.createElement('input');
                quantityInput.setAttribute('type', 'hidden');
                quantityInput.setAttribute('name', `cart_items[${index}][quantity]`);
                quantityInput.setAttribute('value', item.quantity);
                this.appendChild(quantityInput);
            });

            // Append total price as hidden input field
            const totalPriceInput = document.createElement('input');
            totalPriceInput.setAttribute('type', 'hidden');
            totalPriceInput.setAttribute('name', 'total_price');
            totalPriceInput.setAttribute('value', document.getElementById('total_price').value);
            this.appendChild(totalPriceInput);

            // Submit the form
            this.submit();
        });
    });
</script>
