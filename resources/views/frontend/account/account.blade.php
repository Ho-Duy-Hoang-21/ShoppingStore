@extends('frontend.layouts.frontend')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('frontend.layouts.menu-account')
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Update user</h2>

                        @php
                            $member = Auth::guard('web')->user();
                        @endphp

                        @if ($member)
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
                                <div class="signup-form"><!--sign up form-->
                                    <h2>Information User!</h2>
                                    <form class="form-horizontal form-material" enctype="multipart/form-data"
                                        action="{{ route('account.update') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label class="col-md-12">Full Name</label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" value="{{ $member->name }}"
                                                    class="form-control form-control-line" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" value="{{ $member->email }}"
                                                    class="form-control form-control-line" id="example-email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone No</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" value="{{ $member->phone }}"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" value="{{ $member->address }}"
                                                    class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Avatar</label>
                                            <img src="{{ $member->avatar
                                                ? asset('admin/assets/images/upload/avatar/' . $member->avatar)
                                                : asset('admin/assets/images/users/5.jpg') }}"
                                                class="rounded-circle" width="150" height="150"
                                                style="object-fit: cover;margin-left:15px;margin-bottom:15px" />
                                            <div class="col-md-12">
                                                <input type="file" name="avatar" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-12">Select Country</label>
                                            <div class="col-sm-12">
                                                <select class="form-control form-control-line" name="id_country">
                                                    <option value="">-- Select Country --</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ $member->id_country == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success">Update Profile</button>
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
