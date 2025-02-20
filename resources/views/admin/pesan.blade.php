<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pesan Masuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        /* Enhanced custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f4f4f5;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 10px;
            border: 3px solid #f4f4f5;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* Subtle hover and transition effects */
        .sidebar-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }
        .sidebar-item:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }

        /* Message card hover effect */
        .message-card {
            transition: all 0.3s ease;
        }
        .message-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .modal {
            transition: opacity 0.3s ease-in-out;
        }
        .modal-content {
            transition: transform 0.3s ease-in-out;
        }
        .modal.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .modal.hidden .modal-content {
            transform: scale(0.95);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased">
    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-gradient-to-br from-gray-800 to-gray-900 text-white 
        transform transition-transform duration-300 ease-in-out 
        md:translate-x-0 -translate-x-full z-50 shadow-2xl">
        <div class="p-6 bg-opacity-20 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">ADMIN</h1>
            <button id="close-sidebar" class="md:hidden text-white hover:text-gray-300 transition-colors">
                <i class="mdi mdi-close text-2xl"></i>
            </button>
        </div>
        
        <!-- Profile in sidebar -->
        <div class="p-6 flex items-center border-b border-gray-700 bg-black bg-opacity-10">
            <img src="{{ asset('images/logo.png') }}" alt="Admin" class="rounded-full mr-4 w-12 h-12 border-2 border-gray-600 shadow-lg">
            <div>
                <p class="font-bold text-lg text-white">Admin User</p>
                <p class="text-sm text-gray-400 tracking-wider">Administrator</p>
            </div>
        </div>
        
        <nav class="mt-6 px-4">
            <ul class="space-y-2">
                <li class="sidebar-item px-4 py-3 cursor-pointer flex items-center text-gray-200 hover:text-white" onclick="location.href='{{ route('admin') }}'">
                    <i class="mdi mdi-view-dashboard mr-4 text-xl"></i>
                    <span class="font-medium">Dashboard</span>
                </li>
                <li class="sidebar-item px-4 py-3 cursor-pointer flex items-center text-gray-200 hover:text-white" onclick="location.href='{{ route('beritaAdmin') }}'">
                    <i class="mdi mdi-newspaper mr-4 text-xl"></i>
                    <span class="font-medium">Manajemen Berita</span>
                </li>
                <li class="sidebar-item px-4 py-3 bg-gray-700 cursor-pointer flex items-center text-white" onclick="location.href='{{ route('pesanAdmin') }}'">
                    <i class="mdi mdi-message-text mr-4 text-xl"></i>
                    <span class="font-medium">Pesan Masuk</span>
                </li>
                <li class="sidebar-item px-4 py-3 cursor-pointer flex items-center text-gray-200 hover:text-white" onclick="document.getElementById('logout-form').submit()">
                    <i class="mdi mdi-logout mr-4 text-xl"></i>
                    <span class="font-medium">Logout</span>
                </li>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>
            </ul>
        </nav>
    </aside>

    <!-- Message Modal -->
    <div id="messageModal" class="modal hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="min-h-screen px-4 text-center flex items-center justify-center">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal()"></div>

            <!-- Modal Content -->
            <div class="modal-content bg-white rounded-xl max-w-2xl w-full p-6 relative z-10 transform transition-all">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center">
                        <img id="modalSenderImage" src="https://via.placeholder.com/48" alt="Pengirim" 
                             class="w-12 h-12 rounded-full mr-4 border-2 border-gray-200">
                        <div>
                            <h3 id="modalSenderName" class="text-2xl font-bold text-gray-800"></h3>
                            <p id="modalSenderEmail" class="text-gray-600"></p>
                        </div>
                    </div>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="mdi mdi-close text-2xl"></i>
                    </button>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h4 id="modalSubject" class="text-xl font-bold text-gray-800"></h4>
                        <span id="modalDate" class="text-sm text-gray-500"></span>
                    </div>
                    <p id="modalPhone" class="text-sm text-gray-600 mb-4"></p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p id="modalMessage" class="text-gray-700 whitespace-pre-line"></p>
                </div>

                <div class="mt-6 flex justify-end">
                    <button onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <main id="main-content" class="md:ml-72 p-6 transition-all duration-300 ease-in-out">
        <!-- Header -->
        <!-- Header -->
    <header class="bg-white shadow-md rounded-xl mb-8 p-5">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <button id="toggle-sidebar" class="mr-5 md:hidden block text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="mdi mdi-menu text-2xl"></i>
                </button>
                <h2 class="text-3xl font-bold text-gray-800">Pesan Masuk</h2>
            </div>
            <button onclick="toggleFilter()" class="bg-white border border-gray-300 text-gray-600 px-4 py-2.5 rounded-lg hover:bg-gray-100 flex items-center transition-colors">
                <i class="mdi mdi-filter mr-2"></i>Filter
            </button>
        </div>

        <!-- Filter Form -->
        <div id="filterSection" class="hidden">
            <form action="{{ route('pesanAdmin') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" 
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>

                <div class="md:col-span-3 flex justify-end space-x-3">
                    <a href="{{ route('pesanAdmin') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        Reset
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </header>
    
        <!-- Messages Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($messages as $message)
                <div class="message-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform transition-all duration-300">
                    <a href="{{ route('admin.pesan.show', $message->id) }}" class="block p-5">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full mr-3 border-2 border-gray-200 bg-blue-500 flex items-center justify-center text-white font-bold text-lg">
                                    {{ Str::upper(Str::substr($message->sender_name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $message->sender_name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $message->sender_email }}</p>
                                    <p class="text-sm text-gray-500 flex items-center mt-1">
                                        <i class="mdi mdi-phone mr-1"></i>
                                        {{ $message->sender_phone }}
                                    </p>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500 font-medium">{{ $message->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="mt-4">
                            <h4 class="font-bold text-xl mb-3 text-gray-800 line-clamp-2">{{ $message->subject }}</h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $message->message_body }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-600 text-xl">Tidak ada pesan masuk</p>
                </div>
            @endforelse
        </div>
    
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $messages->links('vendor.pagination.tailwind') }}
        </div>
    </main>
    <script>
        function toggleFilter() {
            const filterSection = document.getElementById('filterSection');
            filterSection.classList.toggle('hidden');
        }
    </script>
</body>
</html>