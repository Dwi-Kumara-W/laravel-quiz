@extends('layout.app')

@section('content')
    <section class="section">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="card" style="margin-top: 50px;">
                <div class="card-body">

                    <form method="POST" action="/status">
                        @csrf
                        @foreach ($keranjang as $data)
                            <h6>Nama : {{ $data->nama_pembeli }}</h6>
                            <h6>Alamat : {{ $data->alamat }}</h6>
                            <h6>Nomer Hp : {{ $data->nomertelp }}</h6>
                            <h3 style="float: right;">Status : {{ $data->status }}</h3>
                            <table class="table table-bordered" style="margin-top: 20px;">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>Rp. {{ $data->total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </form>
                </div>
            </div>

        </main>
    </section>
@endsection
