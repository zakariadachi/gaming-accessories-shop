<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gaming Shop - La boutique ultime pour vos accessoires gaming">
    <title>@yield('title', 'Gaming Shop')</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:    #7c3aed;
            --primary-dark: #5b21b6;
            --accent:     #06b6d4;
            --dark-bg:    #0a0a0f;
            --card-bg:    #12121c;
            --surface:    #1a1a2e;
            --border:     #2a2a4a;
            --text-light: #e2e8f0;
            --text-muted: #94a3b8;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .navbar-gaming {
            background: rgba(10, 10, 15, 0.95);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            padding: 0.75rem 0;
        }

        .navbar-brand-gaming {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 1.4rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav-link-gaming {
            color: var(--text-muted) !important;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: color 0.2s;
            padding: 0.5rem 0.9rem !important;
        }

        .nav-link-gaming:hover, .nav-link-gaming.active {
            color: var(--accent) !important;
        }

        .btn-nav-login {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary) !important;
            border-radius: 6px;
            padding: 0.35rem 1rem !important;
            transition: all 0.2s;
        }

        .btn-nav-login:hover {
            background: var(--primary);
            color: #fff !important;
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border: none;
            color: #fff !important;
            border-radius: 6px;
            padding: 0.35rem 1rem !important;
            transition: opacity 0.2s;
        }

        .btn-nav-register:hover { opacity: 0.85; }

        .badge-admin {
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            font-size: 0.65rem;
            border-radius: 4px;
            padding: 2px 6px;
            vertical-align: middle;
        }

        /* ── FOOTER ── */
        .footer-gaming {
            background: var(--surface);
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            padding: 2rem 0 1rem;
            margin-top: auto;
        }

        .footer-brand {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── ALERTS ── */
        .alert { border-radius: 8px; border: none; }
        .alert-success { background: rgba(16, 185, 129, 0.15); color: #6ee7b7; border-left: 3px solid #10b981; }
        .alert-danger  { background: rgba(239, 68, 68, 0.15);  color: #fca5a5; border-left: 3px solid #ef4444; }
        .alert-warning { background: rgba(245, 158, 11, 0.15); color: #fcd34d; border-left: 3px solid #f59e0b; }
        .alert-info    { background: rgba(6, 182, 212, 0.15);  color: #67e8f9; border-left: 3px solid #06b6d4; }

        /* ── NAVBAR TOGGLER ── */
        .navbar-toggler { border-color: var(--border); }
        .navbar-toggler-icon { filter: invert(1); }

        main { flex: 1; }
    </style>

    @stack('styles')
</head>
<body>

{{-- ══════════════ NAVBAR ══════════════ --}}
<nav class="navbar navbar-expand-lg navbar-gaming sticky-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand-gaming" href="{{ url('/') }}">
            <i class="bi bi-controller"></i> GAMING<span style="color:var(--accent)">SHOP</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
                <li class="nav-item">
                    <a class="nav-link-gaming nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-gaming nav-link {{ request()->is('products*') ? 'active' : '' }}"
                       href="{{ url('/products') }}">
                        <i class="bi bi-grid me-1"></i>Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-gaming nav-link {{ request()->is('categories*') ? 'active' : '' }}"
                       href="{{ url('/categories') }}">
                        <i class="bi bi-tags me-1"></i>Catégories
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center gap-2">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link-gaming nav-link" href="{{ url('/admin/dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                <span class="badge-admin ms-1">ADMIN</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link-gaming nav-link" href="{{ url('/orders') }}">
                                <i class="bi bi-bag me-1"></i>Mes commandes
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ url('/logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-nav-login nav-link">
                                <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link btn-nav-login nav-link" href="{{ url('/login') }}" id="navLoginBtn">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-nav-register nav-link" href="{{ url('/register') }}" id="navRegisterBtn">
                            <i class="bi bi-person-plus me-1"></i>Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- ══════════════ FLASH MESSAGES ══════════════ --}}
@if(session('success') || session('error') || session('warning') || session('info'))
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('warning') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>
@endif

{{-- ══════════════ MAIN CONTENT ══════════════ --}}
<main>
    @yield('content')
</main>

{{-- ══════════════ FOOTER ══════════════ --}}
<footer class="footer-gaming">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="footer-brand">
                    <i class="bi bi-controller"></i> GAMING<span style="color:var(--accent)">SHOP</span>
                </div>
                <p class="mt-2 mb-0" style="font-size:0.85rem;">
                    La boutique ultime pour vos accessoires gaming.
                </p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0 text-md-center">
                <h6 class="text-white fw-bold mb-2">Liens rapides</h6>
                <div class="d-flex flex-column gap-1" style="font-size:0.9rem;">
                    <a href="{{ url('/') }}" class="text-muted text-decoration-none" style="transition:color .2s" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">Accueil</a>
                    <a href="{{ url('/products') }}" class="text-muted text-decoration-none" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">Produits</a>
                    <a href="{{ url('/categories') }}" class="text-muted text-decoration-none" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color=''">Catégories</a>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <p class="mb-1" style="font-size:0.85rem;">
                    <i class="bi bi-envelope me-1"></i> contact@gamingshop.ma
                </p>
                <div class="d-flex gap-3 justify-content-md-end mt-2">
                    <a href="#" class="text-muted fs-5" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-muted fs-5" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-muted fs-5" title="Discord"><i class="bi bi-discord"></i></a>
                </div>
            </div>
        </div>
        <hr style="border-color:var(--border); margin:1.5rem 0 1rem;">
        <p class="text-center mb-0" style="font-size:0.8rem; color:var(--text-muted);">
            &copy; {{ date('Y') }} GamingShop — Projet Fil Rouge YouCode.
        </p>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
