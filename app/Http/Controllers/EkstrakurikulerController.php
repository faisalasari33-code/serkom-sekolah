<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Storage;

class EkstrakurikulerController extends Controller
{

    public function index()
    {
        $ekstrakulikulers = ekstrakurikuler::all();
        return view('admin.ekstrakurikuler.index', compact('ekstrakulikulers'));
    }

  
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'nama_ekstrakulikuler' => 'required|string|max:255',
            'pembina'              => 'required|string|max:255',
            'jadwal_latihan'       => 'required|string|max:255',
            'deskripsi'            => 'nullable|string',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
            'pembina'              => $request->pembina,
            'jadwal_latihan'       => $request->jadwal_latihan,
            'deskripsi'            => $request->deskripsi,
        ];

     
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler', 'public');
        }

        Ekstrakurikuler::create($data);

        return redirect()->route('ekstrakulikuler.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        return view('admin.ekstrakurikuler.edit', compact('ekskul'));
    }
    public function update(Request $request, $id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);

        $request->validate([
            'nama_ekstrakulikuler' => 'required|string|max:255',
            'pembina'              => 'required|string|max:255',
            'jadwal_latihan'       => 'required|string|max:255',
            'deskripsi'            => 'nullable|string',
            'foto'                 => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_ekstrakulikuler' => $request->nama_ekstrakulikuler,
            'pembina'              => $request->pembina,
            'jadwal_latihan'       => $request->jadwal_latihan,
            'deskripsi'            => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            if ($ekskul->foto && Storage::exists('public/' . $ekskul->foto)) {
                Storage::delete('public/' . $ekskul->foto);
            }
            $data['foto'] = $request->file('foto')->store('ekstrakurikuler', 'public');
        }

        $ekskul->update($data);

        return redirect()->route('ekstrakulikuler.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ekskul = Ekstrakurikuler::findOrFail($id);
        if ($ekskul->foto && Storage::exists('public/' . $ekskul->foto)) {
            Storage::delete('public/' . $ekskul->foto);
        }

        $ekskul->delete();

        return redirect()->route('ekstrakulikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus!');
    }

}