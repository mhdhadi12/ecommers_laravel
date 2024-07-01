@extends('template.index')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Checkout</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
                    <div class="breadcrumb-item">Modal</div>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-primary" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (session('pesan'))
                <div class="alert alert-primary">
                    {{ session('pesan') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Stok</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ url('/admin/create') }}">Tambah Data Barang</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>User</th>
                                    <th>Detail Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Action</th>

                                    @foreach ($checkouts as $no => $checkout)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $checkout->kode }}</td>
                                            <td>{{ $checkout->user->nama }}</td>


                                            <td>
                                                <p>
                                                    {{ $checkout->stok->nama }} ({{ $checkout->size }}) x
                                                    {{ $checkout->qty }}
                                                </p>
                                            </td>
                                            <td>{{ $checkout->total }}</td>
                                            <td>{{ $checkout->status }}</td>
                                            <td>
                                                <img src="{{ Storage::url($checkout->bukti) }}" width="100"
                                                    height="100" alt="">
                                            </td>

                                            <td>
                                                <button class="btn btn-primary btn-action" data-toggle="modal"
                                                    data-target="#exampleModalCenter-{{ $checkout->id }}"><i
                                                        class="fas fa-pencil-alt"></i></button>

                                                <form method="POST" action="{{ url('admin-checkout', $checkout->id) }}"
                                                    class="btn btn-danger p-0"
                                                    onsubmit="return confirm('Update Status to Verify?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <button role="button" class="btn btn-warning btn-action"
                                                        data-toggle="tooltip" title="Update Status to Verify?"><i
                                                            class="fas fa-arrow-alt-circle-right"></i></button>
                                                </form>

                                                <form method="POST" action="{{ url('/admin', $checkout->id) }}"
                                                    class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button role="button" class="btn btn-danger btn-action"
                                                        data-toggle="tooltip" title="Delete"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach






                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php
            // dd($checkouts);
        @endphp
        @foreach ($checkouts as $checkout)
            <div class="modal fade" id="exampleModalCenter-{{ $checkout->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Ke - {{ $checkout->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('admin', $checkout->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <input class="form-control" type="hidden" name="id" value="{{ $checkout->id }}">
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="{{ isset($checkout->kode) ? $checkout->kode : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ isset($checkout->nama) ? $checkout->nama : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="idsatuan">Id Satuan</label>
                                    <select name="idsatuan" id="idsatuan" class="form-control select2" style="width: 20%;">
                                        <?php
                                        $menuden = DB::table('ssatuans')->get();
                                        ?>
                                        @foreach ($menuden as $key)
                                            @if (0)
                                                <option selected="selected" value="{{ $key->id }}">
                                                    {{ $key->nama }}</option>
                                            @else
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idkategori">Id Kategori</label>
                                    <select name="idkategori" id="idkategori" class="form-control select2"
                                        style="width: 20%;">
                                        <?php
                                        $menuden2 = DB::table('kategoris')->get();
                                        ?>
                                        @foreach ($menuden2 as $key)
                                            @if (0)
                                                <option selected="selected" value="{{ $key->id }}">
                                                    {{ $key->nama }}</option>
                                            @else
                                                <option value="{{ $key->id }}">{{ $key->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="saldoawal">Saldo Awal</label>
                                    <input type="number" class="form-control" id="saldoawal" name="saldoawal"
                                        value="{{ isset($checkout->saldoawal) ? $checkout->saldoawal : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="hargajual">Harga Jual</label>
                                    <input type="number" class="form-control" id="hargajual" name="hargajual"
                                        value="{{ isset($checkout->hargajual) ? $checkout->hargajual : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="tglexp">Tglsk Expayerd</label>
                                    <input type="date" class="form-control" id="tglexp" name="tglexp"
                                        value="{{ isset($checkout->tglexp) ? $checkout->tglexp : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="hargamodal">Harga Modal</label>
                                    <input type="number" class="form-control" id="hargamodal" name="hargamodal"
                                        value="{{ isset($checkout->hargamodal) ? $checkout->hargamodal : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Upload Foto Barang</label>
                                    <input type="file" name="foto[]" id="inputImage" multiple="multiple"
                                        class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Upload Foto Barang1</label>
                                    <input type="file" name="foto[]" id="inputImage" multiple="multiple"
                                        class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="foto" class="form-label">Upload Foto Barang2</label>
                                    <input type="file" name="foto[]" id="inputImage" multiple="multiple"
                                        class="form-control @error('foto') is-invalid @enderror">
                                    @error('foto')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <input type="text" class="form-control" id="desc" name="desc"
                                        value="{{ isset($checkout->deskripsi) ? $checkout->deskripsi : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="saldoakhir">Saldo Akhir</label>
                                    <input type="number" class="form-control" id="saldoakhir" name="saldoakhir"
                                        value="{{ isset($checkout->saldoakhir) ? $checkout->saldoakhir : '' }}">
                                </div>
                                <select class="form-select" aria-label="Default select example" name="pajang">
                                    <option selected>Pajang</option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </div>
    @endforeach
@endsection
