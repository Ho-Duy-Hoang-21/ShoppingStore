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

    <section class="reg-wrap">
        <div class="reg-card">

            <div class="reg-brand">
                <div class="reg-brand-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <path d="M16 10a4 4 0 01-8 0" />
                    </svg>
                </div>
                <span style="font-family:'DM Sans',sans-serif;font-size:15px;font-weight:500;color:#1a1a1a;">Shopping
                    Store</span>
            </div>

            <h2 class="reg-title">Create your account</h2>
            <p class="reg-subtitle">Fill in the information below to start using it.</p>

            <form method="POST" action="{{ route('register') }}">
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
                            <input id="name" type="text" class="field-input @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name"
                                autofocus>
                        </div>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- <div>
              <label class="field-label" for="username">Username</label>
              <div class="field-input-wrap">
                <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <input id="username" type="text"
                  class="field-input @error('username') is-invalid @enderror"
                  name="username" value="{{ old('username') }}"
                  placeholder="nguyenvana"
                  required autocomplete="username">
              </div>
              @error('username')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
            </div>
          </div> -->

                    {{-- Email --}}
                    <div class="field-group">
                        <label class="field-label" for="email">{{ __('Email Address') }}</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                <path d="M2 7l10 7 10-7" />
                            </svg>
                            <input id="email" type="email" class="field-input @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Email" required
                                autocomplete="email">
                        </div>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="field-group">
                        <label class="field-label" for="password">{{ __('Password') }}</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <input id="password" type="password"
                                class="field-input @error('password') is-invalid @enderror" name="password"
                                placeholder="Password" required autocomplete="new-password"
                                oninput="checkStrength(this.value)">
                            <button class="eye-btn" type="button" aria-label="Toggle password"
                                onclick="var i=document.getElementById('password');i.type=i.type==='password'?'text':'password';">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        <div class="strength-bar">
                            <div class="strength-seg" id="s1"></div>
                            <div class="strength-seg" id="s2"></div>
                            <div class="strength-seg" id="s3"></div>
                            <div class="strength-seg" id="s4"></div>
                        </div>
                        <div class="strength-label" id="strength-label">Enter Password</div>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="field-group">
                        <label class="field-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <div class="field-input-wrap">
                            <svg class="field-icon" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path d="M9 12l2 2 4-4" />
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <input id="password_confirmation" type="password"
                                class="field-input @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" placeholder="Confirm Password" required
                                autocomplete="new-password">
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-register">{{ __('Create Account') }}</button>

                    <p class="login-link">
                        Do you already have an account?
                        <a href="{{ route('login') }}">Login now</a>
                    </p>

            </form>
        </div>
    </section>

    <script>
        function checkStrength(val) {
            var segs = ['s1', 's2', 's3', 's4'];
            var label = document.getElementById('strength-label');
            segs.forEach(function(id) {
                document.getElementById(id).className = 'strength-seg';
            });
            if (!val) {
                label.textContent = 'Nhập mật khẩu';
                return;
            }
            var score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            var cls = score <= 1 ? 'weak' : score <= 2 ? 'fair' : 'good';
            var labels = {
                weak: 'Yếu — thêm chữ hoa, số hoặc ký tự đặc biệt',
                fair: 'Trung bình',
                good: 'Mạnh'
            };
            for (var i = 0; i < score; i++) document.getElementById(segs[i]).classList.add(cls);
            label.textContent = labels[cls];
        }
    </script>
@endsection
