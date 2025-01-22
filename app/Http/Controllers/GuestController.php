<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    //

    public function index()
    {
        return view('page.guest.index');
    }


    public function selectCriteria()
    {
        return view('page.guest.select-criteria-page');

    }

    public function weightCriteria(Request $request)
    {
        // Daftar mapping ID ke nama kriteria
        $criteriaMapping = [
            1 => 'Kondisi Alam',
            2 => 'Budaya',
            3 => 'Fasilitas',
            4 => 'Aksesibilitas',
            5 => 'Jarak Terdekat',
            6 => 'Keamanan',
            7 => 'Biaya',
            8 => 'Waktu Operasional',
        ];

        // Ambil parameter kriteria dari query string
        $selectedCriteriaIds = $request->query('criteria', []);

        // Cek apakah ada kriteria yang dipilih
        if (count($selectedCriteriaIds) < 3) {
            return redirect()->back()->with('error', 'Pilih minimal satu kriteria.');
        }

        // Ambil nama kriteria berdasarkan ID yang dipilih
        $selectedCriteria = [];
        foreach ($selectedCriteriaIds as $id) {
            if (isset($criteriaMapping[$id])) {
                $selectedCriteria[] = $criteriaMapping[$id];
            }
        }

        // Oper ke view untuk ditampilkan
        return view('page.guest.weight-criteria-page', compact('selectedCriteria'));
    }


    public function rekomendasi(Request $request)
    {
        // Ambil bobot yang dipilih oleh pengguna
        $weights = $request->input('weights', []); // 'weights' adalah array yang berisi nilai-nilai bobot
        dd($weights);

        // Ambil nama kriteria yang dipilih
        $selectedCriteria = ['Kriteria 1', 'Kriteria 2', 'Kriteria 3']; // Misalnya, ganti dengan data asli Anda

        // // Gabungkan ID kriteria dengan bobot yang dipilih
        // $criteriaWithWeights = [];
        // foreach ($weights as $key => $weight) {
        //     // Cari nama kriteria berdasarkan ID yang diterima
        //     $criteriaWithWeights[] = [
        //         'criteria_id' => $key, // ID kriteria
        //         'criteria' => $selectedCriteria[$key] ?? 'Kriteria Tidak Ditemukan', // Nama kriteria
        //         'weight' => $weight // Nilai bobot
        //     ];
        // }

        // Tampilkan atau proses hasilnya lebih lanjut
        return view('page.guest.recommendation-page', compact('criteriaWithWeights'));
    }


}
