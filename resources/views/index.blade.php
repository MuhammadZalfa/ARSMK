<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARSMK</title>
    @vite('resources/css/app.css')
    <style>
        html {  
    scroll-behavior: smooth; /* Enable smooth scrolling */  
}  
        /* Styling untuk pill tetap di mode desktop */  
.nav-link {  
    position: relative; /* Ensure positioning for the ::before pseudo-element */  
    color: #0C2F50; /* Default text color */  
    transition: color 0.3s; /* Smooth transition for color change */  
}  

.active-pill {  
    color: white; /* Change text color to white when active */  
}  

.active-pill::before {  
    content: '';  
    position: absolute;  
    height: 100%;  
    width: 100%;  
    background-color: #0C2F50; /* Warna biru */  
    border-radius: 9999px; /* Fully rounded */  
    z-index: -1;  
    top: 0; /* Align to the top */  
    left: 0; /* Align to the left */  
    transition: background-color 0.3s; /* Smooth transition for background color */  
}  

.nav-link:hover {  
    color: #0C2F50; /* Optional: Change text color on hover */  
}  
    </style>
</head>
<body>
    <!-- Navbar -->
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
                <a href="#home" class="nav-link relative text-gray-800 font-medium px-4 py-1">HOME</a>
                <a href="#about" class="nav-link text-gray-800 font-medium px-4 py-1">ABOUT</a>
                <a href="#service" class="nav-link text-gray-800 font-medium px-4 py-1">SERVICE</a>
                <a href="#team" class="nav-link text-gray-800 font-medium px-4 py-1">TEAM</a>
                <a href="#contact" class="nav-link text-gray-800 font-medium px-4 py-1">CONTACT</a>
            </div>
        </div>
    
        <!-- Menu Navbar Mode Mobile -->
        <div id="mobile-menu" class="hidden md:hidden space-y-2 bg-gray-100 p-4">
            <a href="#home" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md bg-gray-200">HOME</a>
            <a href="#about" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">ABOUT</a>
            <a href="#service" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">SERVICE</a>
            <a href="#team" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">TEAM</a>
            <a href="#contact" class="nav-link block text-gray-800 font-medium px-4 py-2 rounded-md">CONTACT</a>
        </div>
    </nav>
    
    <section id="home" class="relative h-screen">
        <!-- Overlay Konten dengan Grid -->
        <div class="grid grid-cols-6 h-full">
            <!-- Sisi Kiri: Logo (Hilang di Mobile) -->
            <div class="hidden md:col-span-1 md:flex justify-center items-center bg-white py-8 md:py-0">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40 h-40 mb-[8rem]">
            </div>
    
            <!-- Sisi Kanan: Konten Teks -->
            <div class="col-span-6 md:col-span-5 flex items-center bg-cover bg-center bg-no-repeat h-full" style="background-image: url('{{ asset('images/tall-building-with-sky-background.jpg') }}');">
                <div>
                    <div class="bg-[#0C2F50] text-white p-6 md:p-12 rounded-r-lg max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 md:mb-6">ARS Consulting</h1>
                    </div>                    
                    <p class="text-xl md:text-5xl font-bold text-white mt-4 md:mt-6 ml-4 md:ml-12">We provide solutions <br> for your business!</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Informasi Pajak Terkini</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Berita dan artikel terbaru seputar perpajakan nasional dan global</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($berita as $item)
                    <div class="group bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative overflow-hidden rounded-t-xl">
                            <img 
                                src="{{ asset('storage/news_images/' . $item->news_images) }}" 
                                alt="{{ $item->title }}" 
                                class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-110"
                            >
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                                {{ $item->title }}
                            </h3>

                            <div class="flex items-center justify-between">
                                <a 
                                    href="{{ route('berita.show', $item->id) }}" 
                                    class="text-blue-500 font-semibold hover:text-blue-700 flex items-center"
                                >
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Tidak ada artikel yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            
            @if($berita->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $berita->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </section>
    <section id="about" class="py-12 px-6 bg-white">
        <div class="max-w-7xl mx-auto">  
            <!-- Heading dan Deskripsi -->  
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">  
                <!-- Kiri: Heading dan Icon -->  
                <div class="flex items-center space-x-4">  
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />  
                    </svg>  
                    <h2 class="text-3xl font-bold text-blue-600">About Us</h2>  
                </div>  
    
                <!-- Kanan: Deskripsi dan Logo -->  
                <div class="flex items-start space-x-4">  
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16">  
                    <p class="text-lg text-gray-700">  
                        ARS Consulting is a legal entity domiciled in Jakarta, Indonesia which operates in the field of tax services and other services to support and enhance business actors in various fields business sector.  
                    </p>  
                </div>  
            </div>  
        </div>   
    </section>
    <section class="py-16 px-8 bg-[#0C2F50] text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Kiri: Teks Vision -->
            <div>
                <h2 class="text-4xl font-bold mb-6">Our Vision</h2>
                <p class="text-2xl leading-relaxed">
                    Become a professional, trustworthy and reputable Work Partner in the fields of Finance and Taxation. Prioritizing the best and innovative Services while always upholding integrity and professionalism.
                </p>
            </div>

            <!-- Kanan: Gambar -->
            <div>
                <img src="{{ asset('images/vision.png') }}" alt="Vision Image" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </section>
    <section class="py-12 px-6 bg-[#0C2F50] text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Kiri: Teks Mission -->
            <div>
                <h2 class="text-5xl font-bold mb-8">Our Mission</h2>
                <p class="text-2xl leading-relaxed">
                    1. Providing the best service to Clients as a Work Partner <br><br>
                    2. Building good relationships and networks with Stakeholders (Clients, Government and Society) <br><br>
                    3. Developing employees into professional Consultants/Advisors who can deliver services according to client expectations.
                </p>
            </div>
    
            <!-- Kanan: Gambar -->
            <div>
                <img src="{{ asset('images/mission.png') }}" alt="Mission Image" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </section>
    <section id="service" class="py-12 px-6 bg-[#0C2F50] text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Kiri: Teks dan Daftar Layanan -->
            <div>
                <h2 class="text-4xl font-bold mb-4">Our Services</h2>
                <p class="text-lg mb-6">We offer a variety of services tailored to client needs.</p>
                <div class="grid grid-cols-2 gap-x-8 gap-y-4 text-lg">
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Consultant</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Consultant</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Assistency</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Assistency</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Planning</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>➔</span>
                        <span>Tax Planning</span>
                    </div>
                </div>
            </div>
    
            <!-- Kanan: Gambar -->
            <div>
                <img src="{{ asset('images/services.png') }}" alt="Services Image" class="w-full rounded-lg shadow-lg">
            </div>
        </div>
    </section>
    <section class="py-16 px-8 bg-white text-[#0C2F50]">
        <div class="max-w-7xl mx-auto">
            <!-- Heading dan Deskripsi -->
            <div class="mb-12">
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <h2 class="text-4xl font-bold">Our Impact</h2>
                </div>
                <p class="text-2xl">Turning insights into action has driven our impact on clients and communities over the years.</p>
            </div>
    
            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mb-12">
                <div>
                    <h3 class="text-6xl font-bold text-blue-600">100+</h3>
                    <p class="text-lg mt-2">Clients Served</p>
                </div>
                <div>
                    <h3 class="text-6xl font-bold text-blue-600">100+</h3>
                    <p class="text-lg mt-2">Businesses Optimized</p>
                </div>
                <div>
                    <h3 class="text-6xl font-bold text-blue-600">100+</h3>
                    <p class="text-lg mt-2">Projects Delivered</p>
                </div>
            </div>
    
            <!-- Our Valuable Client -->
            <div>
                <div class="flex items-center space-x-4 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <h2 class="text-4xl font-bold">Our Valuable Client</h2>
                </div>
    
                <!-- Logo Client -->
                <div class="grid grid-cols-2 md:grid-cols-6 gap-8 items-center">
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-1.png')}}" alt="Client 1" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-2.png')}}" alt="Client 2" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-3.png')}}" alt="Client 3" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-4.png')}}" alt="Client 4" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-5.png')}}" alt="Client 5" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-6.png')}}" alt="Client 6" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-7.png')}}" alt="Client 7" class="w-2/3">
                    </div>
                    <div class="flex justify-center items-center">
                        <img src="{{asset('images/client-8.png')}}" alt="Client 8" class="w-2/5">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="team" class="py-16 px-8 bg-[#0C2F50] text-white">
        <div class="max-w-7xl mx-auto">
            <!-- Heading -->
            <h2 class="text-4xl font-bold text-center mb-12">Our Winning Team</h2>
    
            <!-- Grid Tim -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Card Tim -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <img src="{{ asset('images/PaBagus.jpg') }}" alt="Team Member" class="w-36 h-36 rounded-full object-cover shadow-lg">
                    <div>
                        <h3 class="text-lg font-bold">Pa Bagus</h3>
                        <p class="text-sm text-blue-300 uppercase">Managing Partner</p>
                    </div>
                </div>
    
                <!-- Card Tim -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <img src="{{asset('images/BuLady.jpg') }}" alt="Team Member" class="w-36 h-36 rounded-full object-cover shadow-lg">
                    <div>
                        <h3 class="text-lg font-bold">Bu Lady</h3>
                        <p class="text-sm text-blue-300 uppercase">Partner</p>
                    </div>
                </div>
    
                <!-- Card Tim -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <img src="{{ asset('images/IdaFarida.jpeg') }}" alt="Team Member" class="w-36 h-36 rounded-full object-cover shadow-lg">
                    <div>
                        <h3 class="text-lg font-bold">Ida Farida</h3>
                        <p class="text-sm text-blue-300 uppercase">Tax Consultant</p>
                    </div>
                </div>
    
                <!-- Duplicate Card Tim -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <img src="{{ asset('images/Dina.jpeg') }}" alt="Team Member" class="w-36 h-36 rounded-full object-cover shadow-lg">
                    <div>
                        <h3 class="text-lg font-bold">Dina Rusyida Khoirini</h3>
                        <p class="text-sm text-blue-300 uppercase">Tax Consultant</p>
                    </div>
                </div>
    
                <!-- Duplicate Card Tim -->
                <div class="flex flex-col items-center text-center space-y-4">
                    <img src="{{ asset('images/Ahmad.jpeg') }}" alt="Team Member" class="w-36 h-36 rounded-full object-cover shadow-lg">
                    <div>
                        <h3 class="text-lg font-bold">Muhammad Faqih Abdurrahman, S.M</h3>
                        <p class="text-sm text-blue-300 uppercase">Tax Consultant</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="contact" class="py-16 px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <!-- Heading -->
            <h2 class="text-4xl font-bold text-center text-[#0C2F50] mb-12">Send Us a Message</h2>
    
            <!-- Wadah Utama -->
            <div class="grid grid-cols-1 md:grid-cols-[1fr_2fr_1fr] gap-0 rounded-lg shadow-lg overflow-hidden">
                <!-- Div Pertama (Gambar Background Kiri) -->
                <div class="hidden md:block bg-cover bg-center bg-no-repeat h-full" style="background-image: url('{{ asset('images/kiri.png') }}');">
                </div>
    
                <!-- Div Kedua (Form di Tengah) -->
                <div class="bg-gray-200 p-8">
                    <form action="{{ route('messages.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <!-- Input Nama -->
                        <input type="text" name="name" placeholder="Name" 
                            class="w-full p-4 rounded-full border border-gray-300 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('name') }}" required>
                        
                        <!-- Input Email -->
                        <input type="email" name="email" placeholder="Email" 
                            class="w-full p-4 rounded-full border border-gray-300 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('email') }}" required>
                        
                        <!-- Input Phone -->
                        <input type="text" name="phone" placeholder="Phone" 
                            class="w-full p-4 rounded-full border border-gray-300 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('phone') }}">
                        
                        <!-- Input Subject -->
                        <input type="text" name="subject" placeholder="Subject" 
                            class="w-full p-4 rounded-full border border-gray-300 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('subject') }}" required>
                        
                        <!-- Textarea Message -->
                        <textarea name="message" placeholder="Messages" rows="5" 
                            class="w-full p-4 rounded-lg border border-gray-200 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 col-span-1 md:col-span-2"
                            required>{{ old('message') }}</textarea>
                        
                        <!-- Submit Button -->
                        <div class="col-span-1 md:col-span-2 text-center">
                            <button type="submit" class="px-6 py-3 bg-[#0C2F50] text-white font-semibold rounded-full shadow-lg hover:bg-[#0A4072] focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Send Messages
                            </button>
                        </div>
                    </form>
                </div>
    
                <!-- Div Ketiga (Gambar Background Kanan) -->
                <div class="hidden md:block bg-cover bg-center" style="background-image: url('{{ asset('images/kanan.png') }}');">
                </div>
            </div>
        </div>
    </section>
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
                    <li><a href="#home" class="hover:underline">Home</a></li>
                    <li><a href="#about" class="hover:underline">About Us</a></li>
                    <li><a href="#service" class="hover:underline">Services</a></li>
                    <li><a href="#team" class="hover:underline">Team</a></li>
                    <li><a href="#contact" class="hover:underline">Contact</a></li>
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
                    <a href="#" class="hover:text-gray-300">
                        <img src="{{ asset('images/twitter.png') }}" alt="Icon X" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300">
                        <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300">
                        <img src="{{ asset('images/skype.png') }}" alt="Skype" class="w-6 h-6">
                    </a>
                    <a href="#" class="hover:text-gray-300">
                        <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn" class="w-6 h-6">
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
       
    <script>
        // Toggle mobile menu
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
    
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        //
        function showPage(page) {
        // Hide all pages
        document.getElementById('page-1').classList.add('hidden');
        document.getElementById('page-2').classList.add('hidden');

        // Show the selected page
        document.getElementById(`page-${page}`).classList.remove('hidden');
    }
    </script>
    <script>  
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
</html>
