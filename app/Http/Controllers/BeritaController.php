<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; 

class BeritaController extends Controller
{

    public function index() 
    {
        $beritas = Berita::latest('id_berita')->get();
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
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        
        $input['tanggal'] = date('Y-m-d');
        $input['id_user'] = Auth::id();

        if ($request->hasFile('foto')) {
            $input['foto'] = $request->file('foto')->store('berita', 'public');
        }

        Berita::create($input);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }


    public function edit($id)
    {
        $berita = Berita::where('id_berita', $id)->firstOrFail();
        return view('admin.berita.edit', compact('berita'));
    }


    public function update(Request $request, $id) 
    {
        $berita = Berita::where('id_berita', $id)->firstOrFail();

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        if ($request->hasFile('foto')) {
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            $input['foto'] = $request->file('foto')->store('berita', 'public');
        }

        $berita->update($input);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diubah');
    }

    public function destroy($id) 
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
}
}