@extends('frontend.layouts.frontend')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.menu-account')

                <div class="col-sm-9">
                    <h2 class="title text-center">My Product</h2>
                    <div
                        style="background:var(--color-background-primary); border:0.5px solid #e5e7eb; border-radius:12px; overflow:hidden; margin-top:12px">
                        <table style="width:100%; border-collapse:collapse; font-size:14px;text-align:center">
                            <thead>
                                <tr style="border-bottom:1.5px solid #e5e7eb;">
                                    <td
                                        style="padding:10px 14px; width:72px; font-size:12px; color:#6b7280; text-transform:uppercase; letter-spacing:.04em;">
                                        Image</td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Title</td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Price
                                    </td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Category
                                    </td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Brand
                                    </td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Option
                                    </td>
                                    <td style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase;">
                                        Company
                                    </td>
                                    <td
                                        style="padding:10px 14px; font-size:12px; color:#6b7280; text-transform:uppercase; text-align:center;">
                                        Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="4" style="padding:48px 14px; text-align:center; color:#9ca3af;">
                                            No Product
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                        <tr style="border-bottom:0.5px solid #f3f4f6;">
                                            <td style="padding:12px 14px;">
                                                @php
                                                    $images = json_decode($product->image, true);
                                                @endphp

                                                @if (is_array($images) && count($images) > 0)
                                                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                                        @foreach ($images as $name)
                                                            <img src="{{ asset('upload/product/thumb/' . $name) }}"
                                                                alt="{{ $product->name }}"
                                                                style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:0.5px solid #e5e7eb;">
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span>No image</span>
                                                @endif
                                            </td>
                                            <td style="padding:12px 14px;">
                                                <p style="font-weight:500; margin:0 0 2px;">{{ $product->name }}</p>
                                            </td>
                                            <td style="padding:12px 14px; font-weight:500;">
                                                ${{ number_format($product->price) }}</td>
                                            <td style="padding:12px 14px; font-weight:500;">{{ $product->category->name }}
                                            </td>
                                            <td style="padding:12px 14px; font-weight:500;">{{ $product->brand->name }}</td>
                                            <td style="padding:12px 14px; font-weight:500;">
                                                {{ number_format($product->sale) }}%</td>
                                            <td style="padding:12px 14px; font-weight:500;">{{ $product->company }}</td>

                                            <td style="padding:12px 14px; text-align:right;">
                                                <a href="{{ route('member.product.edit', $product->id) }}"
                                                    style="display:inline-flex; align-items:center; gap:4px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:500; background:#eff6ff; color:#1d4ed8; border:0.5px solid #bfdbfe; text-decoration:none;">
                                                    ✏️ Edit
                                                </a>
                                                <form action="{{ route('member.product.delete', $product->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn-delete"
                                                        style="display:inline-flex; align-items:center; gap:4px; padding:5px 12px; border-radius:8px; font-size:12px; font-weight:500; background:#fef2f2; color:#dc2626; border:0.5px solid #fecaca; cursor:pointer;">
                                                        🗑 Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div style="padding: 12px 14px; border-top: 0.5px solid #e5e7eb;">
                            <a href="{{ route('product.create') }}"
                                style="display:inline-flex; align-items:center; gap:4px; padding:6px 14px; border-radius:8px; font-size:13px; font-weight:500; background:#f0fdf4; color:#16a34a; border:0.5px solid #bbf7d0; text-decoration:none;">
                                ➕ Add Product
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
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
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
