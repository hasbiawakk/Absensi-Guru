@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang, {{ auth()->user()->name }}</p>
<!-- <a href="{{ route('admin.qr') }}">Generate QR</a> -->
@endsection
