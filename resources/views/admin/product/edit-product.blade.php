@extends('admin.layouts.admin')
@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Edit Product</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('product.list') }}">List Product</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card" style="max-width: 700px;">
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Price ($)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                class="form-control @error('price') is-invalid @enderror" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="id_category" class="form-control @error('id_category') is-invalid @enderror"
                                required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Brand --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Brand</label>
                            <select name="id_brand" class="form-control @error('id_brand') is-invalid @enderror" required>
                                <option value="">-- Select Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('id_brand', $product->id_brand) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Option</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror"
                                id="statusSelect" required>
                                <option value="">-- Please choose option --</option>
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>New
                                </option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Sale
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sale % - chỉ hiện khi Sale --}}
                        <div class="mb-3" id="saleWrapper"
                            style="{{ old('status', $product->status) == 0 ? 'display:block' : 'display:none' }}">
                            <label class="form-label fw-semibold">Sale (%)</label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" name="sale" value="{{ old('sale', $product->sale) }}"
                                    min="0" max="100" class="form-control @error('sale') is-invalid @enderror"
                                    style="width: 120px;">
                                <span>%</span>
                            </div>
                            @error('sale')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Company --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Company</label>
                            <input type="text" name="company" value="{{ old('company', $product->company) }}"
                                class="form-control @error('company') is-invalid @enderror">
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Ảnh hiện tại + checkbox xóa --}}
                        @php $currentImages = json_decode($product->image, true) ?? []; @endphp
                        @if (count($currentImages) > 0)
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Current Images <small class="text-muted">(tick để
                                        xóa)</small></label>
                                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:8px;">
                                    @foreach ($currentImages as $index => $imgGroup)
                                        <div style="text-align:center;">
                                            <img src="{{ asset('upload/product/thumb/' . $imgGroup) }}"
                                                style="width:85px; height:84px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
                                            <div style="margin-top:4px;">
                                                <input type="checkbox" name="delete_images[]" value="{{ $index }}">
                                                <label style="font-size:12px; color:#dc2626;">Xóa</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Upload ảnh mới --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Add New Images
                                <small class="text-muted">(Max 3 ảnh tổng cộng, mỗi ảnh &lt; 1MB)</small>
                            </label>
                            <input type="file" name="images[]" multiple accept="image/*"
                                class="form-control @error('images') is-invalid @enderror" id="imagesInput">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="imageCountNote" class="text-muted mt-1 d-block">
                                Ảnh hiện tại: <b>{{ count($currentImages) }}</b> — còn có thể thêm: <b
                                    id="canAdd">{{ 3 - count($currentImages) }}</b>
                            </small>
                        </div>

                        {{-- Detail --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Detail</label>
                            <textarea name="detail" rows="5" class="form-control @error('detail') is-invalid @enderror">{{ old('detail', $product->detail) }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                            <a href="{{ route('product.list') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const totalCurrent = {{ count($currentImages) }};

        const statusSelect = document.getElementById('statusSelect');
        const saleWrapper = document.getElementById('saleWrapper');

        statusSelect.addEventListener('change', function() {
            saleWrapper.style.display = this.value == '0' ? 'block' : 'none';
        });

        // Trigger ngay
        statusSelect.dispatchEvent(new Event('change'));

        // Tính số ảnh còn được thêm (trừ đi ảnh đã tick xóa)
        function getDeletedCount() {
            return document.querySelectorAll('.delete-checkbox:checked').length;
        }

        function getRemainingCount() {
            return totalCurrent - getDeletedCount();
        }

        function updateCanAdd() {
            const canAdd = Math.max(0, 3 - getRemainingCount());
            document.getElementById('canAdd').textContent = canAdd;
            return canAdd;
        }

        // Cập nhật note khi tick xóa
        document.querySelectorAll('.delete-checkbox').forEach(function(cb) {
            cb.addEventListener('change', function() {
                updateCanAdd();
                // Reset file input nếu đang chọn quá số lượng
                const fileInput = document.getElementById('imagesInput');
                if (fileInput.files.length > 0) {
                    validateImages(fileInput);
                }
            });
        });

        // Validate khi chọn ảnh mới
        function validateImages(input) {
            const remaining = getRemainingCount();
            const newFiles = input.files.length;
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
                input.value = ''; // reset
            }

            updateCanAdd();
        }

        document.getElementById('imagesInput').addEventListener('change', function() {
            validateImages(this);
        });


        updateCanAdd();
    </script>
@endpush
