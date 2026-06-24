<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23F59E0B'><path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z'/></svg>">
    <title>Admin</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Fraunces:wght@600&display=swap');

    .login-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fafaf8;
        padding: 2rem 1rem;
    }

    .login-card {
        background: #fff;
        border: 1px solid #e8e6e0;
        border-radius: 20px;
        padding: 2.5rem;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
    }

    .login-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 2rem;
    }

    .login-brand-icon {
        width: 36px;
        height: 36px;
        background: #F59E0B;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-title {
        font-family: 'Fraunces', Georgia, serif;
        font-size: 22px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0 0 0.25rem;
    }

    .login-subtitle {
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
        font-size: 16px;
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

    .remember-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 1.25rem 0 1.5rem;
    }

    .remember-row input {
        accent-color: #F59E0B;
        cursor: pointer;
    }

    .remember-row label {
        font-size: 13px;
        color: #666;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        margin-top: 9px;
    }

    .btn-login {
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
    }

    .btn-login:hover {
        background: #D97706;
    }

    .forgot-link {
        display: block;
        text-align: center;
        margin-top: 1rem;
        font-size: 13px;
        color: #F59E0B;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }
</style>

<body>
    <section class="login-wrap">
        <div class="login-card">

            <div class="login-brand">
                <div class="login-brand-icon">
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

            <h2 class="login-title">ADMIN</h2>
            <p class="login-subtitle">Đăng nhập vào tài khoản của bạn để tiếp tục.</p>

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                {{-- Email --}}
                <div class="field-group">
                    <label class="field-label" for="email">{{ __('Email Address') }}</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="M2 7l10 7 10-7" />
                        </svg>
                        <input id="email" type="email" class="field-input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email"
                            autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field-group">
                    <label class="field-label" for="password">{{ __('Password') }}</label>
                    <div class="field-input-wrap">
                        <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        <input id="password" type="password"
                            class="field-input @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label style="margin-top: 0;" for="remember">{{ __('Remember Me') }}</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login">{{ __('Login') }}</button>

                <!-- @if (Route::has('password.request'))
<a class="forgot-link" href="{{ route('password.request') }}">
      {{ __('Forgot Your Password?') }}
     </a>
@endif -->

            </form>
        </div>
    </section>
</body>

</html>
