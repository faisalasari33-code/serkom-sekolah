<?php

namespace App\Http\Controllers;

use App\Models\galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = galeri::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $galeri = $query->latest()->get();

        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|in:foto,video',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:publish,draft',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'video'      => 'nullable|file|mimes:mp4,mov,ogg|max:51200',
        ]);

        $pathFoto  = null;
        $pathVideo = null;

        if ($request->kategori === 'video' && $request->hasFile('video')) {
            $pathVideo = $request->file('video')->store('galeri/video', 'public');
        } elseif ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('galeri/foto', 'public');
        }

        galeri::create([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
            'status'     => $request->status,
            'keterangan' => $request->keterangan,
            'foto'       => $pathFoto,
            'video'      => $pathVideo,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galeri = galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        
        
        // dd($request->all(), $request->file('foto'));
        $galeri = galeri::findOrFail($id);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|in:foto,video',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:publish,draft',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'video'      => 'nullable|file|mimes:mp4,mov,ogg|max:51200',
        ]);

        $pathFoto  = $galeri->foto;
        $pathVideo = $galeri->video;

        // Cek jika ada file foto baru yang diunggah
        if ($request->hasFile('foto')) {
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $pathFoto = $request->file('foto')->store('galeri/foto', 'public');
        }

        // video
        if ($request->hasFile('video')) {
            if ($galeri->video && Storage::disk('public')->exists($galeri->video)) {
                Storage::disk('public')->delete($galeri->video);
            }
            $pathVideo = $request->file('video')->store('galeri/video', 'public');
        }

        $galeri->update([
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
            'status'     => $request->status,
            'keterangan' => $request->keterangan,
            'foto'       => $pathFoto,
            'video'      => $pathVideo,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = galeri::findOrFail($id);

        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        if ($galeri->video && Storage::disk('public')->exists($galeri->video)) {
            Storage::disk('public')->delete($galeri->video);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}