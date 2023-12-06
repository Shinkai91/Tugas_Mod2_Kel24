@extends('admin.layout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Ubah Data Buku</h5>
        <form method="post" action="{{ route('admin.update', $data->id_buku) }}">
            @csrf
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul_buku" name="judul_buku"
                    value="{{ $data->judul_buku }}">
            </div>
            <div class="mb-3">
                <label for="harga_buku" class="form-label">Harga Buku</label>
                <input type="text" class="form-control" id="harga_buku" name="harga_buku"
                    value="{{ $data->harga_buku }}">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $data->penerbit }}">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $data->penulis }}">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit"
                    value="{{ $data->tahun_terbit }}">
            </div>
            <div class="mb-3">
                <label for="id_genre" class="form-label">ID Genre</label>
                <input type="text" class="form-control" id="id_genre" name="id_genre" value="{{ $data->id_genre }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>
@stop