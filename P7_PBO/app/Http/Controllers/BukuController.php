<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    private function dataBuku(): array
    {
        return [
            [
                'id' => 1,
                'judul' => 'Belajar PHP untuk Pemula',
                'penulis' => 'Andi Pratama',
                'kategori' => 'Pemrograman',
                'tahun' => 2023,
                'deskripsi' => 'Buku pengantar untuk memahami dasar-dasar PHP, mulai dari variabel hingga pengolahan data.'
            ],
            [
                'id' => 2,
                'judul' => 'Dasar-Dasar Laravel',
                'penulis' => 'Budi Santoso',
                'kategori' => 'Pemrograman',
                'tahun' => 2024,
                'deskripsi' => 'Panduan dasar membangun aplikasi web menggunakan framework Laravel.'
            ],
            [
                'id' => 3,
                'judul' => 'Logika dan Algoritma',
                'penulis' => 'Citra Lestari',
                'kategori' => 'Komputer',
                'tahun' => 2022,
                'deskripsi' => 'Materi untuk melatih pola pikir logis dan menyusun algoritma pemecahan masalah.'
            ],
            [
                'id' => 4,
                'judul' => 'Pengantar Basis Data',
                'penulis' => 'Dedi Kurniawan',
                'kategori' => 'Komputer',
                'tahun' => 2023,
                'deskripsi' => 'Mengenal konsep basis data, tabel, relasi, dan pengelolaan informasi.'
            ],
            [
                'id' => 5,
                'judul' => 'Membangun Kebiasaan Membaca',
                'penulis' => 'Eka Wulandari',
                'kategori' => 'Umum',
                'tahun' => 2021,
                'deskripsi' => 'Buku berisi panduan sederhana untuk membangun kebiasaan membaca secara konsisten.'
            ],
        ];
    }

    public function index()
    {
        return view('buku.index', [
            'judulHalaman' => 'Daftar Buku',
            'daftarBuku' => $this->dataBuku(),
        ]);
    }

    public function show(string $id)
    {
        $buku = collect($this->dataBuku())->firstWhere('id', (int) $id);

        abort_unless($buku, 404);

        return view('buku.show', [
            'judulHalaman' => 'Detail Buku',
            'buku' => $buku,
        ]);
    }

    public function rekomendasi(?string $kategori = null)
    {
        $daftarBuku = $this->dataBuku();

        if ($kategori !== null) {
            $daftarBuku = array_values(array_filter(
                $daftarBuku,
                fn (array $buku) => strtolower($buku['kategori']) === strtolower($kategori)
            ));
        }

        return view('buku.rekomendasi', [
            'judulHalaman' => 'Rekomendasi Buku',
            'kategori' => $kategori,
            'daftarBuku' => $daftarBuku,
        ]);
    }
}
