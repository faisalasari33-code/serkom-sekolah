<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    //
    public function index() 
    {
        $siswas = Siswa::all();
        return view('admin.siswa.index', compact('siswas'));
    }

    public function store(Request $request) 
    {

        $request->validate([
            'nisn' => 'required|string|min:8',
            'nama_siswa' => 'required|string|max: 50',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,laki-laki,perempuan',
            'tanggal_masuk' => 'required|date',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);


        return redirect()->route('siswa.index')->with('success', 'berhasil menambahkan data');
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('admin.siswa.edit', compact('siswa'));
        
    }

    public function update(Request $request, $id) 
    {
        $siswa = siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|string|min:8',
            'nama_siswa' => 'required|string|max: 50',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,laki-laki,perempuan',
            'tanggal_masuk' => 'required|date',
        ]);

        $siswa->update([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('siswa.index')->with('success', 'data siswa berhasil di edit');
    }

    public function create() {
        return view('admin.siswa.create');
    }

    public function destroy($id) {
        $siswa = siswa::findOrFail($id);
        if($siswa){
            $siswa->delete();
        }


        return redirect()->route('siswa.index')->with('success', 'Data siswa berhail di hapus');
    }
}
