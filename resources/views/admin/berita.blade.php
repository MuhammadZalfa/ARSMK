<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manajemen Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* News card hover effect */
        .news-card {
            transition: all 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Modal styles */
        .modal {
            transition: opacity 0.3s ease;
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
                <li class="sidebar-item px-4 py-3 bg-gray-700 cursor-pointer flex items-center text-white" onclick="location.href='{{ route('beritaAdmin') }}'">
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

    <div id="add-news-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden items-center justify-center overflow-y-auto py-6 sm:py-12 px-4">
        <div class="bg-white w-full max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden transform transition-all duration-300 ease-in-out">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 sm:p-6 flex justify-between items-center">
                <h2 class="text-lg sm:text-2xl font-bold text-white flex items-center">
                    <i class="mdi mdi-newspaper mr-2 sm:mr-3 text-xl sm:text-3xl"></i>
                    <span class="hidden sm:inline">Tambah Berita Baru</span>
                    <span class="sm:hidden">Berita Baru</span>
                </h2>
                <button id="close-add-news-modal" class="text-white hover:text-gray-200">
                    <i class="mdi mdi-close text-2xl"></i>
                </button>
            </div>
            
            <form id="add-news-form" action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" 
                  class="p-4 sm:p-8 space-y-4 sm:space-y-6 bg-gray-50 rounded-b-2xl sm:rounded-b-3xl">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                <div class="space-y-3 sm:space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center text-sm sm:text-base">
                            <i class="mdi mdi-text mr-2 text-blue-500"></i>
                            Judul Berita
                        </label>
                        <div class="relative">
                            <input type="text" name="title" 
                                class="w-full border-2 border-gray-200 rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-sm sm:text-base
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 
                                placeholder-gray-400 text-gray-800" 
                                placeholder="Masukkan judul berita yang menarik" 
                                value="{{ old('title') }}"
                                required>
                            <span class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="mdi mdi-pencil text-sm sm:text-base"></i>
                            </span>
                        </div>
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center text-sm sm:text-base">
                            <i class="mdi mdi-file-document mr-2 text-blue-500"></i>
                            Konten Berita
                        </label>
                        <textarea id="news-content" name="content" required>{{ old('content') }}</textarea>
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center text-sm sm:text-base">
                            <i class="mdi mdi-image mr-2 text-blue-500"></i>
                            Gambar Utama
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col border-2 border-dashed border-gray-300 hover:border-blue-400 rounded-xl p-4 sm:p-8 group text-center cursor-pointer 
                                transition-all duration-300 hover:bg-blue-50">
                                <div class="flex flex-col items-center justify-center space-y-2 sm:space-y-3">
                                    <i class="mdi mdi-cloud-upload text-3xl sm:text-5xl text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                                    <p class="text-xs sm:text-sm text-gray-500 group-hover:text-blue-500 transition-colors">
                                        Klik untuk unggah gambar atau seret dan lepas di sini
                                    </p>
                                    <span class="text-xs text-gray-400 hidden sm:inline">(Maks. 5MB, format JPG/JPEG)</span>
                                </div>
                                <input type="file" name="image" class="hidden" accept="image/jpeg,image/png" maxSize="5120000">
                            </label>
                        </div>
                    </div>
                </div>
    
                <div class="flex justify-end space-x-2 sm:space-x-4 pt-4 border-t border-gray-200">
                    <button type="button" id="cancel-add-news" 
                        class="bg-gray-100 text-gray-700 px-3 py-2 sm:px-6 sm:py-2.5 rounded-lg hover:bg-gray-200 transition-colors 
                        flex items-center justify-center space-x-1 sm:space-x-2 text-sm sm:text-base">
                        <i class="mdi mdi-close mr-1 sm:mr-2"></i>
                        Batal
                    </button>
                    <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-2 sm:px-6 sm:py-2.5 rounded-lg 
                        hover:from-blue-600 hover:to-blue-700 transition-all duration-300 
                        flex items-center justify-center space-x-1 sm:space-x-2 shadow-md hover:shadow-lg text-sm sm:text-base">
                        <i class="mdi mdi-content-save mr-1 sm:mr-2"></i>
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main id="main-content" class="md:ml-72 p-6 transition-all duration-300 ease-in-out">
        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Header -->
        <header class="bg-white shadow-md rounded-xl mb-8 p-5 flex justify-between items-center">
            <div class="flex items-center">
                <button id="toggle-sidebar" class="mr-5 md:hidden block text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="mdi mdi-menu text-2xl"></i>
                </button>
                <h1 class="text-xl md:text-3xl font-bold transition-all duration-300 ease-in-out">
                    Management Berita
                </h1>
            </div>
            <button id="open-add-news-modal" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-2.5 rounded-lg hover:from-blue-600 hover:to-blue-700 flex items-center shadow-md transition-all duration-300 ease-in-out">
                <i class="mdi mdi-plus text-2xl"></i>
            </button>
        </header>
    
        <!-- News Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($berita as $item)
                <div class="news-card bg-white rounded-2xl shadow-lg overflow-hidden 
                    hover:shadow-2xl transform transition-all duration-300 
                    hover:-translate-y-2 border border-gray-100 
                    hover:border-blue-100 group relative">
                    <div class="relative overflow-hidden">
                        <img 
                            src="{{ $item->news_images ? asset('storage/news_images/' . $item->news_images) : 'https://via.placeholder.com/350x250' }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                        <div class="absolute top-3 right-3 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('berita.edit', $item->id) }}" class="bg-blue-500 text-white p-2 rounded-full shadow-md hover:bg-blue-600 transition-colors">
                                <i class="mdi mdi-pencil text-sm"></i>
                            </a>
                            <form action="{{ route('berita.destroy', $item->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" 
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-full shadow-md hover:bg-red-600 transition-colors">
                                    <i class="mdi mdi-delete text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-6 pb-12">
                        <h3 class="font-bold text-xl mb-3 text-gray-800 line-clamp-2 
                            group-hover:text-blue-600 transition-colors">
                            {{ $item->title }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {!! Str::limit(strip_tags($item->content), 150) !!}
                        </p>
                        <div class="flex items-center border-t pt-4 mt-4">
                            <img 
                                src="{{ asset('images/logo.png') }}" 
                                alt="Penulis" 
                                class="w-10 h-10 rounded-full mr-3 border-2 border-gray-200 object-cover"
                            >
                            <div>
                                <span class="text-sm text-gray-700 font-medium block">
                                    {{ $item->author->username ?? 'Admin' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-3 right-3 text-sm text-gray-500 font-medium flex items-center">
                        <i class="mdi mdi-calendar-outline mr-2 text-blue-500"></i>
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl">
                    <i class="mdi mdi-newspaper-variant-outline text-6xl text-gray-400 mb-4 block"></i>
                    <p class="text-gray-600 text-lg">Belum ada berita yang tersedia.</p>
                    <a href="{{ route('berita.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Buat Berita Pertama
                    </a>
                </div>
            @endforelse
        </div>
    
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $berita->links('vendor.pagination.tailwind') }}
        </div>
    </main>
    <!-- Existing script tag and content -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const openModalButton = document.getElementById('open-add-news-modal');
        const addNewsModal = document.getElementById('add-news-modal');
        const closeModalButton = document.getElementById('close-add-news-modal');
        const cancelAddNewsButton = document.getElementById('cancel-add-news');
        
        // Function to open the modal
        function openAddNewsModal() {
            addNewsModal.classList.remove('hidden');
            addNewsModal.classList.add('flex');
            
            // Inisialisasi Summernote
            if (typeof $ !== 'undefined' && $.fn.summernote) {
                $('#news-content').summernote({
                    placeholder: 'Tulis konten berita di sini...',
                    tabsize: 2,
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }

            // Reset form
            const form = document.getElementById('add-news-form');
            if (form) form.reset();
            if (typeof $ !== 'undefined' && $.fn.summernote) {
                $('#news-content').summernote('code', '');
            }
        }

        // Function to close the modal
        function closeAddNewsModal() {
            addNewsModal.classList.remove('flex');
            addNewsModal.classList.add('hidden');
            
            // Destroy Summernote if it exists
            if (typeof $ !== 'undefined' && $.fn.summernote) {
                $('#news-content').summernote('destroy');
            }
        }

        // Add event listeners to open modal button
        if (openModalButton) {
            openModalButton.addEventListener('click', openAddNewsModal);
        }

        // Add event listeners to close modal buttons
        if (closeModalButton) {
            closeModalButton.addEventListener('click', closeAddNewsModal);
        }

        // Add event listener to cancel button
        if (cancelAddNewsButton) {
            cancelAddNewsButton.addEventListener('click', closeAddNewsModal);
        }

        // Close modal when clicking outside
        addNewsModal.addEventListener('click', (e) => {
            if (e.target === addNewsModal) {
                closeAddNewsModal();
            }
        });

        // Prevent event propagation for modal content
        const modalContent = addNewsModal.querySelector('.bg-white');
        if (modalContent) {
            modalContent.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }


        // Ensure Summernote is initialized
        function initSummernote() {
            if (typeof $ !== 'undefined' && $.fn.summernote) {
                $('#news-content').summernote({
                    placeholder: 'Tulis konten berita di sini...',
                    tabsize: 2,
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            }
        }

        // Initial Summernote initialization
        initSummernote();
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const toggleSidebarBtn = document.getElementById('toggle-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            const mainContent = document.getElementById('main-content');

            // Tambah modal untuk konfirmasi hapus berita
            function createDeleteModal(newsTitle) {
                // Membuat overlay modal
                const modalOverlay = document.createElement('div');
                modalOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
                
                // Membuat kontainer modal
                const modalContainer = document.createElement('div');
                modalContainer.className = 'bg-white rounded-xl p-6 max-w-md w-full shadow-2xl';
                modalContainer.innerHTML = `
                    <div class="text-center">
                        <i class="mdi mdi-alert-circle text-5xl text-red-500 mb-4 block"></i>
                        <h2 class="text-xl font-bold mb-4">Hapus Berita</h2>
                        <p class="mb-6 text-gray-600">Apakah Anda yakin ingin menghapus berita "${newsTitle}"?</p>
                        <div class="flex justify-center space-x-4">
                            <button id="cancel-delete" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                            <button id="confirm-delete" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">Hapus</button>
                        </div>
                    </div>
                `;

                // Tambahkan modal ke body
                document.body.appendChild(modalOverlay);
                modalOverlay.appendChild(modalContainer);

                // Tambahkan event listener untuk tombol batal
                document.getElementById('cancel-delete').addEventListener('click', () => {
                    document.body.removeChild(modalOverlay);
                });

                // Tambahkan event listener untuk tombol konfirmasi
                document.getElementById('confirm-delete').addEventListener('click', () => {
                    // Logika penghapusan berita (bisa diganti dengan AJAX call atau logika lainnya)
                    console.log(`Menghapus berita: ${newsTitle}`);
                    document.body.removeChild(modalOverlay);
                });
            }

            // Fungsi untuk membuka sidebar
            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }

            // Fungsi untuk menutup sidebar
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }

            // Toggle sidebar pada layar mobile
            toggleSidebarBtn.addEventListener('click', openSidebar);

            // Tutup sidebar saat tombol close diklik
            closeSidebarBtn.addEventListener('click', closeSidebar);

            // Tutup sidebar saat overlay diklik
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Sembunyikan overlay dan sidebar saat ukuran layar md ke atas
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebarOverlay.classList.add('hidden');
                    sidebar.classList.remove('-translate-x-full');
                }
            });

            // Tambahkan event listener untuk tombol hapus di setiap card berita
            const deleteButtons = document.querySelectorAll('[data-delete-news]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const newsTitle = e.currentTarget.getAttribute('data-delete-news');
                    createDeleteModal(newsTitle);
                });
            });

            // Tambahkan event listener untuk tombol edit di setiap card berita
            const editButtons = document.querySelectorAll('[data-edit-news]');
            editButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const newsId = e.currentTarget.getAttribute('data-edit-news');
                    // Contoh logika edit (bisa diganti dengan redirect atau modal)
                    console.log(`Mengedit berita dengan ID: ${newsId}`);
                });
            });

            // Tambahkan event listener untuk tombol "Tambah Berita"
            const addNewsButton = document.querySelector('[data-add-news]');
            if (addNewsButton) {
                addNewsButton.addEventListener('click', () => {
                    // Contoh logika tambah berita (bisa diganti dengan redirect atau modal)
                    console.log('Membuka form tambah berita baru');
                });
            }

            // Tambahkan event listener untuk pagination
            const paginationButtons = document.querySelectorAll('[data-page]');
            paginationButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const pageNumber = e.currentTarget.getAttribute('data-page');
                    // Contoh logika pagination (bisa diganti dengan AJAX call)
                    console.log(`Pindah ke halaman: ${pageNumber}`);
                });
            });
        });
    </script>
</body>
</html>