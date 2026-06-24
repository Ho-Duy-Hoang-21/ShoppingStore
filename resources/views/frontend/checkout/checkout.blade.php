@extends('frontend.layouts.frontend')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Fraunces:wght@600&display=swap');

        .reg-wrap {

            display: flex;
            align-items: center;
            justify-content: center;
            background: #fafaf8;
            padding: 2rem 1rem;
        }

        .reg-card {
            background: #fff;
            border: 1px solid #e8e6e0;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
        }

        .reg-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .reg-brand-icon {
            width: 36px;
            height: 36px;
            background: #F59E0B;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reg-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 22px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 0.2rem;
        }

        .reg-subtitle {
            font-size: 13px;
            color: #888;
            margin: 0 0 1.75rem;
            font-family: 'DM Sans', sans-serif;
        }

        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .field-group {
            margin-bottom: 1rem;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
            font-family: 'DM Sans', sans-serif;
            letter-spacing: 0.01em;
            text-transform: uppercase;
        }

        .field-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 15px;
            pointer-events: none;
        }

        .field-input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1px solid #e0ddd6;
            border-radius: 10px;
            background: #fafaf8;
            color: #1a1a1a;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .field-input:focus {
            border-color: #F59E0B;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
        }

        .field-input.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
            display: block;
        }

        .eye-btn {
            position: absolute;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            color: #bbb;
            padding: 0;
            display: flex;
            align-items: center;
        }

        /* Password strength */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .strength-seg {
            height: 3px;
            flex: 1;
            border-radius: 2px;
            background: #e8e6e0;
            transition: background 0.2s;
        }

        .strength-seg.weak {
            background: #ef4444;
        }

        .strength-seg.fair {
            background: #F59E0B;
        }

        .strength-seg.good {
            background: #22c55e;
        }

        .strength-label {
            font-size: 11px;
            color: #aaa;
            margin-top: 3px;
            font-family: 'DM Sans', sans-serif;
        }

        .terms-row {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin: 1.25rem 0 1.5rem;
        }

        .terms-row input {
            accent-color: #F59E0B;
            cursor: pointer;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms-row label {
            font-size: 12.5px;
            color: #666;
            font-family: 'DM Sans', sans-serif;
            line-height: 1.5;
        }

        .terms-row a {
            color: #F59E0B;
            text-decoration: none;
        }

        .terms-row a:hover {
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 11px;
            background: #F59E0B;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: background 0.15s;
            letter-spacing: 0.02em;
        }

        .btn-register:hover {
            background: #D97706;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 13px;
            color: #888;
            font-family: 'DM Sans', sans-serif;
        }

        .login-link a {
            color: #F59E0B;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->

            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-times"></i> Lỗi!</h4>
                    {{ session('error') }}
                </div>
            @endif
            <section class="reg-wrap">
                <div class="reg-card">
                    <div class="reg-brand">

                        <div class="reg-brand-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                <line x1="3" y1="6" x2="21" y2="6" />
                                <path d="M16 10a4 4 0 01-8 0" />
                            </svg>
                        </div>
                        <span
                            style="font-family:'DM Sans',sans-serif;font-size:15px;font-weight:500;color:#1a1a1a;">Shopping
                            Store</span>
                    </div>

                    <h2 class="reg-title">Create Bill </h2>
                    <p class="reg-subtitle">Điền thông tin bên dưới để bắt đầu mua hàng.</p>

                    <form method="POST" action="{{ route('order.send') }}">
                        @csrf

                        {{-- Name row --}}
                        <div class="field-row">
                            <div>
                                <label class="field-label" for="name">Full Name</label>
                                <div class="field-input-wrap">
                                    <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                    </svg>
                                    <input id="name" type="text"
                                        class="field-input @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="Name" required autocomplete="name"
                                        autofocus>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="field-group">
                                <label class="field-label" for="email">{{ __('Email Address') }}</label>
                                <div class="field-input-wrap">
                                    <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <rect x="2" y="4" width="20" height="16" rx="2" />
                                        <path d="M2 7l10 7 10-7" />
                                    </svg>
                                    <input id="email" type="email"
                                        class="field-input @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="field-group">
                                <label class="field-label" for="email">{{ __('Phone') }}</label>
                                <div class="field-input-wrap">
                                    <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <rect x="2" y="4" width="20" height="16" rx="2" />
                                        <path d="M2 7l10 7 10-7" />
                                    </svg>
                                    <input id="phone" type="number"
                                        class="field-input @error('email') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" placeholder="Phone" required autocomplete="Phone">
                                </div>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-register">{{ __('Mua Hàng') }}</button>

                            <p class="login-link">
                                Khi bạn điền đầy đủ thông tin xong bấm mua hàng để nhận được thông báo vào gmail
                            </p>

                    </form>
                </div>
            </section>
            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->

            {{-- <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div> --}}
            <div class="review-payment">
                <h2>Review & Payment</h2>
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
                                        {{-- <a class="cart_quantity_up" href="#" data-product-id="{{ $productId }}"> +
                                        </a> --}}
                                        <input class="cart_quantity_input" type="text" readonly name="quantity"
                                            value="{{ $item['quantity'] }}" autocomplete="off" size="2"
                                            data-product-id="{{ $productId }}" data-price="{{ $item['price'] }}">
                                        {{-- <a class="cart_quantity_down" href="#" data-product-id="{{ $productId }}">
                                            - </a> --}}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price" id="total-{{ $productId }}">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </p>
                                </td>
                                {{-- <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="#" data-product-id="{{ $productId }}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td> --}}
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
            <div class="col-sm-12">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span id="subtotal-display">${{ number_format($subtotal, 2) }}</span></li>
                        <li>Eco Tax <span>$2.00</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span id="grandtotal-display">${{ number_format($subtotal + 2, 2) }}</span></li>
                    </ul>

                </div>
            </div>
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>

        </div>
    </section> <!--/#cart_items-->
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
