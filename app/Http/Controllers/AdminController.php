<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.add', ['formType' => 'book']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|unique:buku,id_buku',
            'judul_buku' => 'required|unique:buku,judul_buku',
            'harga_buku' => 'required',
            'penerbit' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'id_genre' => 'required',
        ]);
        $existingBukuQuery = "SELECT * FROM buku WHERE id_buku = ? OR judul_buku = ?";
        $existingBuku = DB::select($existingBukuQuery, [$request->id_buku, $request->judul_buku]);
        if ($existingBuku) {
            return redirect()->
                route('admin.create')->with('error', 'ID Buku atau Judul Buku sudah ada, harap gunakan yang berbeda.');
        }

        $query = "INSERT INTO buku (
            id_buku, judul_buku, harga_buku, penerbit, penulis, tahun_terbit, id_genre
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?
            )";
        DB::insert($query, [
            $request->id_buku,
            $request->judul_buku,
            $request->harga_buku,
            $request->penerbit,
            $request->penulis,
            $request->tahun_terbit,
            $request->id_genre
        ]);

        return redirect()->route('admin.index')->with('success', 'Data buku berhasil disimpan');
    }

    public function createGenre()
    {
        return view('admin.add', ['formType' => 'genre']);
    }

    public function indexGenre()
    {
        // Fetch data for genres
        $genres = DB::select('SELECT * FROM genre');
        return view('admin.index', compact('genres'));
    }

    public function storeGenre(Request $request)
    {
        $request->validate([
            'id_genre' => 'required|unique:genre,id_genre',
            'jenis_genre' => 'required|unique:genre,jenis_genre',
        ]);
        $existingGenreQuery = "SELECT * FROM genre WHERE id_genre = ? OR jenis_genre = ?";
        $existingGenre = DB::select($existingGenreQuery, [$request->id_genre, $request->jenis_genre]);
        if ($existingGenre) {
            return redirect()->
                route('admin.create')->with('error', 'ID Genre atau Jenis Genre sudah ada, harap gunakan yang berbeda.');
        }
        $insertGenreQuery = "INSERT INTO genre (id_genre, jenis_genre) VALUES (?, ?)";
        DB::insert($insertGenreQuery, [$request->id_genre, $request->jenis_genre]);
        return redirect()->route('admin.index')->with('success', 'Genre berhasil disimpan');
    }

    public function index()
    {
        $datas = DB::select('SELECT buku.*, genre.jenis_genre FROM buku LEFT JOIN genre ON buku.id_genre = genre.id_genre');
        $genres = DB::select('SELECT * FROM genre');
        return view('admin.index', compact('datas', 'genres'));
    }

    public function edit($id)
    {
        $selectBukuQuery = "SELECT * FROM buku WHERE id_buku = ?";
        $data = DB::select($selectBukuQuery, [$id]);
        return view('admin.edit')->with('data', $data[0]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
            'harga_buku' => 'required',
            'penerbit' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'id_genre' => 'required',
        ]);
        $updateBukuQuery = "UPDATE buku SET judul_buku = ?, harga_buku = ?, penerbit = ?, penulis = ?, tahun_terbit = ?, id_genre = ? WHERE id_buku = ?";
        DB::update($updateBukuQuery, [
            $request->judul_buku,
            $request->harga_buku,
            $request->penerbit,
            $request->penulis,
            $request->tahun_terbit,
            $request->id_genre,
            $id
        ]);
        return redirect()->route('admin.index')->with('success', 'Data buku berhasil diubah');
    }

    public function softDelete($id)
    {
        $query = "UPDATE buku SET is_deleted = 1 WHERE id_buku = :id";
        DB::update($query, ['id' => $id]);
        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil dihapus (soft delete)');
    }

    public function hardDeleteAll()
    {
        $query = "DELETE FROM buku WHERE is_deleted = 1";
        DB::delete($query);
        return redirect()->route('admin.index')->with('success', 'Data yang di-soft delete telah dihapus permanen.');
    }
}