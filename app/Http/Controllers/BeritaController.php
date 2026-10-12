<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
  public function index()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $beritas = berita::where('judul', 'like', "%{$search}%")->get();
        } else {
            $beritas = berita::all();
        }

        return view('admin.berita.index', compact('beritas'));
    }
    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
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

    public function edit($id)
    {
        $berita = berita::findOrFail($id);

        if($berita->id_user !== Auth::id()){
            abort(403, 'Anda tidak memiliki hak untuk mengedit berita yang di buat');
        }
        return view('admin.berita.edit', compact('berita'));
    }

   public function update(Request $request, $id)
    {
        $berita = berita::findOrFail($id);

        if($berita->id_user !== Auth::id()){
            abort(403, 'Aksi dilarang! Anda bukan pembuat berita ini');
        }

        $request->validate([
            'judul'  => 'required|string|max:255',
            'isi'    => 'required',
            'status' => 'required|in:draft,publish', // <-- Tambahkan validasi status
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = $berita->foto;

        if ($request->hasFile('foto')) {
            if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
                Storage::disk('public')->delete($berita->foto);
            }
            $namaFoto = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul'  => $request->judul,
            'isi'    => $request->isi,
            'status' => $request->status,
            'foto'   => $namaFoto,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $berita = berita::findOrFail($id);

        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }

}