<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index()
    {


        return view('admin.tabel')
            ->with('judul', 'Daftar Mahasiswa');
    }

    public function create()
    {
        return view('admin.input')
            ->with('judul', 'Tambah Mahasiswa');
    }

    public function store(Request $r)
    {
        $r->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Batasan untuk jenis dan ukuran file
        ]);

        $nama_file = [];
        foreach ($r->file('foto') as $image) {
            $nama_file[] = time() . '_' . $image->getClientOriginalName(); // Menambahkan nama file ke dalam array $nama_file
            $image->move(public_path('path/produk'), end($nama_file)); // Menggunakan end() untuk mendapatkan elemen terakhir dari array
        }
        $x = array(
            'id' => $r->id,
            'kode' => $r->kode,
            'nama' => $r->nama,
            'id_satuan' => $r->idsatuan,
            'id_kategori' => $r->idkategori,
            'saldoawal' => $r->saldoawal,
            'hargajual' => $r->hargajual,
            'tglexp' => $r->tglexp,
            'hargamodal' => $r->hargamodal,
            'foto' => implode(',', $nama_file),
            'deskripsi' => $r->desc,
            'pajang' => $r->pajang,
            'saldoakhir' => $r->saldoakhir,

        );

        DB::table('stoks')->insertgetId($x);
        return redirect('/admin')->with('judul', 'Daftar Mahasiswa');
    }
    public function show($id)
    {
        return view('admin.edit')
            ->with('judul', 'Form Edit Mahasiswa')
            ->with('id', $id);
    }

    public function update(Request $r)
    {
        $r->validate([
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Batasan untuk jenis dan ukuran file
        ]);

        $nama_file = [];
        foreach ($r->file('foto') as $image) {
            $nama_file[] = time() . '_' . $image->getClientOriginalName(); // Menambahkan nama file ke dalam array $nama_file
            $image->move(public_path('path/produk'), end($nama_file)); // Menggunakan end() untuk mendapatkan elemen terakhir dari array
        }

        $x = array(
            'id' => $r->id,
            'kode' => $r->kode,
            'nama' => $r->nama,
            'id_satuan' => $r->idsatuan,
            'id_kategori' => $r->idkategori,
            'saldoawal' => $r->saldoawal,
            'hargajual' => $r->hargajual,
            'tglexp' => $r->tglexp,
            'hargamodal' => $r->hargamodal,
            'foto' => implode(',', $nama_file),
            'deskripsi' => $r->desc,
            'pajang' => $r->pajang,
            'saldoakhir' => $r->saldoakhir,

        );

        DB::table('stoks')
            ->where('id', $r->id)
            ->update($x);

        return redirect('/admin')->with('judul', 'Daftar Mahasiswa');
    }
    public function destroy($id)
    {
        DB::table('stoks')->where('id', $id)->delete();

        return redirect('/admin')->with('judul', 'Daftar Mahasiswa');
    }
}
