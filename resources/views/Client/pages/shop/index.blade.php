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
                        <a href="#" class="img-prod">
                            <img class="img-fluid" src="{{ $product->image ? asset($product->image) : asset('images/default.jpg') }}" alt="Product">
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

                        // Clear existing products
                        while (productList.firstChild) {
                            productList.removeChild(productList.firstChild);
                        }

                        // Populate the new products
                        if (data.products && data.products.length > 0) {
                            data.products.forEach(product => {
                                console.log("product", product);
                                // Create product container
                                const productCol = document.createElement('div');
                                productCol.className = 'col-md-6 col-lg-3 ftco-animate';

                                const productDiv = document.createElement('div');
                                productDiv.className = 'product';

                                // Product image
                                const imgProd = document.createElement('a');
                                imgProd.className = 'img-prod';
                                imgProd.href = '#';

                                const img = document.createElement('img');
                                img.className = 'img-fluid';
                                img.src = product.image ? product.image : "{{ asset('images/default.jpg') }}";
                                img.alt = product.name;

                                imgProd.appendChild(img);

                                // Discount label
                                if (product.discount) {
                                    const discountSpan = document.createElement('span');
                                    discountSpan.className = 'status';
                                    discountSpan.textContent = `${product.discount}%`;
                                    imgProd.appendChild(discountSpan);
                                }

                                // Overlay
                                const overlayDiv = document.createElement('div');
                                overlayDiv.className = 'overlay';
                                imgProd.appendChild(overlayDiv);

                                productDiv.appendChild(imgProd);

                                // Product details
                                const textDiv = document.createElement('div');
                                textDiv.className = 'text py-3 pb-4 px-3 text-center';

                                const productName = document.createElement('h3');
                                const productNameLink = document.createElement('a');
                                productNameLink.href = '#';
                                productNameLink.textContent = "product.name";
                                productName.appendChild(productNameLink);
                                textDiv.appendChild(productName);

                                const pricingDiv = document.createElement('div');
                                pricingDiv.className = 'pricing';

                                const priceP = document.createElement('p');
                                priceP.className = 'price';

                                if (product.sale_price) {
                                    const priceSaleSpan = document.createElement('span');
                                    priceSaleSpan.className = 'price-sale';
                                    priceSaleSpan.textContent = `$${product.sale_price}`;
                                    priceP.appendChild(priceSaleSpan);

                                    const priceDcSpan = document.createElement('span');
                                    priceDcSpan.className = 'mr-2 price-dc';
                                    priceDcSpan.textContent = `$${product.price}`;
                                    priceP.appendChild(priceDcSpan);
                                } else {
                                    priceP.textContent = `$${product.price}`;
                                }

                                pricingDiv.appendChild(priceP);
                                textDiv.appendChild(pricingDiv);
                                productDiv.appendChild(textDiv);

                                // Add to product column
                                productCol.appendChild(productDiv);
                                productList.appendChild(productCol);
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
</script>
@endsection