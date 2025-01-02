@extends('Client.layouts.index')

@section('title', 'Checkout') <!-- Page Title -->

@section('content')

<div class="ftco-animate text-center">
    <h1 class="mb-0 bread">Checkout</h1>
</div>

<section class="ftco-section">
    <div class="container">
        <form action="{{route('orders.store')}}" method="POST" class="billing-form">
            @csrf
            <div class="row justify-content-center">
                <!-- Billing Form -->
                <div class="col-xl-7 ftco-animate">

                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <!-- First Name and Last Name -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Name</label>
                                <input type="text" name="billing[name]" class="form-control" required>
                            </div>
                        </div>
                        <!-- Country Selection -->
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">State / Country</label>
                                <select name="billing[country]" class="form-control" required>
                                    <option value="india">India</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address Details -->
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Street Address</label>
                                <input type="text" name="billing[address]" class="form-control" placeholder="House number and street name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="billing[apartment]" class="form-control" placeholder="Apartment, suite, unit etc: (optional)">
                            </div>
                        </div>

                        <!-- City and Postcode -->
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Town / City</label>
                                <input type="text" name="billing[city]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Postcode / ZIP *</label>
                                <input type="text" name="billing[zip_code]" class="form-control" required>
                            </div>
                        </div>

                        <!-- Phone and Email -->
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="billing[contact_number]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country_code">Country Code</label>
                                <input type="text" name="billing[country_code]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email Address</label>
                                <input type="email" name="billing[email]" class="form-control" required>
                            </div>
                        </div>

                        <!-- Account and Shipping Options -->
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <div class="radio">
                                    <label class="mr-3"><input type="radio" name="create_account"> Create an Account? </label>
                                    <label><input type="radio" name="shipping_different" id="shipping_different"> Ship to different address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shipping Address (if different) -->
                    <div id="shipping-address" style="display: none;">
                        <h3 class="mb-4 billing-heading">Shipping Address</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_name">Full Name</label>
                                    <input type="text" name="shipping[name]" class="form-control" required disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_phone">Phone</label>
                                    <input type="text" name="shipping[contact_number]" class="form-control" required disabled>
                                </div>
                            </div>

                            <!-- Shipping Address Details -->
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="shipping_country">State / Country</label>
                                    <select name="shipping[country]" class="form-control" required disabled>
                                        <option value="India">India</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Shipping Address & Zip -->
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_address">Street Address</label>
                                    <input type="text" name="shipping[address]" class="form-control" placeholder="House number and street name" required disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="shipping[apartment]" class="form-control" placeholder="Apartment, suite, unit etc: (optional)" disabled>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_city">Town / City</label>
                                    <input type="text" name="shipping[city]" class="form-control" required disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_zip_code">Postcode / ZIP *</label>
                                    <input type="text" name="shipping[zip_code]" class="form-control" required disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Cart Total -->
                <div class="col-xl-5">
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4 class="billing-heading">Cart Total</h4>
                            </div>
                        </div>

                        <p class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($price, 2) }}</span>
                            <input type="hidden" name="total_amount" value="{{ $price }}">

                        </p>

                        <p class="d-flex justify-content-between">
                            <span>Delivery</span>
                            <span>$0.00</span>
                            <input type="hidden" name="delivery" value="0.00">
                        </p>

                        <p class="d-flex justify-content-between">
                            <span>Discount</span>
                            <span>${{ number_format($discountAmount, 2) }}</span>
                            <input type="hidden" name="discount_amount" value="{{ $discountAmount }}">
                            <input type="hidden" name="order_items[0][product_id]" value="{{ $id }}">
                            <input type="hidden" name="order_items[0][quantity]" value="1">
                        </p>

                        <hr>

                        <p class="d-flex justify-content-between total-price">
                            <span>Total</span>
                            <span>${{ number_format($saleprice, 2) }}</span>
                            <input type="hidden" name="final_amount" value="{{ $saleprice }}">
                        </p>
                    </div>

                    <!-- Payment Method -->
                    <div class="mt-4">
                        <h4 class="billing-heading mb-4">Payment Method</h4>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="cod" name="payment_type" value="cod" class="custom-control-input">
                                <label class="custom-control-label" for="cod">Cash on Delivery</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="online" name="payment_type" value="online" class="custom-control-input">
                                <label class="custom-control-label" for="online">Online Payment</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="terms" name="terms" class="custom-control-input">
                                <label class="custom-control-label" for="terms">I have read and accept the terms and conditions</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <p><button type="submit" name="submit" class="btn btn-primary py-3 px-4 w-100">Place an order</button></p>
                        </div>
                    </div>
                </div>
                <!-- .col-xl-5 -->
            </div>
        </form>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px;" class="mb-0">Subscribe to our Newsletter</h2>
                <span>Get e-mail updates about our latest shops and special offers</span>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <form action="" class="subscribe-form">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control" placeholder="Enter email address">
                        <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('shipping_different').addEventListener('change', function() {
        const shippingAddressDiv = document.getElementById('shipping-address');
        const shippingFields = [
            'shipping[name]',
            'shipping[contact_number]',
            'shipping[address]',
            'shipping[city]',
            'shipping[zip_code]',
            'shipping[country]',
            'shipping[apartment]'
        ];

        if (this.checked) {
            // Show shipping address
            shippingAddressDiv.style.display = 'block';
            // Enable shipping fields and make them required
            enableShippingValidation(true, shippingFields);
        } else {
            // Hide shipping address
            shippingAddressDiv.style.display = 'none';
            // Disable shipping fields and remove 'required' attribute
            enableShippingValidation(false, shippingFields);
        }
    });

    function enableShippingValidation(enable, fields) {
        fields.forEach(function(fieldName) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field) {
                if (enable) {
                    // Enable and mark as required
                    field.removeAttribute('disabled');
                    field.setAttribute('required', 'true');
                } else {
                    // Disable the field and remove the required attribute
                    field.setAttribute('disabled', 'true');
                    field.removeAttribute('required');
                }
            }
        });
    }
</script>


@endsection