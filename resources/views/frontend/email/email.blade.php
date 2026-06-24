<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background: #f59e0b;
            padding: 24px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
        }

        .body {
            padding: 24px;
        }

        .info p {
            margin: 4px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th {
            background: #f59e0b;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            vertical-align: middle;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .total-row td {
            font-weight: bold;
            font-size: 15px;
            color: #f59e0b;
            border-top: 2px solid #f59e0b;
        }

        .footer {
            background: #f9f9f9;
            text-align: center;
            padding: 16px;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Xác nhận đơn hàng</h1>
            <p style="margin:4px 0; font-size:13px;">Cảm ơn bạn đã mua hàng tại ShoppingStore!</p>
        </div>

        <div class="body">
            <div class="info">
                <p><strong>Full Name:</strong> {{ $data['name'] }}</p>
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>SL</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['cart'] as $item)
                        <tr>
                            <img src="{{ $message->embed(public_path($item['image'])) }}" alt="{{ $item['name'] }}"
                                width="80" height="80">
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="4" style="text-align:right;">Tổng cộng:</td>
                        <td>${{ number_format($data['total'], 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            © {{ date('Y') }} ShoppingStore. Mọi thắc mắc vui lòng liên hệ support@shoppingstore.com
        </div>
    </div>
</body>

</html>
