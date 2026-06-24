@extends('admin.layouts.admin')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="page-title">List Product</h4>

                {{-- Tìm kiếm theo tên member --}}
                <form action="{{ route('product.list') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Tìm theo tên member..." style="width: 250px;">
                    <button type="submit" class="btn btn-primary">Tìm</button>
                    @if (request('search'))
                        <a href="{{ route('product.list') }}" class="btn btn-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <div style="background:#fff; border:0.5px solid #e5e7eb; border-radius:12px; overflow:hidden;">
                <table style="width:100%; border-collapse:collapse; font-size:14px; text-align:center;">
                    <thead>
                        <tr style="border-bottom:1.5px solid #e5e7eb; background:#f9fafb;">
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Image
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Title
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Price
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Category
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Brand
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Sale
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Member
                            </td>
                            <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">Action
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr style="border-bottom:0.5px solid #f3f4f6;">
                                <td style="padding:12px 14px;">
                                    @php $images = json_decode($product->image, true); @endphp
                                    @if (is_array($images) && count($images) > 0)
                                        <img src="{{ asset('upload/product/thumb/' . $images[0]) }}" alt=""
                                            style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb;">
                                    @else
                                        <span>No image</span>
                                    @endif
                                </td>
                                <td style="padding:12px 14px; font-weight:500;">{{ $product->name }}</td>
                                <td style="padding:12px 14px;">${{ number_format($product->price) }}</td>
                                <td style="padding:12px 14px;">{{ $product->category->name ?? '-' }}</td>
                                <td style="padding:12px 14px;">{{ $product->brand->name ?? '-' }}</td>
                                <td style="padding:12px 14px;">{{ $product->sale }}%</td>
                                <td style="padding:12px 14px;">{{ $product->user->name ?? '-' }}</td>
                                <td style="padding:12px 14px;">
                                    <a href="{{ route('product.edit', $product->id) }}"
                                        style="display:inline-flex; align-items:center; gap:4px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:500; background:#eff6ff; color:#1d4ed8; border:0.5px solid #bfdbfe; text-decoration:none;">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn-delete"
                                            style="display:inline-flex; align-items:center; gap:4px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:500; background:#fef2f2; color:#dc2626; border:0.5px solid #fecaca; cursor:pointer;">
                                            🗑 Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="padding:48px; color:#9ca3af;">No Product</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Bạn có chắc muốn xóa?',
                    text: 'Sản phẩm sẽ bị xóa vĩnh viễn!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endpush
