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
            line-height: 1.5;
        }

        .pw-alert-ok {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            margin-bottom: 1.25rem;
        }

        .pw-alert-ok svg {
            flex-shrink: 0;
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
            padding: 10px 12px 10px 38px;
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

        .invalid-feedback {
            font-size: 12px;
            color: #dc3545;
            margin-top: 4px;
            display: block;
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
            margin-top: 1.5rem;
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

            <h2 class="pw-title">Forget Pass?</h2>
            <p class="pw-sub">Enter your email address and we will send you a password reset link.</p>

            @if (session('status'))
                <div class="pw-alert-ok">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label class="field-label" for="email">Email</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        <input id="email" type="email" name="email"
                            class="field-input @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="ten@example.com" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-pw">Send link resset password</button>
            </form>

            <a href="{{ route('login') }}" class="pw-back">
                ← Login Back
            </a>

        </div>
    </section>
@endsection
