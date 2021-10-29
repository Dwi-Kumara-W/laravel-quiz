@extends('layout.app')

@section('content')
    <section class="section">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 50px">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Barang</li>
                </ol>
            </nav>
            @foreach ($barang as $b)
            <form method="POST" action="{{ route('barang.postubah') }}">
                @csrf
                <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_barang" name="id_barang"
                                    value="{{ $b->id_barang }}">
                            </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $b->nama_barang }}" required>
                    @error('nama_barang')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Barang</label>
                    <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi" required>
                    {{ $b->deskripsi }}
                    </textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $b->stok }}" required>
                    @error('stok')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $b->harga }}" required>
                    @error('harga')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-xs">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>
            @endforeach
        </main>
    </section>
@endsection
