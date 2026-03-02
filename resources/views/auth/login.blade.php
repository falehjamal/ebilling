<!DOCTYPE html>
<html lang="id" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('template/assets') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Masuk | {{ config('app.name', 'E-Billing') }}</title>
    <meta name="description" content="Sistem E-Billing">
    <link rel="icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fonts/public-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/pages/page-auth.css') }}">
    <script src="{{ asset('template/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('template/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="app-brand justify-content-center mb-2">
                                <a href="{{ route('login') }}" class="app-brand-link gap-2">
                                    <span class="app-brand-logo">
                                        <img src="{{ asset('img/ebilling.png') }}" alt="Logo" style="max-height: 48px; width: auto;">
                                    </span>
                                </a>
                            </div>
                            <span style="display: block; font-size: .75rem; color: #a1acb8; line-height: 1.3; letter-spacing: .3px;">PT. Altech Sistem Indonesia</span>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="mb-3" id="formAuthentication">
                            @csrf
                            <div class="mb-3">
                                <label for="account" class="form-label">Account</label>
                                <input type="text" class="form-control @error('account') is-invalid @enderror"
                                    id="account" name="account" value="{{ old('account') }}"
                                    placeholder="39511" autofocus required>
                                @error('account')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}"
                                    placeholder="ahmad" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" autocomplete="current-password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                        <p class="text-center mb-0">
                            <a href="https://e.ebilling.id/billing/lupa" target="_blank" class="text-muted">Lupa Password</a>
                            <span class="text-muted"> · </span>
                            <a href="https://e.ebilling.id/billing/paket" target="_blank" class="text-muted">Registrasi</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>
</body>

</html>
