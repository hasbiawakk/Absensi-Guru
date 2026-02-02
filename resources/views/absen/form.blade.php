@extends('layouts.app')

@section('content')
<h2>Form Absensi Guru</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/absen" enctype="multipart/form-data">
    @csrf

    <label>Status Kehadiran</label><br>
    <select name="status" required>
        <option value="">-- Pilih --</option>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="sakit">Sakit</option>
    </select>

    <br><br>

    <label>Bukti (wajib jika izin/sakit)</label><br>
    <input type="file" name="bukti">

    <br><br>

    <button type="submit">Kirim Absensi</button>
</form>
@endsection
