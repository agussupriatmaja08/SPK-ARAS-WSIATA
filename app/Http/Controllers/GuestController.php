<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;

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
            3 => 'Infrastruktur',
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
            return redirect()->back()->with('error', 'Pilih minimal tiga kriteria.');

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
        $weights = $request->input('weights', []);

        // Mapping nama kriteria ke array kriteria yang dipilih
        $criteriaMapping = [
            'Kondisi Alam',
            'Budaya',
            'Infrastruktur',
            'Aksesibilitas',
            'Jarak Terdekat',
            'Keamanan',
            'Biaya',
            'Waktu Operasional',
        ];

        // Validasi agar tidak ada bobot 0
        foreach ($weights as $weight) {
            if ($weight <= 0) {
                return redirect()->back()->with('error', 'Tidak boleh ada bobot 0 atau negatif');
            }
        }

        // Hitung total bobot
        $totalWeight = array_sum($weights);

        // Normalisasi bobot sehingga totalnya menjadi 1
        $normalizedWeights = [];
        foreach ($weights as $criteriaName => $weight) {
            if (in_array($criteriaName, $criteriaMapping)) {
                $normalizedWeights[] = [
                    'criteria' => strtolower(str_replace(' ', '_', $criteriaName)),
                    'weight' => $weight / $totalWeight // Normalisasi bobot
                ];
            }
        }
        // dd($normalizedWeights);
        // Mengambil nama kriteria
        $criteriaNames = array_column($normalizedWeights, 'criteria');

        // Query data dari tabel Wisata
        $data = Wisata::select(array_merge(['name'], $criteriaNames))->get();

        // Daftar kriteria dengan tipe cost (nilai optimal adalah minimum)
        $costCriteria = ['biaya', 'jarak_terdekat'];

        // Menghitung nilai optimal (A0) untuk setiap field
        $A0 = [];
        foreach ($criteriaNames as $criteria) {
            if (in_array($criteria, $costCriteria)) {
                $A0[$criteria] = $data->min($criteria);
            } else {
                $A0[$criteria] = $data->max($criteria);
            }
        }

        // Normalisasi nilai berdasarkan formula
        $normalizedData = [];
        foreach ($data as $row) {
            $normalizedRow = [];
            foreach ($criteriaNames as $criteria) {
                if (in_array($criteria, $costCriteria)) {
                    // Jika cost: xij = 1 / xij, lalu normalisasi
                    $inverse = 1 / $row[$criteria];
                    $normalizedRow[$criteria] = $inverse / $data->sum(fn($item) => 1 / $item[$criteria]);
                } else {
                    // Jika benefit: langsung normalisasi
                    $normalizedRow[$criteria] = $row[$criteria] / $data->sum($criteria);
                }
            }
            $normalizedData[] = $normalizedRow;
        }

        // Menentukan bobot matriks normalisasi
        $weightedData = [];
        foreach ($normalizedData as $row) {
            $weightedRow = [];
            foreach ($criteriaNames as $criteria) {
                $weight = collect($normalizedWeights)->firstWhere('criteria', $criteria)['weight'];
                $weightedRow[$criteria] = $row[$criteria] * $weight;
            }
            $weightedData[] = $weightedRow;
        }

        // Menentukan nilai utilitas (Si)
        $utilityValues = [];
        foreach ($weightedData as $row) {
            $utilityValues[] = array_sum($row);
        }

        // Menentukan nilai optimum (So)
        $So = array_sum(array_map(fn($row) => array_sum($row), $weightedData));

        // Menentukan derajat utilitas (Ki)
        $utilityDegrees = [];
        foreach ($utilityValues as $Si) {
            $utilityDegrees[] = $Si / $So;
        }

        // Gabungkan data dengan derajat utilitas untuk peringkat
        $result = [];
        foreach ($data as $index => $row) {
            $result[] = [
                'name' => $row->name, // Nama wisata dari database
                'Si' => $utilityValues[$index],
                'Ki' => $utilityDegrees[$index]
            ];
        }

        // Urutkan berdasarkan nilai Ki tertinggi
        usort($result, fn($a, $b) => $b['Ki'] <=> $a['Ki']);
        dd($result);

        // Tampilkan hasil pada halaman
        return view('page.guest.recommendation-page', compact('normalizedWeights', 'result', 'A0'));
    }





    // public function rekomendasi(Request $request)
    // {
    //     // Ambil bobot yang dipilih oleh pengguna
    //     $weights = $request->input('weights', []);

    //     // Mapping nama kriteria ke array kriteria yang dipilih
    //     $criteriaMapping = [
    //         'Kondisi Alam',
    //         'Budaya',
    //         'Infrastruktur',
    //         'Aksesibilitas',
    //         'Jarak Terdekat',
    //         'Keamanan',
    //         'Biaya',
    //         'Waktu Operasional',
    //     ];

    //     // Gabungkan nama kriteria dengan bobot yang dipilih
    //     $criteriaWithWeights = [];

    //     foreach ($weights as $criteriaName => $weight) {
    //         if ($weight == 0) {
    //             return redirect()->back()->with('error', 'Tidak boleh ada bobot 0');

    //         }
    //         if (in_array($criteriaName, $criteriaMapping)) {
    //             $criteriaWithWeights[] = [
    //                 'criteria' => strtolower(str_replace(' ', '_', $criteriaName)),
    //                 'weight' => $weight
    //             ];
    //         }
    //     }

    //     // Mengambil nama kriteria
    //     $criteriaNames = array_column($criteriaWithWeights, 'criteria');

    //     // Query data dari tabel Wisata
    //     $data = Wisata::select(array_merge(['name'], $criteriaNames))->get();

    //     // Daftar kriteria dengan tipe cost (nilai optimal adalah minimum)
    //     $costCriteria = ['biaya', 'jarak_terdekat'];

    //     // Menghitung nilai optimal (A0) untuk setiap field
    //     $A0 = [];
    //     foreach ($criteriaNames as $criteria) {
    //         if (in_array($criteria, $costCriteria)) {
    //             $A0[$criteria] = $data->min($criteria);
    //         } else {
    //             $A0[$criteria] = $data->max($criteria);
    //         }
    //     }

    //     // Normalisasi nilai berdasarkan formula
    //     $normalizedData = [];
    //     foreach ($data as $row) {
    //         $normalizedRow = [];
    //         foreach ($criteriaNames as $criteria) {
    //             if (in_array($criteria, $costCriteria)) {
    //                 // Jika cost: xij = 1 / xij, lalu normalisasi
    //                 $inverse = 1 / $row[$criteria];
    //                 $normalizedRow[$criteria] = $inverse / $data->sum(fn($item) => 1 / $item[$criteria]);
    //             } else {
    //                 // Jika benefit: langsung normalisasi
    //                 $normalizedRow[$criteria] = $row[$criteria] / $data->sum($criteria);
    //             }
    //         }
    //         $normalizedData[] = $normalizedRow;
    //     }

    //     // Menentukan bobot matriks normalisasi
    //     $weightedData = [];
    //     foreach ($normalizedData as $row) {
    //         $weightedRow = [];
    //         foreach ($criteriaNames as $criteria) {
    //             $weight = collect($criteriaWithWeights)->firstWhere('criteria', $criteria)['weight'];
    //             $weightedRow[$criteria] = $row[$criteria] * $weight;
    //         }
    //         $weightedData[] = $weightedRow;
    //     }

    //     // Menentukan nilai utilitas (Si)
    //     $utilityValues = [];
    //     foreach ($weightedData as $row) {
    //         $utilityValues[] = array_sum($row);
    //     }

    //     // Menentukan nilai optimum (So)
    //     $So = array_sum(array_map(fn($row) => array_sum($row), $weightedData));

    //     // Menentukan derajat utilitas (Ki)
    //     $utilityDegrees = [];
    //     foreach ($utilityValues as $Si) {
    //         $utilityDegrees[] = $Si / $So;
    //     }

    //     // Gabungkan data dengan derajat utilitas untuk peringkat
    //     $result = [];
    //     foreach ($data as $index => $row) {
    //         $result[] = [
    //             'name' => $row->name, // Nama wisata dari database
    //             'Si' => $utilityValues[$index],
    //             'Ki' => $utilityDegrees[$index]
    //         ];
    //     }

    //     // Urutkan berdasarkan nilai Ki tertinggi
    //     usort($result, fn($a, $b) => $b['Ki'] <=> $a['Ki']);

    //     // Debugging atau tampilkan hasil Si, Ki, dan nama wisata
    //     dd($result);

    //     // Tampilkan hasil pada halaman
    //     return view('page.guest.recommendation-page', compact('criteriaWithWeights', 'result', 'A0'));
    // }






}
