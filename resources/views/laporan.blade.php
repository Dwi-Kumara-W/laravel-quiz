@extends('layout.app')

@section('content')
    <section class="section">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="container" style="margin-top: 50px">
                <div class="row">
                    <div class="col-8">
                        <h2>Laporan</h2>
                    </div>
                    <div class="col-4">

                        {{-- <form method="GET" action="/order/cari">
                            <input class="form-control" type="text" placeholder="Search" name="cari" placeholder="Search"
                                aria-label="Search" value="{{ old('cari') }}">
                        </form> --}}

                    </div>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 20px">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjang as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-M-Y', strtotime($data->created_at)) }}</td>
                                <td>{{ $data->nama_pembeli }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    <a href="{{ route('laporan.detail_laporan', $data->id_keranjang) }}"
                                        class="btn btn-primary">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </section>
@endsection
