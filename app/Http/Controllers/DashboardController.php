<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler; 

class DashboardController extends Controller
{
    //
    public function index() 
    {
        $totalSiswa = Siswa::count();
        $totalPengelola = User::count();
        $totalEkskul = Ekstrakurikuler::count();

        return view('admin.dashboard.index', compact('totalSiswa', 'totalPengelola', 'totalEkskul'));
    }
}
