<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    // TAMPILKAN SEMUA DATA BERITA
    public function index()
    {
        $berita = berita::latest('tanggal')->get();
        return view('admin.berita.index', compact('berita'));
    }

    // FORM TAMBAH BERITA
    public function create()
    {
        return view('admin.berita.create');
    }

    // SIMPAN DATA BERITA BARU
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            // Simpan ke storage/app/public/berita
            $namaFoto = $request->file('foto')->store('berita', 'public');
        }

        berita::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'tanggal' => now()->toDateString(),
            'foto'    => $namaFoto,
            'status'  => 'publish',
            'id_user' => Auth::id() ?? 1,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    // FORM EDIT BERITA
    public function edit($id)
    {
        $berita = berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    // UPDATE DATA BERITA
   public function update(Request $request, $id)
{
    $berita = berita::findOrFail($id);

    $request->validate([
        'judul'  => 'required|string|max:255',
        'isi'    => 'required',
        'status' => 'required|in:draft,publish', // <-- Tambahkan validasi status
        'foto'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $namaFoto = $berita->foto;

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }
        // Simpan foto baru
        $namaFoto = $request->file('foto')->store('berita', 'public');
    }

    $berita->update([
        'judul'  => $request->judul,
        'isi'    => $request->isi,
        'status' => $request->status, // <-- Tambahkan ini agar status ter-update
        'foto'   => $namaFoto,
    ]);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
}
    // HAPUS DATA BERITA
    public function destroy($id)
    {
        $berita = berita::findOrFail($id);

        // Hapus file foto dari storage
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

}