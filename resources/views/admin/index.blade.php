@extends('admin.layout')

@section('content')

<h4 class="mt-5">TOKO BUKU MAJU MUNDUR</h4>

<a href="{{ route('admin.create') }}" type="button" class="btn btn-success rounded-3">Tambah Data</a>
<a href="{{ route('genre.create') }}" type="button" class="btn btn-warning rounded-3">Tambah Genre</a>
<a href="{{ route('admin.hardDeleteAll') }}" type="button" class="btn btn-danger rounded-3">Hapus Permanen</a>

@if(session('success'))
<div class="alert alert-success mt-2 mb-2">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger mt-2 mb-2">
    {{ session('error') }}
</div>
@endif

<table class="table table-hover mt-2 mt-2 mb-2">
    <thead>
        <tr>
            <th>No.</th>
            <th>Judul Buku</th>
            <th>Harga Buku</th>
            <th>Penerbit</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        @if (!$data->is_deleted)
        <tr>
            <td>{{ $data->id_buku }}</td>
            <td>{{ $data->judul_buku }}</td>
            <td>{{ $data->harga_buku }}</td>
            <td>{{ $data->penerbit }}</td>
            <td>{{ $data->penulis }}</td>
            <td>{{ $data->tahun_terbit }}</td>
            <td>{{ $data->jenis_genre }}</td>
            <td>
                <a href="{{ route('admin.edit', $data->id_buku) }}" type="button" class="btn btn-warning rounded-3">Ubah</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_buku }}">Hapus</button>
                <div class="modal fade" id="hapusModal{{ $data->id_buku }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.softDelete', $data->id_buku) }}">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini secara lunak?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@stop