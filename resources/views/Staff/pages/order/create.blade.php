@extends('Staff.layouts.staff')

@section('title', 'Order create')

@section('content')
<div class="container">
    <!-- Display validation errors if there are any -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h2>Create New Order</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- Order Information -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <label>Total Amount:</label>
                    <p id="display-total-amount">$0.00</p>
                    <input type="hidden" name="total_amount" class="form-control" value="0">
                </div>
                <div class="col-md-4">
                    <label>Discount Amount:</label>
                    <p id="display-discount-amount">$0.00</p>
                    <input type="hidden" name="discount_amount" class="form-control" value="0">
                </div>
                <div class="col-md-4">
                    <label>Final Amount:</label>
                    <p id="display-final-amount">$0.00</p>
                    <input type="hidden" name="final_amount" class="form-control" value="0">
                </div>
            </div>
        </div>
        <div class="form-group" id="order-items">
            <div class="order-item ">
                <div class="row">
                    <div class="col-md-6">
                        <label for="product_id">Product</label>
                        <select name="order_items[0][product_id]" class="form-control product-select" data-index="0" required>
                            <option value="" data-price="0" selected>Select Product</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                {{ $product->name }} - ${{ $product->price }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" col-md-1">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="order_items[0][quantity]" class="form-control quantity-input" data-index="0" required min="1" value="1">
                    </div>

                    <div class=" col-md-3">
                        <label for="discount_code">Discount Code</label>
                        <select name="order_items[0][discount_code]" class="form-control discount-code-select" data-index="0">
                            <option value="" data-discount="0" title="No discount selected">Select Discount Code</option>
                        </select>
                    </div>
                    <div class="col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <!-- Add Item Button (Green) -->
                        <button type="button" class="btn btn-success rounded-circle add-item-btn">
                            <i class="fas fa-plus"></i>
                        </button>

                        <!-- Remove Item Button (Red) -->
                        <button type="button" class="btn btn-danger rounded-circle remove-item-btn" disabled>
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <div class="form-group row">
            <div id="billing-address" class="address-section col-md-6">
                <h3>Billing Address</h3>
                <div class="form-group">
                    <label for="billing-name">Full Name</label>
                    <input type="text" id="billing-name" name="billing[name]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-address-line1">Address</label>
                    <input type="text" id="billing-address-line1" name="billing[address]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-country">Country</label>
                    <select id="billing-country" name="billing[country]" class="form-control" required>
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="billing-city">City</label>
                    <input type="text" id="billing-city" name="billing[city]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-zip">Zip Code</label>
                    <input type="text" id="billing-zip" name="billing[zip_code]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-contact-number">Contact Number</label>
                    <div class="row">
                        <div class="col-md-3">
                            <select id="billing-country-code" name="billing[country_code]" class="form-control" required>
                                <option value="+1">+1 (USA)</option>
                                <option value="+44">+44 (UK)</option>
                                <option value="+91">+91 (India)</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <input type="number" id="billing-contact-number" name="billing[contact_number]" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="copy-address-checkbox">
                    <label for="copy-address-checkbox">Copy Billing Address to Shipping Address</label>
                </div>
            </div>
            <div id="shipping-address" class="address-section col-md-6">
                <h3>Shipping Address</h3>
                <div class="form-group">
                    <label for="shipping-name">Full Name</label>
                    <input type="text" id="shipping-name" name="shipping[name]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shipping-address-line1">Address</label>
                    <input type="text" id="shipping-address-line1" name="shipping[address]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shipping-country">Country</label>
                    <select id="shipping-country" name="shipping[country]" class="form-control" required>
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="shipping-city">City</label>
                    <input type="text" id="shipping-city" name="shipping[city]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shipping-zip">Pin Code</label>
                    <input type="text" id="shipping-zip" name="shipping[zip_code]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shipping-contact-number">Contact Number</label>
                    <div class="row">
                        <div class="col-md-3">
                            <select id="shipping-country-code" name="shipping[country_code]" class="form-control" required>
                                <option value="+1">+1 (USA)</option>
                                <option value="+44">+44 (UK)</option>
                                <option value="+91">+91 (India)</option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="shipping-contact-number" name="shipping[contact_number]" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="form-group row p-2">
            <div class="col-md-6">
                <label for="billing-email">Email Address</label>
                <input type="email" id="billing-email" name="billing[email]" class="form-control" placeholder="Enter your email address" required>
            </div>
            <div class="col-md-6">
                <label for="payment_type">Payment Type</label>
                <select name="payment_type" class="form-control">
                    <option value="cod">Cash on Delivery</option>
                    <option value="online">Online</option>
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group row m-1">
            <div class="col-md-12">
                <button type="submit" name="submit" class="btn btn-primary">Create Order</button>
            </div>
        </div>
    </form>
</div>

<script>
    let itemIndex = 1;

    function buildItem(itemIndex, appendTo) {
        itemIndex++;
        const newItemDiv = document.createElement('div');
        newItemDiv.classList.add('order-item');
        newItemDiv.innerHTML = `
        <div class="row pt-1">
            <div class="form-group col-md-6">

                <select name="order_items[${itemIndex}][product_id]" class="form-control product-select" data-index="${itemIndex}" required>
                    <option value="" data-price="0" selected>Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - '$'{{ $product->price }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-1">

                <input type="number" name="order_items[${itemIndex}][quantity]" class="form-control quantity-input" data-index="${itemIndex}" required min="1" value="1">
            </div>
            <div class="form-group col-md-3">

                <select name="order_items[${itemIndex}][discount_code]" class="form-control discount-code-select" data-index="${itemIndex}">
                    <option value="" data-discount="0" title="No discount selected">Select Discount Code</option>
                </select>
            </div>
            <div class="form-group col-md-1 d-flex align-items-center justify-content-between">

                        <button type="button" class="btn btn-success rounded-circle add-item-btn">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-danger rounded-circle remove-item-btn">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
    `;

        const addBtn = newItemDiv.querySelector('.add-item-btn');
        addBtn.addEventListener('click', function() {
            const newItem = buildItem(itemIndex, appendTo)
            appendTo.appendChild(newItem);
        });

        // Enable the remove button for the current item
        const removeBtn = newItemDiv.querySelector('.remove-item-btn');
        removeBtn.addEventListener('click', function() {
            newItemDiv.remove();
            updateAmounts();
        });

        return newItemDiv;
    }

    // Add new order item dynamically
    const allItems = document.querySelector('.add-item-btn')
        .addEventListener('click', function() {
            const orderItemsDiv = document.getElementById('order-items');

            const newItemDiv = buildItem(itemIndex, orderItemsDiv);
            orderItemsDiv.appendChild(newItemDiv)


            // Update amounts on any new changes
            const productSelect = newItemDiv.querySelector('.product-select');
            const quantityInput = newItemDiv.querySelector('.quantity-input');
            productSelect.addEventListener('change', updateAmounts);
            quantityInput.addEventListener('input', updateAmounts);

            itemIndex++; // Increment the item index for unique names


        });


    // Update amounts dynamically
    function updateAmounts() {
        let totalAmount = 0;
        let totalDiscount = 0;

        document.querySelectorAll('.order-item').forEach((item) => {
            const productSelect = item.querySelector('.product-select');
            const quantityInput = item.querySelector('.quantity-input');
            const discountSelect = item.querySelector('.discount-code-select');

            const price = parseFloat(productSelect.options[productSelect.selectedIndex]?.dataset?.price || 0);
            const quantity = parseInt(quantityInput.value || 0);
            const discountPercentage = parseFloat(discountSelect.options[discountSelect.selectedIndex]?.dataset
                ?.discount || 0);

            const itemTotal = price * quantity;
            const itemDiscount = (itemTotal * discountPercentage) / 100;

            totalAmount += itemTotal;
            totalDiscount += itemDiscount;
        });

        document.querySelector('#display-total-amount').textContent = `$${totalAmount.toFixed(2)}`;
        document.querySelector('input[name="total_amount"]').value = totalAmount.toFixed(2);
        document.querySelector('#display-discount-amount').textContent = `$${totalDiscount.toFixed(2)}`;
        document.querySelector('input[name="discount_amount"]').value = totalDiscount.toFixed(2);
        const finalAmount = totalAmount - totalDiscount;
        document.querySelector('#display-final-amount').textContent = `$${finalAmount.toFixed(2)}`;
        document.querySelector('input[name="final_amount"]').value = finalAmount.toFixed(2);
    }

    // Fetch discounts for selected products
    function fetchDiscount(productId, index) {
        fetch(`/product/${productId}/discount`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const discountSelect = document.querySelector(`.discount-code-select[data-index="${index}"]`);
                discountSelect.innerHTML =
                    '<option value="" data-discount="0" title="No discount selected">Select Discount Code</option>';

                if (data && data.length > 0) {
                    data.forEach(discount => {
                        const option = document.createElement('option');
                        option.value = discount.code;
                        option.dataset.discount = discount.value;
                        option.title = discount.description || `${discount.value}% off`;
                        option.textContent = `${discount.code} - ${discount.value}%`;
                        discountSelect.appendChild(option);
                    });
                } else {
                    const noDiscountOption = document.createElement('option');
                    noDiscountOption.value = '';
                    noDiscountOption.dataset.discount = '0';
                    noDiscountOption.textContent = 'No discounts available';
                    discountSelect.appendChild(noDiscountOption);
                }

                updateAmounts();
            })
            .catch(error => {
                console.error('Error fetching discount data:', error);
                // Optionally, notify the user about the error (e.g., using an alert or toast notification)
            });
    }


    // Handle dynamic changes
    document.addEventListener('change', function(event) {
        if (event.target.classList.contains('product-select')) {
            const index = event.target.dataset.index;
            const productId = event.target.value;
            if (productId) fetchDiscount(productId, index);
        }
        updateAmounts();
    });

    // Initial calculation on page load
    document.addEventListener('DOMContentLoaded', updateAmounts);
    document.addEventListener('DOMContentLoaded', function() {
        const copyCheckbox = document.getElementById('copy-address-checkbox');

        copyCheckbox.addEventListener('change', function() {
            if (copyCheckbox.checked) {
                // Copy values from Billing to Shipping fields
                document.getElementById('shipping-name').value = document.getElementById('billing-name').value;
                document.getElementById('shipping-address-line1').value = document.getElementById('billing-address-line1').value;
                document.getElementById('shipping-city').value = document.getElementById('billing-city').value;
                document.getElementById('shipping-zip').value = document.getElementById('billing-zip').value;
                document.getElementById('shipping-country').value = document.getElementById('billing-country').value;
                document.getElementById('shipping-country-code').value = document.getElementById('billing-country-code').value;
                document.getElementById('shipping-contact-number').value = document.getElementById('billing-contact-number').value;
            } else {
                // Clear Shipping fields
                document.getElementById('shipping-name').value = '';
                document.getElementById('shipping-address-line1').value = '';
                document.getElementById('shipping-city').value = '';
                document.getElementById('shipping-zip').value = '';
                document.getElementById('shipping-country').value = '';
                document.getElementById('shipping-country-code').value = '';
                document.getElementById('shipping-contact-number').value = '';
            }
        });
    });
</script>
@endsection