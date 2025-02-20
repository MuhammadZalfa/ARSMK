<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Berita;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Store a new message
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Create the message
        Message::create([
            'sender_name' => $validatedData['name'],
            'sender_email' => $validatedData['email'],
            'sender_phone' => $validatedData['phone'] ?? null,
            'subject' => $validatedData['subject'],
            'message_body' => $validatedData['message']
        ]);

        // Get latest news for index page
        $berita = Berita::latest()->paginate(3);

        // Redirect back with success message
        return view('index', compact('berita'))
            ->with('success', 'Pesan Anda berhasil dikirim!');
    }

    /**
     * Display messages in admin panel (for admin users)
     */
    public function index(Request $request)
    {
        $query = Message::query();

        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter berdasarkan status baca
        if ($request->filled('status')) {
            if ($request->status === 'read') {
                $query->whereNotNull('read_at');
            } elseif ($request->status === 'unread') {
                $query->whereNull('read_at');
            }
        }

        // Ambil data dengan pagination
        $messages = $query->latest()->paginate(9)->withQueryString();

        return view('admin.pesan', compact('messages'));
    }

    /**
     * Delete a specific message
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('pesanAdmin')
            ->with('success', 'Pesan berhasil dihapus');
    }

    public function show($id)
{
    $message = Message::findOrFail($id);
    return view('admin.show', compact('message'));
}
}