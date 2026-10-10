<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{

    public function index() 
    {
        $gurus = Guru::all();
        return view('admin.guru.index', compact('gurus'));
    }


    public function create() 
    {
        return view('admin.guru.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nip' => 'required|string|unique:gurus,nip',
            'nama_guru' => 'required|string|max:50',
            'mata_pelajaran' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

      
        if ($request->hasFile('foto')) {
            $input['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($input);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

  
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

   
    public function update(Request $request, $id) 
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip' => 'required|string|unique:gurus,nip,' . $id,
            'nama_guru' => 'required|string|max:50',
            'mata_pelajaran' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::delete('public/' . $guru->foto);
            }
            $input['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($input);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diubah');
    }

    public function destroy($id) 
    {
        $guru = Guru::findOrFail($id);
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus');
    }

}