@extends('admin.base')
@section('title')
    Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Pesanan Baru</h5>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Ketegori</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->getUser->getPelanggan->nama ?? ''}}</td>
                        <td>{{$d->getHarga ? $d->getHarga->getProduk->getKategori->nama_kategori : $d->kategori->nama_kategori}}</td>
                        <td>{{$d->getHarga ? $d->getharga->getProduk->nama_produk : 'Custom' }}</td>
                        <td>{{$d->qty}}</td>
                        <td>Rp. {{$d->total_harga ? number_format($d->total_harga,0) : '-'}}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_pesan))}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">Tidak ada pesanan</td>
                    </tr>
                @endforelse

            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>

    </section>


@endsection

@section('script')


@endsection
