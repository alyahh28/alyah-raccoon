<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiController extends CI_Controller
{
    public function index()
    {
        // Data dasar
        $name = "Alyah Najwa Restu Islami";
        $birthdate = new DateTime("2003-05-14"); // contoh tanggal lahir
        $today = new DateTime();
        $my_age = $today->diff($birthdate)->y;

        // Hobi (array minimal 5 item)
        $hobbies = [
            "Membaca",
            "Menulis",
            "Ngoding",
            "Traveling",
            "Main musik"
        ];

        // Tanggal harus wisuda
        $tgl_harus_wisuda = new DateTime("2027-07-30");

        // Hitung jarak hari ke wisuda
        $interval = $today->diff($tgl_harus_wisuda);
        $time_to_study_left = $interval->days;

        // Semester saat ini
        $current_semester = 2; // contoh bisa diubah sesuai kebutuhan

        // Pesan tambahan berdasarkan semester
        if ($current_semester < 3) {
            $semester_message = "Masih Awal, Kejar TAK";
        } else {
            $semester_message = "Jangan main-main, kurang-kurangi main game!";
        }

        // Cita-cita
        $future_goal = "Menjadi Software Engineer profesional";

        // Kirim data ke view
        $data = [
            'name' => $name,
            'my_age' => $my_age,
            'hobbies' => $hobbies,
            'tgl_harus_wisuda' => $tgl_harus_wisuda->format('Y-m-d'),
            'time_to_study_left' => $time_to_study_left,
            'current_semester' => $current_semester,
            'semester_message' => $semester_message,
            'future_goal' => $future_goal
        ];

        // tampilkan data (bisa ke view atau json)
        $this->load->view('pegawai_view', $data);
        // atau kalau ingin JSON:
        // echo json_encode($data);
    }
}
