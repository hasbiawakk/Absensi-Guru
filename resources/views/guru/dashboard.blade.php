@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<h1>Dashboard Guru</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>
@endsection

<a href="{{ route('guru.absensi') }}">
    Lihat Riwayat Absensi
</a>

<a href="{{ route('guru.riwayat') }}">
    Lihat Riwayat Absensi
</a>
