<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MAPALA Politala' ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mapala-green': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Heroicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/heroicons@2.0.18/24/outline/index.css">
    
    <!-- Custom CSS -->
    <style>
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2316a34a' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .gradient-bg {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-mapala-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">MAPALA</h1>
                            <p class="text-xs text-gray-500">Politala</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Beranda</a>
                    <a href="/divisi" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Divisi</a>
                    <a href="/kegiatan" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Kegiatan</a>
                    <a href="/kode-etik" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Kode Etik</a>
                    <a href="/about" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Tentang</a>
                    <a href="/contact" class="text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Kontak</a>
                    
                    <?php if (session()->get('user_id')): ?>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-mapala-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                <img class="w-8 h-8 rounded-full bg-mapala-green-100" src="/uploads/fotos/<?= session()->get('user_foto') ?? 'default.jpg' ?>" alt="Profile">
                                <span><?= session()->get('user_name') ?></span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <hr class="my-1">
                                <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/login" class="bg-mapala-green-600 hover:bg-mapala-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                        <a href="/register" class="border border-mapala-green-600 text-mapala-green-600 hover:bg-mapala-green-50 px-4 py-2 rounded-md text-sm font-medium transition-colors">Daftar</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" class="text-gray-700 hover:text-mapala-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenu" class="md:hidden" x-data="{ mobileMenu: false }">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="/" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Beranda</a>
                <a href="/divisi" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Divisi</a>
                <a href="/kegiatan" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Kegiatan</a>
                <a href="/kode-etik" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Kode Etik</a>
                <a href="/about" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Tentang</a>
                <a href="/contact" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Kontak</a>
                
                <?php if (session()->get('user_id')): ?>
                    <hr class="my-2">
                    <a href="/dashboard" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Dashboard</a>
                    <a href="/profile" class="block px-3 py-2 text-gray-700 hover:text-mapala-green-600 rounded-md text-base font-medium">Profil</a>
                    <a href="/logout" class="block px-3 py-2 text-red-600 hover:text-red-700 rounded-md text-base font-medium">Logout</a>
                <?php else: ?>
                    <hr class="my-2">
                    <a href="/login" class="block px-3 py-2 bg-mapala-green-600 text-white rounded-md text-base font-medium">Login</a>
                    <a href="/register" class="block px-3 py-2 border border-mapala-green-600 text-mapala-green-600 rounded-md text-base font-medium mt-2">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="fixed top-20 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <?= session()->getFlashdata('success') ?>
                <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="fixed top-20 right-4 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-lg" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <?= session()->getFlashdata('error') ?>
                <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-mapala-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">MAPALA Politala</h3>
                            <p class="text-sm text-gray-400">Mahasiswa Pecinta Alam</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Organisasi mahasiswa pecinta alam yang berkomitmen untuk melestarikan alam dan mengembangkan kemampuan outdoor mahasiswa Politeknik Negeri Tanah Laut.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Divisi</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="/divisi/gunung-hutan" class="hover:text-white transition-colors">Gunung Hutan</a></li>
                        <li><a href="/divisi/rock-climbing" class="hover:text-white transition-colors">Rock Climbing</a></li>
                        <li><a href="/divisi/arung-jeram" class="hover:text-white transition-colors">Arung Jeram</a></li>
                        <li><a href="/divisi/penelitian-lingkungan" class="hover:text-white transition-colors">Penelitian & Lingkungan</a></li>
                        <li><a href="/divisi/sar" class="hover:text-white transition-colors">SAR</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="/about" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="/kode-etik" class="hover:text-white transition-colors">Kode Etik</a></li>
                        <li><a href="/kegiatan" class="hover:text-white transition-colors">Kegiatan</a></li>
                        <li><a href="/contact" class="hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="/register" class="hover:text-white transition-colors">Daftar Anggota</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> MAPALA Politala. All rights reserved.</p>
                <p class="mt-2">Mahasiswa Pecinta Alam Politeknik Negeri Tanah Laut</p>
            </div>
        </div>
    </footer>

    <!-- Search Modal -->
    <div x-data="{ searchOpen: false }" x-show="searchOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <form action="/search" method="GET">
                        <div class="flex items-center border-b border-gray-300 py-2">
                            <input type="text" name="q" placeholder="Cari kegiatan, divisi, atau informasi..." 
                                   class="flex-1 outline-none text-gray-700" autofocus>
                            <button type="submit" class="ml-2 text-mapala-green-600 hover:text-mapala-green-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="searchOpen = false" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-mapala-green-600 text-base font-medium text-white hover:bg-mapala-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mapala-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>