@extends('layouts.app') <!-- Jika Anda menggunakan layout -->

@section('content')
<div class="container">
    <h1>Booking Store</h1>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf <!-- Token keamanan wajib di Laravel -->
        
        <!-- Input untuk Nama -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Input untuk Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <!-- Input untuk Tanggal Booking -->
        <div class="mb-3">
            <label for="date" class="form-label">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Simpan Booking</button>
    </form>
</div>
@endsection
