<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                <li class="sidebar-item px-4 py-3 bg-gray-700 cursor-pointer flex items-center text-white" onclick="location.href='{{ route('admin') }}'">
                    <i class="mdi mdi-view-dashboard mr-4 text-xl"></i>
                    <span class="font-medium">Dashboard</span>
                </li>
                <li class="sidebar-item px-4 py-3 cursor-pointer flex items-center text-gray-200 hover:text-white" onclick="location.href='{{ route('beritaAdmin') }}'">
                    <i class="mdi mdi-newspaper mr-4 text-xl"></i>
                    <span class="font-medium">Manajemen Berita</span>
                </li>
                <li class="sidebar-item px-4 py-3 cursor-pointer flex items-center text-gray-200 hover:text-white" onclick="location.href='{{ route('pesanAdmin') }}'">
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

    <!-- Main Content -->
    <main id="main-content" class="md:ml-72 p-6 transition-all duration-300 ease-in-out">
        <!-- Header -->
        <header class="bg-white shadow-md rounded-xl mb-8 p-5 flex justify-between items-center">
            <div class="flex items-center">
                <button id="toggle-sidebar" class="mr-5 md:hidden block text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="mdi mdi-menu text-2xl"></i>
                </button>
                <h2 class="text-3xl font-bold text-gray-800">Dashboard</h2>
            </div>
        </header>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Berita Section -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-5 bg-gray-50 border-b flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Daftar Berita</h3>
                </div>
                <div class="w-full">
                    @if($latestBerita->count() > 0)
                        <table class="w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Judul</th>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Penulis</th>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestBerita as $item)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="p-4">{{ Str::limit($item->title, 30) }}</td>
                                    <td class="p-4">{{ $item->author->username ?? 'Admin' }}</td>
                                    <td class="p-4">{{ $item->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-4 border-t">
                            {{ $latestBerita->appends(['messages' => request()->get('messages')])->links('vendor.pagination.tailwind') }}
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-500">
                            Belum ada berita yang dibuat
                        </div>
                    @endif
                </div>
            </div>
        
            <!-- Pesan Masuk Section -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-5 bg-gray-50 border-b flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Pesan Masuk</h3>
                </div>
                <div class="w-full">
                    @if($latestMessages->count() > 0)
                        <table class="w-full">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Pengirim</th>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Email</th>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Subjek</th>
                                    <th class="p-4 text-left text-gray-600 font-semibold">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestMessages as $message)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="p-4 flex items-center">
                                        <div class="w-8 h-8 rounded-full mr-3 bg-blue-500 flex items-center justify-center text-white font-bold text-sm">
                                            {{ Str::upper(Str::substr($message->sender_name, 0, 1)) }}
                                        </div>
                                        {{ $message->sender_name }}
                                    </td>
                                    <td class="p-4">{{ $message->sender_email }}</td>
                                    <td class="p-4">{{ Str::limit($message->subject, 30) }}</td>
                                    <td class="p-4">{{ $message->created_at->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-4 border-t">
                            {{ $latestMessages->appends(['berita' => request()->get('berita')])->links('vendor.pagination.tailwind') }}
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-500">
                            Belum ada pesan masuk
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const toggleSidebarBtn = document.getElementById('toggle-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            const mainContent = document.getElementById('main-content');

            // Function to open sidebar
            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }

            // Function to close sidebar
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            // Toggle sidebar on mobile
            toggleSidebarBtn.addEventListener('click', openSidebar);

            // Close sidebar when close button is clicked
            closeSidebarBtn.addEventListener('click', closeSidebar);

            // Close sidebar when overlay is clicked
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Hide overlay and sidebar when screen size is md or larger
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebarOverlay.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                }
            });
        });
    </script>
</body>
</html>