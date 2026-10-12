<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileSoloController extends Controller
{
    public function index()
    {
        // Data biodata kamu (bisa disesuaikan atau diambil dari database nanti)
        $profil = [
            'nama' => 'Faizal asari',
            'nisn' => '1234567890',
            'alamat' => 'Tasikmalaya, Jawa Barat',
            'email' => 'faizal@email.com',
            'telepon' => '081234567890',
            'foto' => 'assets/img/avatars/n.jpeg' // atau path foto kamu
        ];

        return view('admin/profile-solo.index', compact('profil'));
    }
}