<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        /* === ANIMATIONS === */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-24px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(24px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
            50% { box-shadow: 0 0 16px 4px rgba(239, 68, 68, 0.15); }
        }

        .animate-fadeIn { animation: fadeIn 0.5s ease-out both; }
        .animate-slideUp { animation: slideUp 0.5s ease-out both; }
        .animate-slideInLeft { animation: slideInLeft 0.5s ease-out both; }
        .animate-slideInRight { animation: slideInRight 0.4s ease-out both; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out both; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Hover card lift */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
        }

        /* Table row hover */
        .row-hover {
            transition: all 0.2s ease;
        }
        .row-hover:hover {
            background-color: rgba(254, 226, 226, 0.3);
            transform: scale(1.002);
        }

        /* Button hover */
        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px -4px rgba(239, 68, 68, 0.4);
        }
        .btn-hover:active {
            transform: translateY(0);
        }

        /* Nav link hover */
        .nav-hover {
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px;
            height: 60%;
            background: #ef4444;
            border-radius: 0 4px 4px 0;
            transition: transform 0.3s ease;
        }
        .nav-hover:hover::before {
            transform: translateY(-50%) scaleY(1);
        }

        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }

        /* scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 8px; }
        ::-webkit-scrollbar-thumb:hover { background: #b91c1c; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    @yield('content')
    @stack('scripts')
</body>
</html>
