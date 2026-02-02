@extends('layouts.app')

@section('title', 'Riwayat Absensi')

@section('content')
<h2>Riwayat Absensi Saya</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Jam Absen</th>
            <th>Status</th>
            <th>Bukti</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($riwayat as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $item->jam_absen }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>
                    @if ($item->bukti)
                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada data absensi</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
