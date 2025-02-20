<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita di halaman admin
     */
    public function index()
    {
        $berita = Berita::latest()->paginate(6);
        return view('admin.berita', compact('berita'));
    }

    public function showListBerita()
{
    $berita = Berita::latest()->paginate(3);
    return view('index', compact('berita'));
}

    public function show($id)
{
    try {
        $berita = Berita::findOrFail($id);
        
        // Get other news articles (excluding the current one)
        $otherBerita = Berita::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('news', compact('berita', 'otherBerita'));
    } catch (\Exception $e) {
        return redirect()->route('home')->with('error', 'Berita tidak ditemukan');
    }
}

    /**
     * Menampilkan dashboard admin dengan berita terbaru
     */
    public function dashboard()
    {
        // Ambil berita terbaru dengan pagination (10 per halaman)
        $latestBerita = Berita::latest()->paginate(10, ['*'], 'berita');
        
        // Ambil pesan terbaru dengan pagination (10 per halaman)
        $latestMessages = Message::latest()->paginate(10, ['*'], 'messages');

        // Kirim data ke view dashboard admin
        return view('admin.admin', [
            'latestBerita' => $latestBerita,
            'latestMessages' => $latestMessages
        ]);
    }
    /**
     * Menampilkan form tambah berita
     */
    public function create()
    {
        return view('admin.tambah-berita');
    }

    /**
     * Menyimpan berita baru
     */
    public function store(Request $request)
    {   
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png|max:5120' // Maks 5MB
        ]);

        // Proses upload gambar
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($validatedData['title']) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Change this line to use the correct storage path
            $image->move(storage_path('app/public/news_images'), $imageName);
        }

        // Buat berita baru
        $berita = Berita::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'news_images' => $imageName,
            'author_id' => auth()->id() // Asumsikan ada autentikasi
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('beritaAdmin')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.edit', compact('berita'));
    }

    /**
     * Memperbarui berita
     */
    /**
 * Memperbarui berita
 */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120' // Maks 5MB, tambahkan jpg
        ]);

        // Temukan berita yang akan diupdate
        $berita = Berita::findOrFail($id);

        // Proses upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->news_images) {
                // Gunakan Storage::delete untuk menghapus file lama
                Storage::delete('public/news_images/' . $berita->news_images);
            }

            // Generate nama file unik
            $image = $request->file('image');
            $imageName = Str::slug($validatedData['title']) . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Simpan gambar baru
            $image->storeAs('public/news_images', $imageName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imageName = $berita->news_images;
        }

        // Update berita
        $berita->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'news_images' => $imageName
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('beritaAdmin')
            ->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Menghapus berita
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($berita->news_images) {
            Storage::delete('public/news_images/' . $berita->news_images);
        }

        // Hapus berita
        $berita->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('beritaAdmin')
            ->with('success', 'Berita berhasil dihapus');
    }

    /**
     * Menampilkan daftar berita di halaman depan
     */
    public function showNewsList()
    {
        $berita = Berita::latest()->paginate(6);
        return view('news', compact('berita'));
    }
}