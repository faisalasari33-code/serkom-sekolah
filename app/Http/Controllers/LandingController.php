<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\berita;
use App\Models\ekstrakurikuler;
use App\Models\galeri;
use App\Models\guru;
use App\Models\profile_sekolah;
use App\Models\siswa; 

class LandingController extends Controller
{
    private function getProfile()
    {
        return profile_sekolah::first() ?? (object) [
            'nama_sekolah'         => 'SDN 6 Mangunreja',
            'slogan'               => 'Mewujudkan Generasi Cerdas dan Berakhlak Mulia',
            'kepala_sekolah'       => 'Nama Kepala Sekolah, S.Pd.',
            'nip_kepala_sekolah'  => '19700101 199001 1 001',
            'foto_kepala_sekolah' => null,
            'sambutan'            => 'Selamat datang di website resmi SDN 6 Mangunreja. Kami berkomitmen untuk memberikan pendidikan terbaik bagi putra-putri bangsa.',
            'visi'                => 'Terwujudnya peserta didik yang bertaqwa, cerdas, dan terampil.',
            'misi'                => 'Menyelenggarakan pendidikan berkualitas berbasis karakter.',
            'alamat'              => 'Jl. Raya Mangunreja No. 6, Tasikmalaya',
            'email'               => 'sdn6mangunreja@gmail.com',
            'telepon'             => '(0265) 123456',
            'logo'                => null,
        ];
    }

    public function index()
    {
        $profil = $this->getProfile();
        $berita = berita::latest('tanggal')->take(3)->get();
        $ekstrakurikuler = ekstrakurikuler::all();
        $galeri  = galeri::where('status', 'publish')->latest()->take(3)->get();
        $guru  = guru::all();
        $siswa = siswa::latest()->take(3)->get();

        $totalSiswa = class_exists(siswa::class) ? siswa::count() : 0;
        $totalGuru  = guru::count();
        $totalEskul = ekstrakurikuler::count();

        return view('landing.index', compact(
            'profil', 
            'berita', 
            'ekstrakurikuler', 
            'galeri', 
            'guru',
            'siswa',
            'totalSiswa',
            'totalGuru',
            'totalEskul'
        ));
        }

    public function beritaIndex(Request $request)
    {
        $query = berita::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%");
        }

        $berita = $query
            ->latest('tanggal')
            ->paginate(9)
            ->withQueryString();

        $profil  = $this->getProfile();
        $galeris = galeri::where('status', 'publish')->latest()->take(5)->get();

        return view('landing.berita', compact('berita', 'profil', 'galeris'));
    }

  public function siswaIndex()
    {
        $profil = $this->getProfile(); // Tambahkan ini agar tidak error di template
        $siswa = siswa::all();

        return view('landing.siswa', compact('siswa', 'profil'));
    }

    public function galeriIndex(Request $request)
    {
        $query = galeri::where('status', 'publish');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $galeri = $query->latest()->get();
        $profil = $this->getProfile(); 

        return view('landing.galeri', compact('galeri', 'profil'));
    }

    public function galeriDetail($id = null)
    {
        if (!$id) {
            return $this->galeriIndex(request());
        }

        $profil = $this->getProfile();
        $galeri = galeri::where('status', 'publish')->findOrFail($id);

        $galeriLain = galeri::where('status', 'publish')
            ->where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();

        return view('landing-detail.detail-galeri', compact('galeri', 'galeriLain', 'profil'));
    }

    public function eskulIndex()
    {
        $profil          = $this->getProfile();
        $ekstrakurikuler = ekstrakurikuler::all();

        return view('landing.eskul', compact('ekstrakurikuler', 'profil'));
    }

    public function guruIndex()
    {
        $profil = $this->getProfile();
        $guru   = guru::all();

        return view('landing.guru', compact('guru', 'profil'));
    }

    public function profilIndex()
    {
        $profil = $this->getProfile();

        return view('landing.profil', compact('profil'));
    }

    public function beritaDetail($id)
    {
        $profil = $this->getProfile();
        $berita = berita::where('id_berita', $id)->firstOrFail();
        $galeris = galeri::where('status', 'publish')->latest()->take(5)->get();
        
        return view('landing-detail.detail-berita', compact('berita', 'galeris', 'profil'));
    }

    public function guruDetail($id)
    {
        $profil = $this->getProfile();
        $guru   = guru::findOrFail($id);
        
        return view('landing-detail.detail-guru', compact('guru', 'profil'));
    }

    public function eskulDetail($id)
    {
        $profil = $this->getProfile();
        $ekstrakurikuler = ekstrakurikuler::findOrFail($id);
        
        return view('landing-detail.detail-eskul', compact('ekstrakurikuler', 'profil'));
    }
}