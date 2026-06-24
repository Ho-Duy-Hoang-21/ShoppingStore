@extends('frontend.layouts.frontend')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        @forelse ($cart as $productId => $item)
                            <tr id="row-{{ $productId }}">
                                <td class="cart_product">
                                    <a href="#">
                                        <img src="{{ $item['image'] ? asset($item['image']) : asset('frontend/images/home/product1.jpg') }}"
                                            alt="{{ $item['name'] }}" style="width:80px; height:80px; object-fit:cover;">
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="#">{{ $item['name'] }}</a></h4>
                                    <p>ID: {{ $productId }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>${{ number_format($item['price'], 2) }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="#" data-product-id="{{ $productId }}"> +
                                        </a>
                                        <input class="cart_quantity_input" type="text" name="quantity"
                                            value="{{ $item['quantity'] }}" autocomplete="off" size="2"
                                            data-product-id="{{ $productId }}" data-price="{{ $item['price'] }}">
                                        <a class="cart_quantity_down" href="#" data-product-id="{{ $productId }}">
                                            - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price" id="total-{{ $productId }}">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="#" data-product-id="{{ $productId }}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr id="empty-cart-row">
                                <td colspan="6" class="text-center" style="padding: 30px;">
                                    Giỏ hàng trống. <a href="{{ url('/') }}">Tiếp tục mua sắm</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li><input type="checkbox"><label> Use Coupon Code</label></li>
                            <li><input type="checkbox"><label> Use Gift Voucher</label></li>
                            <li><input type="checkbox"><label> Estimate Shipping & Taxes</label></li>
                        </ul>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span id="subtotal-display">${{ number_format($subtotal, 2) }}</span></li>
                            <li>Eco Tax <span>$2.00</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span id="grandtotal-display">${{ number_format($subtotal + 2, 2) }}</span></li>
                        </ul>
                        <a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Hàm gọi update lên server
            function updateCart(productId, quantity) {
                fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity
                        }),
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            // Cập nhật total của row
                            const rowTotalEl = document.getElementById('total-' + productId);
                            if (rowTotalEl) rowTotalEl.textContent = '$' + data.row_total;

                            // Cập nhật subtotal & grandtotal
                            document.getElementById('subtotal-display').textContent = '$' + data.subtotal;
                            document.getElementById('grandtotal-display').textContent = '$' + (parseFloat(data
                                .subtotal.replace(',', '')) + 2).toFixed(2);

                            // Cập nhật badge header
                            document.getElementById('cart-count').textContent = data.cart_count;

                            // Nếu quantity = 0 → xóa row
                            if (quantity <= 0) {
                                removeRow(productId);
                            }
                        }
                    });
            }

            function removeRow(productId) {
                const row = document.getElementById('row-' + productId);
                if (row) row.remove();

                // Nếu giỏ trống thì hiện thông báo
                const tbody = document.getElementById('cart-body');
                if (tbody && tbody.querySelectorAll('tr').length === 0) {
                    tbody.innerHTML = `<tr><td colspan="6" class="text-center" style="padding:30px;">
                Giỏ hàng trống. <a href="/">Tiếp tục mua sắm</a></td></tr>`;
                }
            }

            // Nút +
            document.querySelectorAll('.cart_quantity_up').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const input = document.querySelector('.cart_quantity_input[data-product-id="' +
                        productId + '"]');
                    const newQty = parseInt(input.value) + 1;
                    input.value = newQty;
                    updateCart(productId, newQty);
                });
            });

            // Nút -
            document.querySelectorAll('.cart_quantity_down').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    const input = document.querySelector('.cart_quantity_input[data-product-id="' +
                        productId + '"]');
                    const current = parseInt(input.value);

                    
                    if (current <= 1) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Không thể giảm thêm!',
                            text: 'Số lượng tối thiểu là 1. Nếu muốn xóa, hãy nhấn nút xóa.',
                            confirmButtonColor: '#e7ab3c',
                        });
                        return;
                    }

                    const newQty = current - 1;
                    input.value = newQty;
                    updateCart(productId, newQty);
                });
            });

            // Nút xóa (X)
            document.querySelectorAll('.cart_quantity_delete').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const productId = this.getAttribute('data-product-id');

                    Swal.fire({
                        title: 'Xóa sản phẩm?',
                        text: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('{{ route('cart.remove') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        product_id: productId
                                    }),
                                })
                                .then(r => r.json())
                                .then(data => {
                                    if (data.success) {
                                        removeRow(productId);
                                        document.getElementById('subtotal-display')
                                            .textContent = '$' + data.subtotal;
                                        document.getElementById('grandtotal-display')
                                            .textContent = '$' + (parseFloat(data
                                                .subtotal.replace(',', '')) + 2)
                                            .toFixed(2);
                                        document.getElementById('cart-count')
                                            .textContent = data.cart_count;

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Đã xóa!',
                                            text: 'Sản phẩm đã được xóa khỏi giỏ hàng.',
                                            timer: 1500,
                                            showConfirmButton: false,
                                        });
                                    }
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
