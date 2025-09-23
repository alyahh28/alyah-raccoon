<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data yang diperlukan
        $nama = 'Alyah Najwa Restu Islami'; // Ganti dengan nama yang sesuai
        $tanggalLahir = '2006-01-28'; // Ganti dengan tanggal lahir yang sesuai (YYYY-MM-DD)
        $tglHarusWisuda = '2028-08-30'; // Ganti dengan tanggal wisuda yang sesuai (YYYY-MM-DD)
        $currentSemester = 4; // Ganti dengan semester saat ini

        // Menghitung umur dari tanggal lahir
        $umur = Carbon::parse($tanggalLahir)->age;

        // Menghitung sisa hari sampai tanggal wisuda
        $sisaHariWisuda = Carbon::parse($tglHarusWisuda)->diffInDays(Carbon::now());

        // Menentukan pesan berdasarkan semester
        $pesanSemester = '';
        if ($currentSemester < 3) {
            $pesanSemester = 'Masih Awal, Kejar TAK';
        } elseif ($currentSemester > 3) {
            $pesanSemester = 'Jangan main-main, kurang-kurangi main game!';
        }

        // Data yang akan ditampilkan
        $dataPegawai = [
            'name' => $nama,
            'my_age' => $umur,
            'hobbies' => [
                'Membaca Buku',
                'Bermain Futsal',
                'Coding',
                'Menonton Film',
                'Fotografi'
            ],
            'tgl_harus_wisuda' => $tglHarusWisuda,
            'time_to_study_left' => $sisaHariWisuda,
            'current_semester' => $currentSemester,
            'pesan_semester' => $pesanSemester, // Key tambahan untuk pesan
            'future_goal' => 'Menjadi seorang full-stack developer' // Ganti dengan cita-cita yang sesuai
        ];

        // Mengembalikan data dalam format JSON
        return response()->json($dataPegawai);
    }
}
