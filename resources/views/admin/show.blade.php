<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesan - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-2xl w-full p-6 shadow-lg">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full mr-4 border-2 border-gray-200 bg-blue-500 flex items-center justify-center text-white font-bold text-xl">
                        {{ Str::upper(Str::substr($message->sender_name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $message->sender_name }}</h3>
                        <p class="text-gray-600">{{ $message->sender_email }}</p>
                        <p class="text-gray-600 flex items-center mt-1">
                            <i class="mdi mdi-phone mr-2"></i>
                            {{ $message->sender_phone }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('pesanAdmin') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="mdi mdi-close text-2xl"></i>
                </a>
            </div>

            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <h4 class="text-xl font-bold text-gray-800">{{ $message->subject }}</h4>
                    <span class="text-sm text-gray-500">{{ $message->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 whitespace-pre-line">{{ $message->message_body }}</p>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('pesanAdmin') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</html>