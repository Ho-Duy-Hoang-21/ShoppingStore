@extends('frontend.layouts.frontend')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Fraunces:wght@600&display=swap');

        .pw-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fafaf8;
            padding: 2rem 1rem;
        }

        .pw-card {
            background: #fff;
            border: 1px solid #e8e6e0;
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .04);
        }

        .pw-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .pw-brand-icon {
            width: 36px;
            height: 36px;
            background: #F59E0B;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pw-title {
            font-family: 'Fraunces', Georgia, serif;
            font-size: 22px;
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 .25rem;
        }

        .pw-sub {
            font-size: 13px;
            color: #888;
            margin: 0 0 2rem;
            font-family: 'DM Sans', sans-serif;
        }

        .field-group {
            margin-bottom: 1.1rem;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            margin-bottom: 6px;
            font-family: 'DM Sans', sans-serif;
        }

        .field-input-wrap {
            position: relative;
        }

        .field-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .field-input {
            width: 100%;
            padding: 10px 36px 10px 38px;
            border: 1px solid #e0ddd6;
            border-radius: 10px;
            background: #fafaf8;
            color: #1a1a1a;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            box-sizing: border-box;
            transition: border-color .15s, box-shadow .15s;
        }

        .field-input:focus {
            border-color: #F59E0B;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, .12);
        }

        .field-input.is-invalid {
            border-color: #dc3545;
        }

        .field-input[readonly] {
            opacity: .65;
            cursor: not-allowed;
        }

        .invalid-feedback {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
            display: block;
            font-family: 'DM Sans', sans-serif;
        }

        /* Toggle show/hide password */
        .pw-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #aaa;
            display: flex;
            padding: 2px;
            transition: color .15s;
        }

        .pw-toggle:hover {
            color: #555;
        }

        /* Strength bar */
        .str-bar {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .str-seg {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: #e0ddd6;
            transition: background .3s;
        }

        .str-lbl {
            font-size: 11px;
            color: #aaa;
            margin-top: 3px;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-pw {
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
            transition: background .15s;
            margin-top: .5rem;
        }

        .btn-pw:hover {
            background: #D97706;
        }

        .pw-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: 13px;
            color: #F59E0B;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
        }

        .pw-back:hover {
            text-decoration: underline;
        }
    </style>

    <section class="pw-wrap">
        <div class="pw-card">

            <div class="pw-brand">
                <div class="pw-brand-icon">
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

            <h2 class="pw-title">
                Reset password</h2>
            <p class="pw-sub">Create a new password for your account.</p>

            @if ($errors->any())
                <div
                    style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:10px;padding:10px 14px;font-size:13px;font-family:'DM Sans',sans-serif;margin-bottom:1.25rem;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        <input id="email" type="email" name="email"
                            class="field-input @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}"
                            required autocomplete="email" readonly>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Mật khẩu mới --}}
                <div class="field-group">
                    <label class="field-label" for="password">New Password</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input id="password" type="password" name="password"
                            class="field-input @error('password') is-invalid @enderror" placeholder="Tối thiểu 8 ký tự"
                            required autocomplete="new-password" oninput="pwStrength(this.value)">
                        <button type="button" class="pw-toggle" onclick="togglePw('password',this)">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class="str-bar">
                        <div class="str-seg" id="s1"></div>
                        <div class="str-seg" id="s2"></div>
                        <div class="str-seg" id="s3"></div>
                        <div class="str-seg" id="s4"></div>
                    </div>
                    <p class="str-lbl" id="str-lbl"></p>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Xác nhận mật khẩu --}}
                <div class="field-group">
                    <label class="field-label" for="password-confirm">Confirm Password</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input id="password-confirm" type="password" name="password_confirmation" class="field-input"
                            placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                        <button type="button" class="pw-toggle" onclick="togglePw('password-confirm',this)">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-pw">Reset password</button>
            </form>

            <a href="{{ route('login') }}" class="pw-back">← Login Back</a>
        </div>
    </section>

    <script>
        function togglePw(id, btn) {
            const el = document.getElementById(id);
            const show = el.type === 'password';
            el.type = show ? 'text' : 'password';
            btn.style.color = show ? '#F59E0B' : '#aaa';
        }

        function pwStrength(val) {
            const segs = ['s1', 's2', 's3', 's4'].map(id => document.getElementById(id));
            const lbl = document.getElementById('str-lbl');
            const colors = ['transparent', '#ef4444', '#f97316', '#eab308', '#22c55e'];
            const labels = ['', 'Rất yếu', 'Yếu', 'Trung bình', 'Mạnh'];

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            segs.forEach((s, i) => s.style.background = i < score ? colors[score] : '#e0ddd6');
            lbl.textContent = val.length ? labels[score] : '';
            lbl.style.color = colors[score];
        }
    </script>
@endsection
