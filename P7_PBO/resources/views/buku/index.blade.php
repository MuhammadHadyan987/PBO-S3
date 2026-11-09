@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>{{ $judulHalaman }}</h2>
    <p class="muted">Berikut adalah koleksi buku yang tersedia di perpustakaan.</p>

    @if (count($daftarBuku) > 0)
        <div class="grid">
            @foreach ($daftarBuku as $buku)
                <article class="book">
                    <h3>{{ $buku['judul'] }}</h3>
                    <p class="muted">Penulis: {{ $buku['penulis'] }}</p>
                    <p class="muted">Kategori: {{ $buku['kategori'] }}</p>
                    <a class="button" href="{{ route('buku.show', $buku['id']) }}">Lihat Detail</a>
                </article>
            @endforeach
        </div>
    @else
        <p class="empty">Belum ada buku yang tersedia.</p>
    @endif
</div>
@endsection
