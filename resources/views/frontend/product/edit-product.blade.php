@extends('frontend.layouts.frontend')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.menu-account')
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Edit Product</h2>
                        @if (Auth::check())
                            <div class="page-wrapper">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="signup-form">
                                    <h2>Edit Product</h2>
                                    <form class="form-horizontal form-material" enctype="multipart/form-data"
                                        action="{{ route('member.product.edit.update', $product->id) }}" method="POST">
                                        @csrf

                                        {{-- Name --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Name Product</label>
                                                <input type="text" name="name" value="{{ $product->name }}"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Price --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Price</label>
                                                <input type="number" name="price" value="{{ $product->price }}"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Category --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Category</label>
                                                <select name="id_category" class="form-control form-control-line">
                                                    <option value="">Please choose category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $product->id_category == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Brand --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Brand</label>
                                                <select name="id_brand" class="form-control form-control-line">
                                                    <option value="">Please choose brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}"
                                                            {{ $product->id_brand == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Option</label>
                                                <select name="status" class="form-control form-control-line"
                                                    id="status">
                                                    <option value="">Please choose option</option>
                                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>
                                                        New</option>
                                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>
                                                        Sale</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Sale % --}}
                                        <div class="form-group" id="sale-group"
                                            style="{{ $product->status == 0 ? 'display:block' : 'display:none' }}">
                                            <div class="col-md-12" style="display:flex; align-items:center; gap:8px;">
                                                <input type="number" name="sale"
                                                    value="{{ number_format($product->sale) }}" min="0"
                                                    max="100" class="form-control form-control-line"
                                                    style="width:120px;">
                                                <span>%</span>
                                            </div>
                                        </div>

                                        {{-- Company --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Company</label>
                                                <input type="text" name="company" value="{{ $product->company }}"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Ảnh hiện tại + checkbox xóa --}}
                                        @php $currentImages = json_decode($product->image, true) ?? []; @endphp
                                        @if (count($currentImages) > 0)
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Hình ảnh hiện tại (tick để xóa)</label>
                                                    <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:8px;">
                                                        @foreach ($currentImages as $index => $imgGroup)
                                                            <div style="text-align:center;">
                                                                <img src="{{ asset('upload/product/thumb/' . $imgGroup) }}"
                                                                    style="width:85px; height:84px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
                                                                <div style="margin-top:4px;">
                                                                    <input type="checkbox" name="delete_images[]"
                                                                        value="{{ $index }}">
                                                                    <label
                                                                        style="font-size:12px; color:#dc2626;">Xóa</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Upload ảnh mới --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Add New Image (Max 3 Image, Image < 1MB)</label>
                                                        <input type="file" name="images[]" multiple accept="image/*"
                                                            class="form-control form-control-line" id="images-input">
                                            </div>
                                        </div>

                                        {{-- Detail --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>Detail</label>
                                                <textarea name="detail" rows="5" class="form-control form-control-line">{{ $product->detail }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success">Update Product</button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        // Hiện/ẩn sale %
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('sale-group').style.display = this.value == '0' ? 'block' : 'none';
        });



        document.getElementById('images-input').addEventListener('change', function() {
            const currentCount = {{ count($currentImages) }};
            const checkedDelete = document.querySelectorAll('input[name="delete_images[]"]:checked').length;
            const remaining = currentCount - checkedDelete;
            const newFiles = this.files.length;
            const total = remaining + newFiles;

            if (total > 3) {
                Swal.fire({
                    title: 'Quá số lượng ảnh!',
                    html: `Tổng số hình không được vượt quá <b>3</b>.<br>
                   Ảnh hiện tại còn lại: <b>${remaining}</b><br>
                   Ảnh muốn thêm: <b>${newFiles}</b><br>
                   Tổng: <b>${total}</b>`,
                    icon: 'warning',
                    confirmButtonText: 'Đã hiểu',
                    confirmButtonColor: '#dc2626',
                });
                this.value = ''; // reset input
            }
        });
    </script>
@endpush
