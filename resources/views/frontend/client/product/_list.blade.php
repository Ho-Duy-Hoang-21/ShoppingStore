<div id="product-list" class="row">
    @forelse ($latestProducts as $product)
        <div class="col-sm-4" style="margin-bottom: 20px;">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @php
                            $images = json_decode($product->image, true);
                            $name = $images[0] ?? null;
                        @endphp

                        @if ($name)
                            <img src="{{ asset('upload/product/medium/' . $name) }}"
                                alt="{{ $product->name }}" style="height: 200px; object-fit: cover; width: 100%;" />
                        @else
                            <img src="{{ asset('frontend/images/home/product1.jpg') }}" alt="{{ $product->name }}"
                                style="height: 200px; object-fit: cover; width: 100%;" />
                        @endif
                        <h2>${{ number_format($product->price) }}</h2>
                        <p>{{ Str::limit($product->name, 40) }}</p>
                        <button class="btn btn-default add-to-cart" data-product-id="{{ $product->id }}"
                            data-quantity="1">
                            <i class="fa fa-shopping-cart"></i>
                            ADD TO CART
                        </button>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{ number_format($product->price) }}</h2>
                            <p>{{ Str::limit($product->name, 40) }}</p>
                            <button class="btn btn-default add-to-cart" data-product-id="{{ $product->id }}"
                                data-quantity="1">
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
                        <img src="{{ asset('frontend/images/home/new.png') }}" class="new" alt="New" />
                    @else
                        <img src="{{ asset('frontend/images/home/sale.png') }}" class="new" alt="Sale" />
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
    @endforelse
    @if ($latestProducts->hasPages())
        <div class="col-sm-12 text-center" style="margin-top: 20px;">
            {{ $latestProducts->appends(request()->only(['q', 'category', 'brand', 'status', 'min_price', 'max_price']))->links() }}
        </div>
    @endif
</div>
