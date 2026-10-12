<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profile_sekolah; 
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = profile_sekolah::first();
        return view('admin.profile.index', compact('profile'));
    }

    public function edit()
    {
        $profile = profile_sekolah::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = profile_sekolah::first();
        
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'kepala_sekolah' => 'required|string|max:255',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'npsn' => 'required|max:10',
            'alamat' => 'required|string',
            'kontak'=> 'required|string|max:50',
            'visi'  => 'required|string', 
            'misi' => 'required|string', 
            'tahun_berdiri' => 'nullable|string|max:10',
            'deskripsi'  => 'nullable|string',
        ]);

        $data = [
            'nama_sekolah' => $request->nama_sekolah,
            'kepala_sekolah' => $request->kepala_sekolah,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'npsn' => $request->npsn,
            'visi' => $request->visi,     // Simpan ke kolom visi
            'misi' => $request->misi,     // Simpan ke kolom misi
            'tahun_berdiri'=> $request->tahun_berdiri,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            if ($profile && $profile->foto) {
                Storage::delete('public/' . $profile->foto);
            }
            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($profile && $profile->logo) {
                Storage::delete('public/' . $profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('profile', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profile && $profile->foto_kepala_sekolah) {
                Storage::delete('public/' . $profile->foto_kepala_sekolah);
            }
            $data['foto_kepala_sekolah'] = $request->file('foto_kepala_sekolah')->store('profile', 'public');
        }

        if (!$profile) {
            profile_sekolah::create($data);
        } else {
            $profile->update($data);
        }

        return redirect()->route('profile.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}