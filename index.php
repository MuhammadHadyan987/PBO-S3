<?php
interface BisaDipinjam
{
    public function getNamaItem(): string;
    public function isTersedia(): bool;
    public function pinjam(): void;
    public function kembalikan(): void;
}
 
class Buku implements BisaDipinjam
{
    private string $judul;
    private string $penulis;
    private bool $tersedia = true;
 
    public function __construct(string $judul, string $penulis)
    {
        if (trim($judul) == "") {
            throw new InvalidArgumentException("Judul tidak boleh kosong");
        }
 
        if (trim($penulis) == "") {
            throw new InvalidArgumentException("Penulis tidak boleh kosong");
        }
 
        $this->judul = $judul;
        $this->penulis = $penulis;
    }
 
    public function getJudul(): string
    {
        return $this->judul;
    }
 
    public function getNamaItem(): string
    {
        return $this->judul;
    }
 
    public function getPenulis(): string
    {
        return $this->penulis;
    }
 
    public function isTersedia(): bool
    {
        return $this->tersedia;
    }
 
    public function pinjam(): void
    {
        if (!$this->tersedia) {
            throw new RuntimeException("Buku sedang dipinjam");
        }
 
        $this->tersedia = false;
    }
 
    public function kembalikan(): void
    {
        if ($this->tersedia) {
            throw new RuntimeException("Buku belum dipinjam");
        }
 
        $this->tersedia = true;
    }
 
    public function caraAkses(): string
    {
        return "Akses umum di perpustakaan";
    }
 
    public function tampilkanInfo(): void
    {
        echo "Judul: " . $this->judul
            . " | Penulis: " . $this->penulis
            . " | Status: " . ($this->tersedia ? "Tersedia" : "Dipinjam") . "<br>";
    }
}
 
class BukuFisik extends Buku
{
    public function caraAkses(): string
    {
        return "Dibaca secara langsung dari buku fisik";
    }
}
 
class BukuDigital extends Buku
{
    public function caraAkses(): string
    {
        return "Diakses melalui perangkat digital";
    }
}
 
class BukuReferensi extends Buku
{
    public function caraAkses(): string
    {
        return "Dibaca di ruang referensi perpustakaan";
    }
}
 
class Majalah implements BisaDipinjam
{
    private string $judul;
    private bool $tersedia = true;
 
    public function __construct(string $judul)
    {
        if (trim($judul) == "") {
            throw new InvalidArgumentException("Judul majalah tidak boleh kosong");
        }
 
        $this->judul = $judul;
    }
 
    public function getNamaItem(): string
    {
        return $this->judul;
    }
 
    public function isTersedia(): bool
    {
        return $this->tersedia;
    }
 
    public function pinjam(): void
    {
        if (!$this->tersedia) {
            throw new RuntimeException("Majalah sedang dipinjam");
        }
 
        $this->tersedia = false;
    }
 
    public function kembalikan(): void
    {
        if ($this->tersedia) {
            throw new RuntimeException("Majalah belum dipinjam");
        }
 
        $this->tersedia = true;
    }
}
 
class KeranjangPinjaman
{
    private array $items = [];
 
    public function tambah(BisaDipinjam $item): void
    {
        $this->items[] = $item;
    }
 
    public function jumlahItem(): int
    {
        return count($this->items);
    }
 
    public function tampilkanItem(): void
    {
        foreach ($this->items as $index => $item) {
            $status = $item->isTersedia() ? "Tersedia" : "Dipinjam";
            echo ($index + 1) . ". " . $item->getNamaItem() . " | Status: " . $status . "<br>";
        }
    }
 
    public function pinjamSemua(): void
    {
        foreach ($this->items as $item) {
            try {
                $item->pinjam();
                echo $item->getNamaItem() . " berhasil dipinjam." . "<br>";
            } catch (RuntimeException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
            }
        }
    }
}
 
class Anggota
{
    private string $nama;
    private KeranjangPinjaman $keranjang;
 
    public function __construct(string $nama)
    {
        if (trim($nama) == "") {
            throw new InvalidArgumentException("Nama anggota tidak boleh kosong");
        }
 
        $this->nama = $nama;
        $this->keranjang = new KeranjangPinjaman();
    }
 
    public function getNama(): string
    {
        return $this->nama;
    }
 
    public function getKeranjang(): KeranjangPinjaman
    {
        return $this->keranjang;
    }
}
 
function tampilkanAkses(Buku $buku): void
{
    echo $buku->getJudul() . " | " . $buku->caraAkses() . "<br>";
}
 
// DEMO 1: Inheritance, overriding, dan polymorphism
echo "=== DEMO 1: POLYMORPHISM ===" . "<br>";
$daftarBuku = [
    new BukuFisik("Bintang Kecil", "Ryan"),
    new BukuDigital("PHP Dasar", "Budi"),
    new BukuReferensi("Algoritma dan Struktur Data", "Siti"),
];
foreach ($daftarBuku as $buku) {
    tampilkanAkses($buku);
}
 
// DEMO 2: Validasi dan encapsulation dari Pertemuan 4
echo "<br>" . "=== DEMO 2: VALIDASI BUKU ===" . "<br>";
$bukuUji = new BukuFisik("Pemrograman PHP", "Andi");
$bukuUji->tampilkanInfo();
$bukuUji->pinjam();
$bukuUji->tampilkanInfo();
try {
    $bukuUji->pinjam();
} catch (RuntimeException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
$bukuUji->kembalikan();
$bukuUji->tampilkanInfo();
try {
    $bukuUji->kembalikan();
} catch (RuntimeException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
try {
    $bukuKosong = new Buku("", "Andi");
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
try {
    $bukuPenulisKosong = new Buku("Pemrograman Java", "   ");
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
 
// DEMO 3: Interface dan composition melalui Anggota dan KeranjangPinjaman
echo "<br>" . "=== DEMO 3: INTERFACE & COMPOSITION ===" . "<br>";
$anggota = new Anggota("Muhammad Hadyan");
$keranjang = $anggota->getKeranjang();
$keranjang->tambah(new BukuFisik("Dasar Pemrograman", "Dewi"));
$keranjang->tambah(new BukuDigital("Belajar MySQL", "Fajar"));
$keranjang->tambah(new BukuReferensi("Kamus Informatika", "Rina"));
$keranjang->tambah(new Majalah("Teknologi Informatika"));
 
echo "Anggota: " . $anggota->getNama() . "<br>";
echo "Jumlah item dalam keranjang: " . $keranjang->jumlahItem() . "<br>";
$keranjang->tampilkanItem();
echo "Proses peminjaman:" . "<br>";
$keranjang->pinjamSemua();
echo "Status setelah dipinjam:" . "<br>";
$keranjang->tampilkanItem();
