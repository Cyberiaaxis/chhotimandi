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

                            @if($product->discount)
                            <span class="status">{{ $product->discount }}%</span>
                            @endif
                            <div class="overlay"></div> <!-- Hover Overlay -->
                        </a>

                        <!-- Product Text and Pricing -->
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

                            <!-- Bottom Action Area (Add to Cart, Buy Now, Favorite) -->
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <!-- Add to Cart -->
                                    <form action="#" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center" onclick="submitForm(event, this)">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                    </form>

                                    <!-- Buy Now -->
                                    <form action="#" method="POST" class="buy-now-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1" onclick="submitForm(event, this)">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                    </form>

                                    <!-- Add to Favorites -->
                                    <form action="#" method="POST" class="favorite-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <a href="#" class="heart d-flex justify-content-center align-items-center" onclick="submitForm(event, this)">
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
                                console.log("product", product);
                                const productCol = document.createElement('div');
                                productCol.className = 'col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated';

                                const productDiv = document.createElement('div');
                                productDiv.className = 'product';

                                const imgProd = document.createElement('a');
                                imgProd.className = 'img-prod';
                                imgProd.href = '#';
                                const img = document.createElement('img');
                                img.className = 'img-fluid w-50 h-50 max-w-50 max-h-50 min-w-50 min-h-50';
                                img.src = "{{ asset('storage/images/') }}/" + product.image;
                                img.alt = product.name;

                                imgProd.appendChild(img);

                                if (product.discount) {
                                    const discountSpan = document.createElement('span');
                                    discountSpan.className = 'status';
                                    discountSpan.textContent = `${product.discount}%`;
                                    imgProd.appendChild(discountSpan);
                                }

                                const overlayDiv = document.createElement('div');
                                overlayDiv.className = 'overlay';
                                imgProd.appendChild(overlayDiv);

                                productDiv.appendChild(imgProd);

                                const textDiv = document.createElement('div');
                                textDiv.className = 'text py-3 pb-4 px-3 text-center';

                                const productName = document.createElement('h3');
                                const productNameLink = document.createElement('a');
                                productNameLink.href = '#';
                                productNameLink.textContent = product.name;
                                productName.appendChild(productNameLink);
                                textDiv.appendChild(productName);

                                // Add pricing div
                                const pricingWrapper = document.createElement('div');
                                pricingWrapper.className = 'd-flex';
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
                                pricingWrapper.appendChild(pricingDiv);
                                textDiv.appendChild(pricingWrapper);

                                // Add bottom-area to textDiv
                                const bottomArea = document.createElement('div');
                                bottomArea.className = 'bottom-area d-flex px-3';

                                // Create forms for actions
                                const actions = [{
                                        class: 'add-to-cart',
                                        icon: 'ion-ios-menu',
                                        route: "#"
                                    },
                                    {
                                        class: 'buy-now',
                                        icon: 'ion-ios-cart',
                                        route: "#"
                                    },
                                    {
                                        class: 'heart',
                                        icon: 'ion-ios-heart',
                                        route: "#"
                                    }
                                ];

                                actions.forEach(action => {
                                    const form = document.createElement('form');
                                    form.action = action.route;
                                    form.method = 'POST';
                                    form.className = `${action.class}-form`;
                                    form.innerHTML = `
                                    @csrf
                                    <input type="hidden" name="product_id" value="${product.id}">
                                `;
                                    const link = document.createElement('a');
                                    link.href = '#';
                                    link.className = `${action.class} d-flex justify-content-center align-items-center text-center`;
                                    link.innerHTML = `<span><i class="${action.icon}"></i></span>`;
                                    link.onclick = (e) => submitForm(e, link);
                                    form.appendChild(link);
                                    bottomArea.appendChild(form);
                                });

                                textDiv.appendChild(bottomArea);

                                // Append textDiv to productDiv
                                productDiv.appendChild(textDiv);

                                // Add to Product Column
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

    // Function to handle form submission
    function submitForm(event, element) {
        event.preventDefault(); // Prevent default anchor behavior
        const form = element.closest('form'); // Get the closest parent form of the clicked link
        if (form) {
            form.submit(); // Submit the form programmatically
        }
    }
</script>


@endsection