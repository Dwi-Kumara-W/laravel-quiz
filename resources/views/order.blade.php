@extends('layout.app')
@section('content')
    <section class="section">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-8">
                        <h2>Order Mainan</h2>
                    </div>
                    <div class="col-4">

                        <form method="GET" action="/order/cari">
                            <input class="form-control" type="text" placeholder="Search" name="cari" placeholder="Search"
                                aria-label="Search" value="{{ old('cari') }}">
                        </form>

                    </div>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 20px">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_barang }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td>{{ $data->stok }}</td>
                                <td>{{ $data->harga }}</td>
                                <td>
                                    <a href="{{ route('order.checkout', $data->id_barang) }}" class="btn btn-success">Check
                                        Out</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $barang->Links() !!}
            </div>
        </main>
    </section>
@endsection
