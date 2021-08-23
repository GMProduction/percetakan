@extends('admin.base')
@section('title')
    Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Laporan Pendapatan</h5>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Ketegori</th>
                    <th class="text-center">Produk</th>
                    <th class="text-center">Tanggal Pesan</th>
                    <th class="text-center">Tanggal Pembayaran</th>
                    <th class="text-center">Tanggal Diterima</th>
                    <th class="text-center">Harga Satuan</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Biaya Kirim</th>
                    <th class="text-center">Total Harga</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->getUser->getPelanggan->nama ?? ''}}</td>
                        <td>{{$d->getHarga ? $d->getHarga->getProduk->getKategori->nama_kategori : $d->kategori->nama_kategori}}</td>
                        <td>{{$d->getHarga ? $d->getharga->getProduk->nama_produk : 'Custom' }}</td>
                        <td>{{date('d F Y', strtotime($d->tanggal_pesan))}}</td>
                        <td>{{date('d F Y', strtotime($d->getPembayaran->created_at))}}</td>
                        <td>{{date('d F Y', strtotime($d->updated_at))}}</td>
                        <td class="text-end">Rp. {{number_format($d->harga_satuan,0)}}</td>
                        <td>{{$d->qty}}</td>
                        <td class="text-end">Rp. {{number_format($d->biaya_ongkir,0)}}</td>
                        <td class="text-end">Rp. {{$d->total_harga ? number_format($d->total_harga,0) : '-'}}</td>
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
            <div class="d-flex justify-content-end">
                <h5>Total Pendapatan : Rp. {{number_format($total, 0)}}</h5>
            </div>
        </div>
    </section>


@endsection

@section('script')


@endsection
