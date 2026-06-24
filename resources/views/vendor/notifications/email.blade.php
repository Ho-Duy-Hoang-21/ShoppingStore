<x-mail::message>
# Xin chào!

Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.

<x-mail::button :url="$actionUrl" color="primary">
Đặt lại mật khẩu
</x-mail::button>

Link đặt lại mật khẩu này sẽ hết hạn sau **60 phút**.

Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm thao tác nào.

Trân trọng,<br>
ShoppingStore

<x-slot:subcopy>
Nếu bạn gặp sự cố khi nhấn nút "Đặt lại mật khẩu", hãy sao chép và dán URL bên dưới vào trình duyệt:
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
</x-mail::message>
