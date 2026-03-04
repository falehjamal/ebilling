@php($appName = config('app.name', 'E-Billing'))
<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('template/assets') }}/" data-template="vertical-menu-template-free">
<script>
    (function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const html = document.documentElement;
        if (savedTheme === 'dark') {
            html.classList.remove('light-style');
            html.classList.add('dark-style');
        }
    })();
</script>

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', $appName . ' | Sistem Billing')</title>

    <meta name="description" content="Sistem E-Billing" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/ebilling.png') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/fonts/public-sans.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/css/pages/page-auth.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/dark-theme.css') }}" />

    <style>
        .avatar-initials {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #28A745, #1e7e34);
            text-transform: uppercase;
        }
    </style>

    <script src="{{ asset('template/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('template/assets/js/config.js') }}"></script>

    @stack('styles')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.partials.sidebar')

            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <span class="text-muted small me-3" id="pageLoadTime" title="Page Load Time">
                            <i class="bx bx-loader-alt me-1"></i>
                            <span id="pageLoadTimeValue">--</span>
                        </span>
                        <div class="flex-grow-1 overflow-hidden me-3">
                            <marquee behavior="scroll" direction="left" scrollamount="3" class="text-muted small fw-semibold" style="line-height: 2;">
                                Selamat datang di Sistem Informasi e-Billing PT Altech Sistem Indonesia
                            </marquee>
                        </div>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item me-2">
                                <button type="button" class="theme-switcher" id="themeSwitcher" title="Ganti Tema">
                                    <i class="bx bx-moon"></i>
                                    <i class="bx bx-sun"></i>
                                </button>
                            </li>

                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online avatar-initials">A</div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online avatar-initials">{{ strtoupper(substr(billing_user('nama_warga') ?? 'A', 0, 1)) }}</div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ billing_user('nama_warga') ?? 'User' }}</span>
                                                    <small class="text-muted">{{ billing_user('level') ?? 'Pelanggan' }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Pengaturan Akun</span>
                                        </a>
                                    </li>
                                    <li><div class="dropdown-divider"></div></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger w-100 text-start border-0 bg-transparent">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Keluar</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-end py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                &copy;
                                <script>document.write(new Date().getFullYear());</script>, {{ $appName }}.
                            </div>
                        </div>
                    </footer>

                    <div class="content-backdrop fade"></div>
                </div>
            </div>

            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>

    <script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboards-analytics.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        (function() {
            const themeSwitcher = document.getElementById('themeSwitcher');
            const html = document.documentElement;

            function getCurrentTheme() {
                return localStorage.getItem('theme') || 'light';
            }

            function applyTheme(theme) {
                if (theme === 'dark') {
                    html.classList.remove('light-style');
                    html.classList.add('dark-style');
                } else {
                    html.classList.remove('dark-style');
                    html.classList.add('light-style');
                }
                localStorage.setItem('theme', theme);
            }

            function toggleTheme() {
                const currentTheme = getCurrentTheme();
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                applyTheme(newTheme);
            }

            if (themeSwitcher) {
                themeSwitcher.addEventListener('click', toggleTheme);
            }

            if (!localStorage.getItem('theme')) {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                applyTheme(prefersDark ? 'dark' : 'light');
            }
        })();

        window.addEventListener('load', function() {
            setTimeout(function() {
                const el = document.getElementById('pageLoadTimeValue');
                if (!el) return;
                let loadTimeMs = 0;
                const nav = performance.getEntriesByType('navigation')[0];
                const timing = performance.timing;

                if (nav) {
                    if (nav.loadEventEnd > 0) {
                        loadTimeMs = nav.loadEventEnd - nav.startTime;
                    } else if (nav.loadEventStart > 0) {
                        loadTimeMs = nav.loadEventStart - nav.startTime;
                    } else if (nav.domContentLoadedEventEnd > 0) {
                        loadTimeMs = nav.domContentLoadedEventEnd - nav.startTime;
                    } else if (nav.responseEnd > 0) {
                        loadTimeMs = nav.responseEnd - nav.startTime;
                    }
                }
                if (loadTimeMs === 0 && timing) {
                    if (timing.loadEventEnd > 0) {
                        loadTimeMs = timing.loadEventEnd - timing.navigationStart;
                    } else if (timing.loadEventStart > 0) {
                        loadTimeMs = timing.loadEventStart - timing.navigationStart;
                    } else if (timing.domContentLoadedEventEnd > 0) {
                        loadTimeMs = timing.domContentLoadedEventEnd - timing.navigationStart;
                    } else if (timing.responseEnd > 0) {
                        loadTimeMs = timing.responseEnd - timing.navigationStart;
                    }
                }

                el.textContent = loadTimeMs > 0 ? (loadTimeMs / 1000).toFixed(3) + ' detik' : '--';
            }, 0);
        });
    </script>

    @stack('scripts')
</body>

</html>
