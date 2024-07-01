public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'hargajual' => 'required',
        'panjang' => 'required',
        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ubah validasi untuk multiupload
        'desc' => 'required',
        'kode' => 'required',
    ]);

    // Multiupload gambar
    $imageNames = [];
    foreach ($request->file('image') as $image) {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $imageNames[] = $imageName;
    }

    // Simpan data barang beserta nama-nama gambar
    $data = [
        'nama' => $request->nama,
        'hargajual' => $request->hargajual,
        'panjang' => $request->panjang,
        'image' => implode(',', $imageNames), // Simpan nama-nama file gambar dipisahkan dengan koma
        'desc' => $request->desc,
        'kode' => $request->kode,
    ];

    DB::table('tbstok')->insert($data);

    $request->session()->flash('pesan', 'Data berhasil dibuat.');

    return redirect()->to('/admin')->with('judul', 'Form Barang');
}
<div class="mb-3">
            <label for="image" class="form-label">Upload Foto Barang</label>
            <input type="file" name="image[]" id="inputImage" multiple="multiple" multiple class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
@foreach(explode(',', $value->image) as $index => $image)
    @if($index === 0)
        <img class="card-img-top" src="{{ asset('images/'.$image) }}"  />
    @endif
@endforeach

show liat gambar assetnya tergantung punya kalian publicnya