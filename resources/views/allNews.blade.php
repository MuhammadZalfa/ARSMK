<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini - ARS Multi Kreasi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="flex justify-between items-center py-4 px-6">
            <div class="flex items-center space-x-4">
                <a href="mailto:admin@arsmk.co.id" class="text-sm font-medium text-gray-800 hover:underline">admin@arsmk.co.id</a>
                <a href="https://wa.me/6282122712374" class="flex items-center space-x-2">
                    <img src="{{asset('images/phone.png')}}" alt="Telepon" class="h-5 w-5">
                    <span class="text-sm font-medium text-gray-800">0821-2271-2374</span>
                </a>
            </div>

            <button id="menu-btn" class="block md:hidden text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <div class="hidden md:flex justify-center border-2 border-[#0C2F50] rounded-full px-3 py-1 space-x-4">
                <a href="{{ route('home') }}" class="nav-link relative text-gray-800 font-medium px-4 py-1">HOME</a>
                <a href="{{ route('home') }}" class="nav-link text-gray-800 font-medium px-4 py-1">ABOUT</a>
                <a href="{{ route('home') }}" class="nav-link text-gray-800 font-medium px-4 py-1">SERVICE</a>
                <a href="{{ route('home') }}" class="nav-link text-gray-800 font-medium px-4 py-1">TEAM</a>
                <a href="{{ route('home') }}" class="nav-link text-gray-800 font-medium px-4 py-1">CONTACT</a>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden space-y-2 bg-gray-100 p-4">
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md bg-gray-200">HOME</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">ABOUT</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">SERVICE</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">TEAM</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">CONTACT</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6 max-w-5xl min-h-screen">
        <!-- Search Bar -->
        <form action="{{ route('berita') }}" method="GET">
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <input type="text" 
                       name="search"
                       placeholder="Cari berita..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </form>

        <!-- News List -->
        <div class="space-y-6">
            @foreach($berita as $artikel)
            <article class="bg-white rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row">
                    @if($artikel->news_images)
                    <div class="md:w-1/3">
                        <img 
                            src="{{ asset('storage/news_images/' . $artikel->news_images) }}" 
                            alt="{{ $artikel->title }}" 
                            class="w-full h-48 md:h-full object-cover"
                        >
                    </div>
                    @endif
                    <div class="p-4 md:w-2/3">
                        <div class="mb-2">
                            <span class="text-gray-500 text-sm">{{ $artikel->created_at->format('d M Y') }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2 hover:text-blue-600">
                            <a href="{{ route('berita.show', $artikel->id) }}">
                                {{ $artikel->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit(strip_tags($artikel->content), 150) }}
                        </p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-4">
                                <i class="bi bi-person-fill mr-1"></i>
                                Admin
                            </span>
                            <span>
                                <i class="bi bi-clock-fill mr-1"></i>
                                {{ $artikel->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $berita->links() }}
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-8">
            <div>
                <h3 class="text-2xl font-bold text-[#0C2F50] mb-4">ARS Multi Kreasi</h3>
                <p class="text-gray-700">
                    THE MANSION OFFICE TOWER FONTANA Lantai 12 <br>
                    Unit BF-1782, Jl. Trembesi, Pademangan, Jakarta Utara, <br>
                    DKI Jakarta, 14410
                </p>
                <p class="mt-4">
                    <span class="font-bold">Phone :</span> <a href="https://wa.me/6285212627279" class="hover:underline">085212627279</a>
                </p>
                <p>
                    <span class="font-bold">Email :</span> <a href="mailto:adminsales.tax@arsmk.co.id" class="hover:underline">adminsales.tax@arsmk.co.id</a>
                </p>
            </div>

            <div>
                <h3 class="text-2xl font-bold text-[#0C2F50] mb-4">Useful Link</h3>
                <ul class="text-gray-700 space-y-2">
                    <li><a href="#home" class="hover:underline">Home</a></li>
                    <li><a href="#about" class="hover:underline">About Us</a></li>
                    <li><a href="#service" class="hover:underline">Services</a></li>
                    <li><a href="#team" class="hover:underline">Team</a></li>
                    <li><a href="#contact" class="hover:underline">Contact</a></li>
                </ul>
            </div>

            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8701714899726!2d106.852133275844!3d-6.148133360268041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f59a8dcc91bf%3A0x3de81187e99eb835!2sAnimation%20Green%20Screen%20-%203D%20Template%20-%20Virtual%20Stage%20-%20Design%20Services!5e0!3m2!1sid!2sid!4v1736051904701!5m2!1sid!2sid" 
                    width="100%" 
                    height="200" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="bg-[#0C2F50] text-white py-4 mt-8">
            <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center">
                <p class="mb-4 md:mb-0">2024 © Copyright ARS Multi Kreasi. All Rights Reserved</p>
                <div class="flex flex-wrap justify-center md:justify-end space-x-4">
                    <a href="#" class="hover:text-gray-300 transition-colors">
                        <img src="{{ asset('images/twitter.png') }}" alt="Icon X" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300 transition-colors">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300 transition-colors">
                        <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300 transition-colors">
                        <img src="{{ asset('images/skype.png') }}" alt="Skype" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300 transition-colors">
                        <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn" class="w-6 h-6">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const navLinks = document.querySelectorAll('.nav-link');
        
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    window.location.href = '{{ route('home') }}';
                    mobileMenu.classList.add('hidden');
                });
            });

            document.addEventListener('click', function(event) {
                if (!menuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>