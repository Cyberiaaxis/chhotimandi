@extends('Client.layouts.index')

@section('title', 'Shop') <!-- Page Title -->

@section('content')
<section class="ftco-section text-center">
    <h3 class="display-4 font-weight-bold mb-4">
        <span class="border-bottom border-danger pb-2 text-danger">🛒 Market</span>
    </h3>

    <div class="container">
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
                        <a href="#" class="img-prod"><img class="img-fluid" src="{{ asset($product->image ?? 'images/default.jpg') }}" alt="Product">
                            @if($product->discount)
                            <span class="status">{{ $product->discount }}%</span>
                            @endif
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#">{{ $product->name }}</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price">
                                        <span class="mr-2 price-dc">${{ $product->price }}</span>
                                        <span class="price-sale">${{ $product->sale_price }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Get all category links

        const categoryLinks = document.querySelectorAll('.category-link');
        // console.log("hellohellohellohellohellohello", categoryLinks);
        categoryLinks.forEach(function(categoryLink) {
            categoryLink.addEventListener('click', function(e) {
                e.preventDefault();

                const categoryId = categoryLink.getAttribute('data-id');
                console.log("categoryId", categoryId);
                // Create a POST request using the Fetch API
                fetch("{{ route('shop.getProductsByCategory') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}" // Pass CSRF token for protection
                        },
                        body: JSON.stringify({
                            category_id: categoryId
                        })
                    })
                    .then(response => response.json()) // Parse JSON from the response
                    .then(data => {
                        const productList = document.querySelector('#product-list .row');
                        productList.innerHTML = ''; // Clear the current products
                        console.log("productList", productList);
                        // Append new products
                        data.products.forEach(function(product) {
                            let productHTML = `
                            <div class="col-md-6 col-lg-3 ftco-animate">
                                <div class="product">
                                    <a href="#" class="img-prod">
                                        <img class="img-fluid" src="${product.image ?? 'images/default.jpg'}" alt="${product.name}">
                                        ${product.discount ? `<span class="status">${product.discount}%</span>` : ''}
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="text py-3 pb-4 px-3 text-center">
                                        <h3><a href="#">${product.name}</a></h3>
                                        <div class="d-flex">
                                            <div class="pricing">
                                                <p class="price">
                                                    <span class="mr-2 price-dc">$${product.price}</span>
                                                    <span class="price-sale">$${product.sale_price}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bottom-area d-flex px-3">
                                            <div class="m-auto d-flex">
                                                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                                    <span><i class="ion-ios-menu"></i></span>
                                                </a>
                                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                                    <span><i class="ion-ios-cart"></i></span>
                                                </a>
                                                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                                    <span><i class="ion-ios-heart"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            productList.insertAdjacentHTML('beforeend', productHTML);
                        });
                    })
                    .catch(() => {
                        alert('Failed to load products. Please try again.');
                    });
            });
        });
    });
</script>
@endsection