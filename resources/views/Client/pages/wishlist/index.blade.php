@extends('Client.layouts.index')

@section('title', 'Wishlist') <!-- Page Title -->

@section('content')
<section class="ftco-section ftco-cart">
    <div class="container">
        <h3 class="display-4 font-weight-bold mb-4">
            <span class="border-bottom border-danger pb-2 text-danger">
                <i class="fas fa-heart"></i> Wishlist
            </span>
        </h3>
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Product List</th>
                                <th>&nbsp;</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-1.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$4.90</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$4.90</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-2.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$15.70</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$15.70</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-3.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$15.70</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$15.70</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-4.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$15.70</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$15.70</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-5.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$15.70</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$15.70</td>
                            </tr><!-- END TR-->

                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url(images/product-6.jpg);"></div>
                                </td>

                                <td class="product-name">
                                    <h3>Bell Pepper</h3>
                                    <p>Far far away, behind the word mountains, far from the countries</p>
                                </td>

                                <td class="price">$15.70</td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                    </div>
                                </td>

                                <td class="total">$15.70</td>
                            </tr><!-- END TR-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                <span>Get e-mail updates about our latest shops and special offers</span>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <form action="#" class="subscribe-form">
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
    $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>
@endsection