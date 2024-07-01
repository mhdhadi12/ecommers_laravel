@extends('template.index')


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('admin') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="{{ isset($kode) ? $kode : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($nama) ? $nama : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="idsatuan">Id Satuan</label>
                                    <select name="idsatuan" id="idsatuan" class="form-control select2" style="width: 20%;">
                                        <?php
                            $menuden=DB::table('ssatuans')
                            ->get();
                           ?>
                @foreach ($menuden as $key)
                                            @if ( 0)
                                                <option selected="selected" value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @else
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idkategori">Id Kategori</label>
                                    <select name="idkategori" id="idkategori" class="form-control select2" style="width: 20%;">
                                        <?php
                            $menuden2=DB::table('kategoris')
                            ->get();
                           ?>
                                        @foreach ($menuden2 as $key)
                                            @if ( 0)
                                                <option selected="selected" value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @else
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="saldoawal">Saldo Awal</label>
                                        <input type="number" class="form-control" id="saldoawal" name="saldoawal" value="{{ isset($saldoawal) ? $saldoawal : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hargajual">Harga Jual</label>
                                        <input type="number" class="form-control" id="hargajual" name="hargajual" value="{{ isset($hargajual) ? $hargajual : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tglexp">Tglsk Expayerd</label>
                                        <input type="date" class="form-control" id="tglexp" name="tglexp" value="{{ isset($tglexp) ? $tglexp : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hargamodal">Harga Modal</label>
                                        <input type="number" class="form-control" id="hargamodal" name="hargamodal" value="{{ isset($hargamodal) ? $hargamodal : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="foto" class="form-label">Upload Foto Barang</label>
                                        <input type="file" name="foto[]" id="inputImage" multiple="multiple" class="form-control @error('foto') is-invalid @enderror">
                                        @error('foto')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Upload Foto Barang1</label>
                                    <input type="file" name="foto[]" id="inputImage" multiple="multiple" class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="foto" class="form-label">Upload Foto Barang2</label>
                                <input type="file" name="foto[]" id="inputImage" multiple="multiple" class="form-control @error('foto') is-invalid @enderror">
                                @error('foto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                    <div class="form-group">
                                        <label for="desc">Deskripsi</label>
                                        <input type="text" class="form-control" id="desc" name="desc" value="{{ isset($desc) ? $desc : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="saldoakhir">Saldo Akhir</label>
                                        <input type="number" class="form-control" id="saldoakhir" name="saldoakhir" value="{{ isset($saldoakhir) ? $saldoakhir : '' }}">
                                    </div>
                                    <select class="form-select" aria-label="Default select example" name="pajang">
                                        <option selected>Pajang</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                      </select>
                                <!-- Please add one option more here -->
                                <!-- Option when all those option above are not selected -->
                                <!-- Then Admin will put custom Number here (Berapa Lama Tahun Program) -->
                                <!-- Use Number input type -->

                        </div>
                    </div>

                    <div class="form-group buttons" style="display: flex; justify-content: end; margin-top: 100px;">
                        <a href="{{ url('admin') }}" class="btn btn-icon icon-left btn-danger"><i
                                class="fas fa-angle-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-icon icon-left btn-success"><i class="fas fa-check"></i>
                            Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
@endsection
