@extends('layouts.app')

@section('title', 'Absen Guru')

@section('content')

@if (session('error'))
    <div style="color:red; font-weight:bold;">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div style="color:green; font-weight:bold;">
        {{ session('success') }}
    </div>
@endif

@php
$today = \Carbon\Carbon::now()->format('Y-m-d');
$already = \App\Models\Attendance::where('user_id', auth()->id())
             ->whereDate('tanggal', $today)
             ->exists();
@endphp

<form method="POST" action="{{ route('absen') }}" enctype="multipart/form-data">
    @csrf
    <select name="status" required {{ $already ? 'disabled' : '' }}>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
    </select>

    <input type="file" name="bukti" {{ $already ? 'disabled' : '' }}>

    <button type="submit" {{ $already ? 'disabled' : '' }}>
        {{ $already ? 'Sudah Absen' : 'Absen' }}
    </button>
</form>

<h2>Form Absensi</h2>

<form method="POST" action="/absen" enctype="multipart/form-data">
@csrf

<label>Status</label><br>
<select name="status" required>
    <option value="hadir">Hadir</option>
    <option value="izin">Izin</option>
    <option value="sakit">Sakit</option>
    <option value="alpha">Alpha</option>
</select><br><br>

<label>Keterangan</label><br>
<textarea name="keterangan"></textarea><br><br>

<input type="hidden" name="latitude" id="lat">
<input type="hidden" name="longitude" id="lng">

<label>Bukti (jika izin/sakit)</label><br>
<input type="file" name="bukti"><br><br>

<button type="submit">Absen</button>
</form>

<script>
navigator.geolocation.getCurrentPosition(function(pos){
    document.getElementById('lat').value = pos.coords.latitude;
    document.getElementById('lng').value = pos.coords.longitude;
});
</script>
@endsection
