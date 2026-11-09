@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>{{ $judulHalaman }}</h2>

    @if ($kategori)
        <p class="muted">Kategori yang dipilih: {{ $kategori }}</p>
    @else
        <p class="muted">Rekomendasi dari seluruh kategori buku.</p>
    @endif

    @if (count($daftarBuku) > 0)
        <div class="grid">
            @foreach ($daftarBuku as $buku)
                <article class="book">
                    <h3>{{ $buku['judul'] }}</h3>
                    <p class="muted">{{ $buku['penulis'] }} · {{ $buku['kategori'] }}</p>
                    <p>{{ $buku['deskripsi'] }}</p>
                    <a class="button" href="{{ route('buku.show', $buku['id']) }}">Baca Detail</a>
                </article>
            @endforeach
        </div>
    @else
        <p class="empty">Belum ada buku untuk kategori ini.</p>
    @endif

    <div class="actions">
        <a class="button secondary" href="{{ route('buku.index') }}">Kembali ke Daftar Buku</a>
    </div>
</div>
@endsection
