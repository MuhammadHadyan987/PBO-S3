@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>{{ $buku['judul'] }}</h2>
    <p><strong>Penulis:</strong> {{ $buku['penulis'] }}</p>
    <p><strong>Kategori:</strong> {{ $buku['kategori'] }}</p>
    <p><strong>Tahun terbit:</strong> {{ $buku['tahun'] }}</p>
    <p><strong>Deskripsi:</strong> {{ $buku['deskripsi'] }}</p>
    <div class="actions">
        <a class="button secondary" href="{{ route('buku.index') }}">Kembali ke Daftar</a>
        <a class="button" href="{{ route('buku.rekomendasi', ['kategori' => $buku['kategori']]) }}">Lihat Kategori</a>
    </div>
</div>
@endsection
