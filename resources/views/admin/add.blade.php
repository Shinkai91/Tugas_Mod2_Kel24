@extends('admin.layout')

@section('content')

<h4 class="mt-5">TOKO BUKU MAJU MUNDUR</h4>

<a href="{{ route('admin.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<a href="{{ route('genre.create') }}" type="button" class="btn btn-warning rounded-3">Tambah Genre</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if($formType === 'book')
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Tambah Data Buku</h5>
        <form method="post" action="{{ route('admin.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_buku" class="form-label">ID Buku</label>
                <input type="text" class="form-control" id="id_buku" name="id_buku">
                @error('id_buku')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku">
                @error('judul_buku')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_buku" class="form-label">Harga Buku</label>
                <input type="text" class="form-control" id="harga_buku" name="harga_buku">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
            </div>
            <div class="mb-3">
                <label for="id_genre" class="form-label">ID Genre</label>
                <input type="text" class="form-control" id="id_genre" name="id_genre">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Buku</button>
        </form>
    </div>
</div>
@elseif($formType === 'genre')
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Tambah Genre</h5>
        <form method="post" action="{{ route('genre.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_genre" class="form-label">ID Genre</label>
                <input type="text" class="form-control" id="id_genre" name="id_genre">
                @error('id_genre')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jenis_genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="jenis_genre" name="jenis_genre">
                @error('jenis_genre')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Tambah Genre</button>
        </form>
    </div>
</div>
@endif
@stop