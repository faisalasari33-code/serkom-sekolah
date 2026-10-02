<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = galeri::all();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        $input['tanggal'] = date('Y-m-d');

        if ($request->hasFile('foto')) {
            $input['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        galeri::create($input);

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galeri = galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            if ($galeri->foto) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $input['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($input);

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil diubah!');
    }

    public function destroy($id)
    {
        $galeri = galeri::findOrFail($id);

        if ($galeri->foto) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil dihapus!');
    }
}