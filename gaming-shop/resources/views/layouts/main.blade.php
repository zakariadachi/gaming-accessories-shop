<!DOCTYPE html>
<html class="dark" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'GearHub | Ultimate Gaming Gear')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#8a2ce2",
                        "primary-dim": "#9c42f4",
                        "primary-fixed": "#c185ff",
                        "primary-fixed-dim": "#b772ff",
                        "primary-container": "#c185ff",
                        "on-primary": "#46007d",
                        "on-primary-fixed": "#000000",
                        "on-primary-fixed-variant": "#420078",
                        "on-primary-container": "#350062",
                        "background": "#0e0e0e",
                        "background-light": "#f7f6f8",
                        "background-dark": "#191121",
                        "on-background": "#ffffff",
                        "surface": "#2d1b42",
                        "surface-light": "#3d2a56",
                        "surface-dim": "#0e0e0e",
                        "surface-bright": "#2c2c2c",
                        "surface-variant": "#262626",
                        "surface-tint": "#ca98ff",
                        "surface-container": "#1a1a1a",
                        "surface-container-low": "#131313",
                        "surface-container-high": "#20201f",
                        "surface-container-highest": "#262626",
                        "surface-container-lowest": "#000000",
                        "on-surface": "#ffffff",
                        "on-surface-variant": "#adaaaa",
                        "secondary": "#e097fd",
                        "secondary-dim": "#d18aee",
                        "secondary-fixed": "#f0c1ff",
                        "secondary-fixed-dim": "#e9aeff",
                        "secondary-container": "#692886",
                        "on-secondary": "#520c70",
                        "on-secondary-fixed": "#540f72",
                        "on-secondary-fixed-variant": "#743391",
                        "on-secondary-container": "#efc0ff",
                        "tertiary": "#ff8b9a",
                        "tertiary-dim": "#f47788",
                        "tertiary-fixed": "#ff909e",
                        "tertiary-fixed-dim": "#fa7c8d",
                        "tertiary-container": "#f7798b",
                        "on-tertiary": "#62041f",
                        "on-tertiary-fixed-variant": "#711229",
                        "on-tertiary-container": "#4d0015",
                        "outline": "#767575",
                        "outline-variant": "#484847",
                        "error": "#ff6e84",
                        "error-dim": "#d73357",
                        "error-container": "#a70138",
                        "on-error": "#490013",
                        "on-error-container": "#ffb2b9",
                        "inverse-primary": "#8523dd",
                        "inverse-surface": "#fcf9f8",
                        "inverse-on-surface": "#565555",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Manrope"],
                        "label": ["Manrope"],
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block; line-height: 1; text-transform: none;
            letter-spacing: normal; word-wrap: normal; white-space: nowrap; direction: ltr;
        }
        body { background-color: #0e0e0e; color: #ffffff; font-family: 'Manrope', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="selection:bg-primary selection:text-on-primary min-h-screen flex flex-col">

    @include('layouts.partials.navbar')

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('scripts')
</body>
</html>
