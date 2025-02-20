<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ARS Consulting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .login-bg {
            background: linear-gradient(rgba(12, 47, 80, 0.8), rgba(12, 47, 80, 0.8)), 
                        url('{{ asset('images/tall-building-with-sky-background.jpg') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-white text-[#0C2F50] p-8 text-center">
                <img class="mx-auto h-24 w-24 mb-4" src="{{ asset('images/logo.png') }}" alt="ARS Consulting Logo">
                <h2 class="text-3xl font-bold">Login to ARS Consulting</h2>
            </div>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="p-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </span>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required 
                                value="{{ old('email') }}"
                                class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C2F50] shadow-md"
                                placeholder="Enter your email"
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C2F50] shadow-md"
                                placeholder="Enter your password"
                            >
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember-me" 
                            name="remember-me" 
                            type="checkbox" 
                            class="h-4 w-4 text-[#0C2F50] rounded focus:ring-[#0C2F50] border-gray-300"
                        >
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-[#0C2F50] hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C2F50] transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-102 shadow-lg"
                    >
                        Sign In
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center text-white">
            <p>© 2024 ARS Multi Kreasi. All Rights Reserved</p>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="#" class="hover:opacity-75">
                    <img src="{{ asset('images/twitter.png') }}" alt="Twitter" class="w-6 h-6">
                </a>
                <a href="#" class="hover:opacity-75">
                    <img src="{{ asset('images/facebook.png') }}" alt="Facebook" class="w-6 h-6">
                </a>
                <a href="#" class="hover:opacity-75">
                    <img src="{{ asset('images/instagram.png') }}" alt="Instagram" class="w-6 h-6">
                </a>
                <a href="#" class="hover:opacity-75">
                    <img src="{{ asset('images/linkedin.png') }}" alt="LinkedIn" class="w-6 h-6">
                </a>
            </div>
        </div>
    </div>
</body>
</html>