<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edit Berita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Same custom scrollbar styles as berita.blade.php */
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
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased">
    <!-- Sidebar (Same as berita.blade.php) -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-gradient-to-br from-gray-800 to-gray-900 text-white 
        transform transition-transform duration-300 ease-in-out 
        md:translate-x-0 -translate-x-full z-50 shadow-2xl">
        <!-- Sidebar content same as berita.blade.php -->
        <div class="p-6 bg-opacity-20 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">ADMIN</h1>
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

    <!-- Main Content -->
    <main id="main-content" class="md:ml-72 p-6 transition-all duration-300 ease-in-out">
        <!-- Error Handling -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header -->
        <header class="bg-white shadow-md rounded-xl mb-8 p-5 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('beritaAdmin') }}" class="mr-5 text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="mdi mdi-arrow-left text-2xl"></i>
                </a>
                <h1 class="text-xl md:text-3xl font-bold transition-all duration-300 ease-in-out">
                    Edit Berita
                </h1>
            </div>
        </header>

        <!-- Edit News Form -->
        <div class="bg-white shadow-md rounded-xl p-6 sm:p-8">
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column: Text Inputs -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="mdi mdi-text mr-2 text-blue-500"></i>
                                Judul Berita
                            </label>
                            <input type="text" name="title" 
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                                transition-all duration-300 placeholder-gray-400 text-gray-800" 
                                placeholder="Masukkan judul berita yang menarik" 
                                value="{{ old('title', $berita->title) }}"
                                required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="mdi mdi-file-document mr-2 text-blue-500"></i>
                                Konten Berita
                            </label>
                            <textarea id="news-content" name="content" required>
                                {{ old('content', $berita->content) }}
                            </textarea>
                        </div>
                    </div>

                    <!-- Right Column: Image Upload -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                            <i class="mdi mdi-image mr-2 text-blue-500"></i>
                            Gambar Utama
                        </label>
                        <div class="flex flex-col items-center justify-center w-full">
                            <!-- Image Preview -->
                            <div class="mb-4 w-full max-w-md">
                                <img 
                                    id="image-preview" 
                                    src="{{ $berita->news_images ? asset('storage/news_images/' . $berita->news_images) : 'https://via.placeholder.com/350x250' }}" 
                                    alt="Preview Gambar" 
                                    class="w-full h-56 object-cover rounded-xl border-2 border-gray-200"
                                >
                            </div>

                            <!-- File Input -->
                            <label class="flex flex-col border-2 border-dashed border-gray-300 hover:border-blue-400 rounded-xl p-8 group text-center cursor-pointer 
                                transition-all duration-300 hover:bg-blue-50 w-full">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <i class="mdi mdi-cloud-upload text-5xl text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                                    <p class="text-sm text-gray-500 group-hover:text-blue-500 transition-colors">
                                        Klik untuk unggah gambar baru atau seret dan lepas di sini
                                    </p>
                                    <span class="text-xs text-gray-400">(Maks. 5MB, format JPG/JPEG/PNG)</span>
                                </div>
                                <input type="file" name="image" class="hidden" accept="image/jpeg,image/png,image/jpg" 
                                    onchange="previewImage(event)" maxSize="5120000">
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('beritaAdmin') }}" 
                        class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-colors 
                        flex items-center justify-center space-x-2">
                        <i class="mdi mdi-close mr-2"></i>
                        Batal
                    </a>
                    <button type="submit" 
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2.5 rounded-lg 
                        hover:from-blue-600 hover:to-blue-700 transition-all duration-300 
                        flex items-center justify-center space-x-2 shadow-md hover:shadow-lg">
                        <i class="mdi mdi-content-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Summernote
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
        });

        // Image preview function
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>