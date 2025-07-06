<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Digital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }
        .logo-placeholder {
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-gray-100 font-sans flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-indigo-800 text-white flex flex-col h-full shadow-xl">
        <div class="p-4 flex items-center space-x-3 border-b border-indigo-700">
            <div class="logo-placeholder w-10 h-10 flex items-center justify-center">
                <i class="fas fa-cash-register"></i>
            </div>
                       <a href="{{ url('/kasir/dashboard') }}">
            <h1 class="text-xl font-bold">Kasir<span class="text-yellow-300">Digital</span></h1>
            </a>
        </div>

        <div class="flex-1 overflow-y-auto py-4">
            <nav>
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="{{ url('kasir/transaksis') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-lg">
                            <i class="fas fa-shopping-cart w-5 text-center"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('kasir/barangs') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-lg">
                            <i class="fas fa-box-open w-5 text-center"></i>
                            <span>Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('kasir/jenis_barangs') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-lg">
                            <i class="fas fa-tags w-5 text-center"></i>
                            <span>Jenis Barang</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" 
                               class="sidebar-link flex items-center space-x-3 p-3 rounded-lg text-red-200 hover:bg-red-800">
                                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                                <span>Keluar</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="p-4 text-center text-xs text-indigo-300 border-t border-indigo-700">
            <p>© 2025 Kasir</p>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto p-6">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold mt-8 mb-4">Selamat Datang di Sistem Kasir</h2>
            <p class="text-gray-700">
                Gunakan menu navigasi di samping untuk mengakses fitur-fitur sistem kasir. Aplikasi ini mendukung transaksi penjualan, manajemen produk, pelanggan, dan laporan lengkap untuk bisnis Anda.
            </p>
        </div>
    </div>
</body>
</html>
