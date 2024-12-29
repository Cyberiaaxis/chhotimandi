@extends('Client.layouts.index')

@section('title', 'Shop') <!-- Page Title -->

@section('content')
<section class="text-center">
    <h4 class="font-weight-bold">
        <span class="border-bottom border-danger text-danger">🛒 Market</span>
    </h4>

    <div class="container">
        <!-- Product Categories -->
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    @foreach($categories as $category)
                    <li>
                        <a href="#" class="category-link" data-id="{{ $category->id }}">
                            {{ $category->category_name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Products Section -->
        <div id="product-list">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <!-- Product Image with Hover Effect -->
                        <a href="#" class="img-prod">
                            <img class="img-fluid w-50 h-50 max-w-50 max-h-50 min-w-50 min-h-50" src="{{ asset('storage/images/' . $product->image) }}" alt="Product">

                            @if($product->discounts)
                            <span class="status">{{ $product->discounts->value }}%</span>
                            @endif
                            <div class="overlay"></div> <!-- Hover Overlay -->
                        </a>

                        <!-- Product Text and Pricing -->
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{ $product->name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price">
                                        @if($product->sale_price < $product->price)
                                            <span class="mr-2 price-dc">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                            <span class="price-sale">${{ number_format($product->sale_price, 2) }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Bottom Action Area (Add to Cart, Buy Now, Favorite) -->
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <!-- Add to Cart -->
                                    <form action="{{ route('cart.add', $product->id)}}" class="add-to-cart-form">
                                        @csrf
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center" onclick="submitForm(event, this, 'cart')">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                    </form>

                                    <!-- Buy Now -->
                                    <form action="#" method="POST" class="buy-now-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" onclick="submitForm(event, this, 'wishlist')">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                    </form>

                                    <!-- Add to Favorites -->
                                    <form action="{{ route('wishlist.add', $product->id) }}" class="favorite-form">
                                        @csrf
                                        <a href="#" class="heart d-flex justify-content-center align-items-center" onclick="submitForm(event, this, 'wishlist')">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        const categoryLinks = document.querySelectorAll('.category-link');

        categoryLinks.forEach(function(categoryLink) {
            categoryLink.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = categoryLink.getAttribute('data-id');

                fetch("{{ route('shop.getProductsByCategory') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            category_id: categoryId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const productList = document.querySelector('#product-list .row');
                        while (productList.firstChild) {
                            productList.removeChild(productList.firstChild);
                        }

                        // Populate products
                        if (data.products && data.products.length > 0) {
                            data.products.forEach(product => {
                                const productCol = document.createElement('div');
                                productCol.className = 'col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated';
                                const productDiv = document.createElement('div');
                                productDiv.className = 'product';

                                // Similar to above: Create image, discount, price, and actions
                                // Add to Cart, Add to Wishlist, Buy Now forms
                            });
                        } else {
                            const noProducts = document.createElement('p');
                            noProducts.textContent = 'No products found for this category.';
                            productList.appendChild(noProducts);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                    });
            });
        });
    });

    function submitForm(event, element, type) {
        event.preventDefault(); // Prevent default anchor behavior
        const isLoggedIn = @json($isLoggedIn); // Check if the user is logged in
        const form = element.closest('form'); // Get the closest parent form of the clicked link
        if (form) {
            if (isLoggedIn) {
                // Determine the correct route based on the action type (cart or wishlist)
                // const route = type === 'cart' ? "{{ route('cart.add', '__productId__') }}".replace('__productId__', data.product_id) : "{{ route('wishlist.add', '__productId__') }}".replace('__productId__', data.product_id);
                const route = form.action;
                console.log("form.action", form.action);
                // Send the data via fetch
                fetch(route, {
                        method: "GET",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("then(data", data);
                        console.log(`${type.charAt(0).toUpperCase() + type.slice(1)} updated:`, data);
                        alert(data.message); // You can return a message from the controller
                    })
                    .catch(error => {
                        // console.error(`Error adding to ${type}:`, error);
                        alert('There was an error.');
                    });
            } else {
                window.location.href = "/login"; // Redirect to login page for unauthenticated users
            }
        } else {
            console.error("Form not found for the clicked element.");
        }
    }
</script>
@endsection