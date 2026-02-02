@extends('layouts.app')

@section('title', 'QR Absensi')

@section('content')
<h2>QR Absensi Hari Ini</h2>

<p>Tanggal: {{ $qr->tanggal }}</p>

{!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate(route('absen')) !!}

@endsection
