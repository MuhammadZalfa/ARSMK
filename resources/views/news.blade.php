<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Terkini</title>
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
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @layer utilities {
            .news-card-hover {
                @apply transition-all duration-300 hover:scale-105 hover:shadow-lg;
            }
            .gradient-text {
                @apply text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-primary-700;
            }
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">
    <!-- Existing Navbar from the original file -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="flex justify-between items-center py-4 px-6">
            <!-- Kontak Email dan Telepon -->
            <div class="flex items-center space-x-4">
                <a href="mailto:admin@arsmk.co.id" class="text-sm font-medium text-gray-800 hover:underline">admin@arsmk.co.id</a>
                <a href="https://wa.me/6282122712374" class="flex items-center space-x-2">
                    <img src="{{asset('images/phone.png')}}" alt="Telepon" class="h-5 w-5">
                    <span class="text-sm font-medium text-gray-800">0821-2271-2374</span>
                </a>
            </div>
    
            <!-- Hamburger Menu Button -->
            <button id="menu-btn" class="block md:hidden text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
    
            <!-- Menu Navbar Mode Desktop -->
            <div class="hidden md:flex justify-center border-2 border-[#0C2F50] rounded-full px-3 py-1 space-x-4">
                <a href="{{ route('home') }}#home" class="nav-link relative text-gray-800 font-medium px-4 py-1">HOME</a>
                <a href="{{ route('home') }}#about" class="nav-link text-gray-800 font-medium px-4 py-1">ABOUT</a>
                <a href="{{ route('home') }}#service" class="nav-link text-gray-800 font-medium px-4 py-1">SERVICE</a>
                <a href="{{ route('home') }}#team" class="nav-link text-gray-800 font-medium px-4 py-1">TEAM</a>
                <a href="{{ route('home') }}#contact" class="nav-link text-gray-800 font-medium px-4 py-1">CONTACT</a>
            </div>
        </div>
    
        <!-- Menu Navbar Mode Mobile -->
        <div id="mobile-menu" class="hidden md:hidden space-y-2 bg-gray-100 p-4">
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md bg-gray-200">HOME</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">ABOUT</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">SERVICE</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">TEAM</a>
            <a href="{{ route('home') }}" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">CONTACT</a>
        </div>
    </nav>

    
    
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Kolom Utama Berita -->
            <div class="md:col-span-2 space-y-6">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                    <div class="p-6 md:p-8">
                        <header class="text-center mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 gradient-text">
                                {{ $berita->title }}
                            </h1>
                            <div class="text-gray-500 flex justify-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <i class="bi bi-person-fill text-primary-500"></i>
                                    <span class="font-medium">Admin Redaksi</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="bi bi-calendar-fill text-primary-500"></i>
                                    <span class="font-medium">{{ $berita->created_at->format('d F Y') }}</span>
                                </div>
                            </div>
                        </header>
    
                        @if($berita->news_images)
                        <figure class="mb-6 overflow-hidden rounded-xl">
                            <img 
                                src="{{ asset('storage/news_images/' . $berita->news_images) }}" 
                                alt="{{ $berita->title }}" 
                                class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105"
                            >
                        </figure>
                        @endif
    
                        <div class="prose max-w-none">
                            <div class="text-lg text-gray-700 leading-relaxed mb-4">
                                {!! $berita->content !!}
                            </div>
                        </div>
                    </div>
                </article>
            </div>
    
            <!-- Sidebar Berita -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h4 class="text-xl font-bold text-gray-900 border-b border-primary-100 pb-3 mb-4 gradient-text">
                        Berita Lainnya
                    </h4>
    
                    <div class="space-y-4">
                        @foreach($otherBerita as $artikel)
                            <div class="news-card-hover bg-gray-50 rounded-lg p-4 flex items-center space-x-4 group cursor-hover" onclick="window.location.href='{{ route('berita.show', $artikel->id) }}'">
                                @if($artikel->news_images)
                                <img 
                                    src="{{ asset('storage/news_images/' . $artikel->news_images) }}" 
                                    alt="{{ $artikel->title }}" 
                                    class="w-16 h-16 rounded-md object-cover transition-transform duration-300 group-hover:scale-110"
                                >
                                @endif
                                <div>
                                    <a href="#" class="font-semibold text-gray-800 group-hover:text-primary-600 transition-colors">
                                        {{ $artikel->title }}
                                    </a>
                                    <p class="text-sm text-gray-500">
                                        {{ $artikel->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <!-- Tombol Lihat Semua Berita -->
                    <div class="mt-6">
                        <a href="{{ route('berita') }}" class="w-full block text-center py-3 bg-[#0C2F50] text-white rounded-lg hover:bg-opacity-90 transition-all duration-300 transform hover:scale-105 shadow-md">
                            <i class="bi bi-list-ul mr-2"></i>
                            Lihat Semua Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer remains the same as the original file -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 px-8">
            <!-- Kolom 1: Informasi Perusahaan -->
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
    
            <!-- Kolom 2: Useful Link -->
            <div>
                <h3 class="text-2xl font-bold text-[#0C2F50] mb-4">Useful Link</h3>
                <ul class="text-gray-700 space-y-2">
                    <li><a href="{{ route('home') }}#home" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('home') }}#about" class="hover:underline">About Us</a></li>
                    <li><a href="{{ route('home') }}#service" class="hover:underline">Services</a></li>
                    <li><a href="{{ route('home') }}#team" class="hover:underline">Team</a></li>
                    <li><a href="{{ route('home') }}#contact" class="hover:underline">Contact</a></li>
                </ul>
            </div>
    
            <!-- Kolom 3: Peta -->
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8701714899726!2d106.852133275844!3d-6.148133360268041!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f59a8dcc91bf%3A0x3de81187e99eb835!2sAnimation%20Green%20Screen%20-%203D%20Template%20-%20Virtual%20Stage%20-%20Design%20Services!5e0!3m2!1sid!2sid!4v1736051904701!5m2!1sid!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    
        <!-- Copyright dan Social Media -->
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
        
            // Toggle mobile menu
            menuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        
            // Close mobile menu when a link is clicked
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Redirect to home route
                    window.location.href = '{{ route('home') }}';
                    
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                });
            });
        
            // Close mobile menu if clicked outside
            document.addEventListener('click', function(event) {
                if (!menuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
        </script>
    <script>
        // Toggle mobile menu
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scroll and active link highlighting
        document.addEventListener("DOMContentLoaded", function() {  
            const sections = document.querySelectorAll("section");  
            const navLinks = document.querySelectorAll(".nav-link");  
    
            const observer = new IntersectionObserver((entries) => {  
                entries.forEach(entry => {  
                    const id = entry.target.getAttribute("id");  
                    const navLink = document.querySelector(`a[href="#${id}"]`);  
    
                    if (entry.isIntersecting) {  
                        navLinks.forEach(link => {  
                            link.classList.remove("active-pill");  
                            link.style.color = "#0C2F50"; // Reset color for inactive links  
                        });  
                        navLink.classList.add("active-pill");  
                        navLink.style.color = "white"; // Set color for active link  
                    }  
                });  
            }, { threshold: 0.6 });  
    
            sections.forEach(section => {  
                observer.observe(section);  
            });  
    
            // Smooth scroll for navigation links  
            navLinks.forEach(link => {  
                link.addEventListener("click", function(e) {  
                    e.preventDefault(); // Prevent default anchor click behavior  
                    const targetId = this.getAttribute("href");  
                    const targetSection = document.querySelector(targetId);  
                    targetSection.scrollIntoView({ behavior: "smooth" }); // Smooth scroll to the section  
                });  
            });  
        });  
    </script> 
</body>