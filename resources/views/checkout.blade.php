@extends('layout.app')

@section('content')
    <section class="section">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <nav aria-label="breadcrumb" style="margin-top: 50px;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/order">Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <h5>Silakan Lengkapi Form Order</h5>
                </div>
                <div class="card-body">

                    @foreach ($barang as $b)
                        <form method="POST" action="{{ route('order.tambah') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_barang" name="id_barang"
                                    value="{{ $b->id_barang }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    value="{{ $b->nama_barang }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok Barang</label>
                                <input type="text" class="form-control" id="stok" name="stok" value="{{ $b->stok }}"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" id="harga_barang" name="harga_barang"
                                    value="{{ $b->harga }}" disabled>
                                <input type="hidden" class="form-control" id="harga_barang" name="harga_barang"
                                    value="{{ $b->harga }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    oninput="submittotalharga()" required>
                                @error('jumlah')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Harga</label>
                                {{-- <input type="number" class="form-control" id="total" name="total" disabled required> --}}
                                <input type="number" class="form-control" id="total" name="total" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Pembeli</label>
                                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                                @error('nama_pembeli')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Pembeli</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat" required></textarea>
                                @error('alamat')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomer Telp</label>
                                <input type="text" class="form-control" id="nomertelp" name="nomertelp" required>
                                @error('nomer_telp')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="status" name="status" value="Lunas">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Uang Pembeli</label>
                                <input type="number" class="form-control" id="harga" name="harga"
                                    oninput="submitkembalian()" required>
                                @error('harga')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kembalian</label>
                                <input type="number" class="form-control" id="kembalian" name="kembalian" disabled>
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

                </div>
            </div>

            <script type="text/javascript">
                function submittotalharga() {
                    var harga = document.getElementById("harga_barang").value;
                    var jumlah = document.getElementById("jumlah").value;
                    var stok = parseInt(document.getElementById("stok").value);
                    var jumlah = parseInt(document.getElementById("jumlah").value);
                    if (jumlah > stok) {
                        alert('Maaf stok barang tidak cukup');
                        document.getElementById("jumlah").value = 0;
                        document.getElementById("total").value = 0;
                    } else if (0 >= jumlah) {
                        alert('Maaf inputan anda tidak sesuai');
                        document.getElementById("jumlah").value = 0;
                        document.getElementById("total").value = 0;
                    } else {
                        var total_harga = harga * jumlah;
                        document.getElementById("total").value = harga * jumlah;
                    }

                }

                function submitkembalian() {
                    var uang_pembeli = document.getElementById("harga").value;
                    var total_semua = document.getElementById("total").value;
                    var total_kembalian = uang_pembeli - total_semua;
                    if (total_kembalian >= 0) {
                        document.getElementById("kembalian").value = total_kembalian;
                    }else if (total_kembalian < 0){
                        document.getElementById("kembalian").value = 0;
                    }

                }
            </script>
        </main>
    </section>
@endsection
