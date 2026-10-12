<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\guru;
use App\Models\Mapel; // Jangan lupa use model Mapel

class GuruController extends Controller
{
    // Menampilkan form tambah guru
    public function create()
    {
        $mapel = Mapel::all(); // Ambil semua data mata pelajaran dari database
        return view('admin.guru.create', compact('mapel'));
    }

    public function index()
    {
       
        $gurus = guru::with('mapel')->get(); 
        return view('admin.guru.index', compact('gurus'));
    }

    // Menyimpan data guru baru
   public function store(Request $request)
{
    $request->validate([
        'nama_guru' => 'required|string|max:255',
        'nip'       => 'required|numeric',
        'mapel_id'  => 'required|exists:mapels,id', // Pastikan wajib diisi
        'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $input = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('guru'), $filename);
        $input['foto'] = $filename;
    }

    Guru::create($input); // Sekarang mapel_id akan terikut otomatis

    return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
}

    // Menampilkan form edit guru
    public function edit($id)
    {
        $guru = guru::findOrFail($id);
        $mapel = Mapel::all(); // Ambil data mapel untuk dropdown

        return view('admin.guru.edit', compact('guru', 'mapel'));
    }

    // Update data guru
   public function update(Request $request, $id)
    {
        $guru = guru::findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip'       => 'required|numeric',
            'mapel_id'  => 'required',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->except('mapel_id');
        $input['mata_pelajaran'] = $request->mapel_id; // Mapping mapel_id ke mata_pelajaran

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto && file_exists(public_path('guru/' . $guru->foto))) {
                unlink(public_path('guru/' . $guru->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('guru'), $filename);
            $input['foto'] = $filename;
        }

        $guru->update($input);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }
}