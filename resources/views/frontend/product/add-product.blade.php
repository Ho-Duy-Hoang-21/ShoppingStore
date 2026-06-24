@extends('frontend.layouts.frontend')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.menu-account')
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Create Product</h2>
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
                                    <h2>Create Product</h2>
                                    <form class="form-horizontal form-material" enctype="multipart/form-data"
                                        action="{{ route('member.product.update') }}" method="POST">
                                        @csrf

                                        {{-- Name --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Name Product</label>
                                                <input type="text" name="name" placeholder="Name"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Price --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Price</label>
                                                <input type="number" name="price" placeholder="Price"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Category --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Category</label>
                                                <select name="id_category" class="form-control form-control-line">
                                                    <option value="">Please choose category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Brand --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Brand</label>
                                                <select name="id_brand" class="form-control form-control-line">
                                                    <option value="">Please choose brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Sale --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Option </label>
                                                <select name="status" class="form-control form-control-line"
                                                    id="status">
                                                    <option value="">Please choose option</option>
                                                    <option value="1">New</option>
                                                    <option value="0">Sale</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Sale % - Hide --}}
                                        <div class="form-group" id="sale-group" style="display:none;">
                                            <div class="col-md-12" style="display:flex; align-items:center; gap:8px;">
                                                <input type="number" name="sale" placeholder="0" min="0"
                                                    max="100" class="form-control form-control-line"
                                                    style="width:120px;">
                                                <span>%</span>
                                            </div>
                                        </div>

                                        {{-- Company profile --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Company</label>
                                                <input type="text" name="company" placeholder="Company profile"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Images --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Images (Max 3 image, image < 1MB)</label>
                                                        <input type="file" name="images[]" multiple accept="image/*"
                                                            class="form-control form-control-line">
                                            </div>
                                        </div>

                                        {{-- Detail --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">Detail</label>
                                                <textarea name="detail" placeholder="Detail" rows="5" class="form-control form-control-line"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success">Create Product</button>
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
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('sale-group').style.display = this.value == '0' ? 'block' : 'none';
        });

        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('sale-group').style.display = this.value == '0' ? 'block' : 'none';
        });

        document.querySelector('input[name="images[]"]').addEventListener('change', function() {
            if (this.files.length > 3) {
                Swal.fire({
                    title: 'Quá số lượng ảnh!',
                    html: `Tổng số hình không được vượt quá <b>3</b>.<br>`,
                    icon: 'warning',
                    confirmButtonText: 'Đã hiểu',
                    confirmButtonColor: '#dc2626',
                });
                this.value = '';
            }
        });
    </script>
@endpush
