<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judulHalaman ?? 'Perpustakaan PBO' }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; color: #263238; }
        header { background: #263b50; color: white; padding: 22px 8%; }
        header h1 { margin: 0 0 12px; font-size: 24px; }
        nav a { color: white; text-decoration: none; margin-right: 18px; }
        main { width: min(1000px, 90%); margin: 32px auto; }
        .panel { background: white; border-radius: 10px; padding: 24px; box-shadow: 0 3px 12px rgba(0,0,0,.06); }
        h2 { margin-top: 0; color: #263b50; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 16px; }
        .book { border: 1px solid #e1e6eb; border-radius: 8px; padding: 18px; }
        .book h3 { margin: 0 0 10px; }
        .muted { color: #64748b; font-size: 14px; }
        .button { display: inline-block; padding: 9px 14px; background: #d69e36; color: #17212b; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .button.secondary { background: #e8edf2; color: #263b50; }
        .actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 18px; }
        .empty { padding: 18px; background: #fff7e6; border-radius: 8px; }
        footer { text-align: center; color: #64748b; padding: 24px; }
    </style>
</head>
<body>
    <header>
        <h1>Perpustakaan PBO</h1>
        <nav>
            <a href="{{ route('buku.index') }}">Daftar Buku</a>
            <a href="{{ route('buku.rekomendasi') }}">Rekomendasi</a>
            <a href="{{ route('buku.rekomendasi', ['kategori' => 'Pemrograman']) }}">Pemrograman</a>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>Praktikum Pemrograman Berorientasi Objek · Laravel 13</footer>
</body>
</html>
