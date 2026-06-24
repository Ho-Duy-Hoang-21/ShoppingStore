@extends('frontend.layouts.frontend')
@section('slide')
@endsection
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.leftside')
                <div class="col-sm-9 padding-right">
                    <div class="features_items"> <!--features item-->
                        <h2 class="title text-center">Features Item</h2>
                        <div class="container" style="margin-bottom: 20px;">
                            <form action="{{ route('frontend.index') }}" method="GET">
                                <div class="row" style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">

                                    {{-- Name --}}
                                    <div>
                                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Name"
                                            style="height: 36px; padding: 0 10px; border: 1px solid #ccc; border-radius: 4px;">
                                    </div>

                                    {{-- Choose price --}}
                                    <div>
                                        <select name="price"
                                            style="height: 36px; padding: 0 8px; border: 1px solid #ccc; border-radius: 4px;">
                                            <option value="">Choose price</option>
                                            <option value="0-1000">
                                                < 1000</option>
                                            <option value="1000-2000">1000-2000</option>
                                            <option value="2000-4000">2000-4000</option>
                                            <option value="4000-99999">4000+</option>

                                        </select>
                                    </div>

                                    {{-- Category --}}
                                    <div>
                                        <select name="category"
                                            style="height: 36px; padding: 0 8px; border: 1px solid #ccc; border-radius: 4px;">
                                            <option value="">Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Brand --}}
                                    <div>
                                        <select name="brand"
                                            style="height: 36px; padding: 0 8px; border: 1px solid #ccc; border-radius: 4px;">
                                            <option value="">Brand</option>
                                            @foreach ($brands as $b)
                                                <option value="{{ $b->id }}"
                                                    {{ request('brand') == $b->id ? 'selected' : '' }}>
                                                    {{ $b->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Status --}}
                                    <div>
                                        <select name="status"
                                            style="height: 36px; padding: 0 8px; border: 1px solid #ccc; border-radius: 4px;">
                                            <option value="">Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>New
                                            </option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Sale
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Button --}}
                                    <div>
                                        <button type="submit"
                                            style="height: 36px; padding: 0 20px; background: #f0a500; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                                            Search
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        @if (request('q'))
                            <h3 style="margin-bottom: 15px;">
                                Kết quả tìm kiếm: <strong>"{{ request('q') }}"</strong>
                                — {{ $latestProducts->total() }} sản phẩm
                            </h3>
                        @endif
                        <div id="product-list">
                            @include('frontend.client.product._list', [
                                'latestProducts' => $latestProducts,
                            ])
                        </div>
                        {{-- @forelse ($latestProducts as $product)
                            <div class="col-sm-4" style="margin-bottom: 20px;">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            @php
                                                $images = json_decode($product->image, true);
                                                $img = $images[0]['medium'] ?? ($images[0]['thumb'] ?? null);
                                            @endphp

                                            @if ($img)
                                                <img src="{{ asset($img) }}" alt="{{ $product->name }}"
                                                    style="height: 200px; object-fit: cover; width: 100%;" />
                                            @else
                                                <img src="{{ asset('frontend/images/home/product1.jpg') }}"
                                                    alt="{{ $product->name }}"
                                                    style="height: 200px; object-fit: cover; width: 100%;" />
                                            @endif
                                            <h2>${{ number_format($product->price) }}</h2>
                                            <p>{{ Str::limit($product->name, 40) }}</p>
                                            <button class="btn btn-default add-to-cart"
                                                data-product-id="{{ $product->id }}" data-quantity="1">
                                                <i class="fa fa-shopping-cart"></i>
                                                ADD TO CART
                                            </button>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>${{ number_format($product->price) }}</h2>
                                                <p>{{ Str::limit($product->name, 40) }}</p>
                                                <button class="btn btn-default add-to-cart"
                                                    data-product-id="{{ $product->id }}" data-quantity="1">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    ADD TO CART
                                                </button>
                                                <a href="{{ route('product.detail', $product->id) }}"
                                                    class="btn btn-default product-detail" style="margin-top:0px">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                            </div>
                                        </div>

                                        @if ($product->status == 1)
                                            <img src="{{ asset('frontend/images/home/new.png') }}" class="new"
                                                alt="New" />
                                        @else
                                            <img src="{{ asset('frontend/images/home/sale.png') }}" class="new"
                                                alt="Sale" />
                                        @endif
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i> Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i> Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-sm-12 text-center" style="padding: 40px 0;">
                                <i class="fa fa-search" style="font-size: 48px; color: #ccc;"></i>
                                <h3 style="color: #999; margin-top: 10px;">Không tìm thấy sản phẩm nào</h3>
                                <a href="{{ route('frontend.index') }}" style="color: #f0a500;">Xem tất cả sản phẩm</a>
                            </div>
                        @endforelse --}}

                        {{-- @if ($latestProducts->hasPages())
                            <div class="col-sm-12 text-center" style="margin-top: 20px;">
                                {{ $latestProducts->appends(['q' => request('q')])->links() }}
                            </div>
                        @endif --}}
                    </div><!--features item-->



                    <div class="recommended_items">
                        <h2 class="title text-center">Sale Products</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @for ($i = 0; $i < $recommendedProducts->count(); $i += 3)
                                    <div class="item {{ $i === 0 ? 'active' : '' }}">
                                        @for ($j = $i; $j < min($i + 3, $recommendedProducts->count()); $j++)
                                            @php
                                                $product = $recommendedProducts[$j];
                                                $images = json_decode($product->image, true);
                                                $img = isset($images[0]) ? 'upload/product/medium/' . $images[0] : null;
                                            @endphp
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            @if ($img)
                                                                <img src="{{ asset($img) }}" alt="{{ $product->name }}"
                                                                    style="height: 200px; object-fit: cover; width: 100%;" />
                                                            @else
                                                                <img src="{{ asset('frontend/images/home/recommend1.jpg') }}"
                                                                    alt="{{ $product->name }}"
                                                                    style="height: 200px; object-fit: cover; width: 100%;" />
                                                            @endif
                                                            <h2>${{ number_format($product->price, 2) }}</h2>
                                                            <p>{{ Str::limit($product->name, 40) }}</p>
                                                            <button class="btn btn-default add-to-cart"
                                                                data-product-id="{{ $product->id }}" data-quantity="1">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                ADD TO CART
                                                            </button>
                                                            <a href="{{ route('product.detail', $product->id) }}"
                                                                class="btn btn-default product-detail"
                                                                style="margin-top:-25px">
                                                                <i class="fa fa-info-circle"></i> Detail
                                                            </a>
                                                        </div>
                                                        <img src="{{ asset('frontend/images/home/sale.png') }}"
                                                            class="new" alt="Sale" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            document.querySelectorAll('.add-to-cart').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();


                    if (!isLoggedIn) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Chưa đăng nhập!',
                            text: 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.',
                            confirmButtonColor: '#e7ab3c',
                            confirmButtonText: 'Đăng nhập',
                            showCancelButton: true,
                            cancelButtonText: 'Hủy',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('login') }}';
                            }
                        });
                        return;
                    }

                    const productId = this.getAttribute('data-product-id');
                    const quantity = parseInt(this.getAttribute('data-quantity')) || 1;

                    if (!productId) return;

                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity,
                            }),
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('cart-count').textContent = data
                                    .cart_count;
                            }
                        })
                        .catch(error => console.error('Cart error:', error));
                });
            });

        });
    </script>
@endpush
