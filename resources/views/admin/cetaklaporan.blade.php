<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Print Card</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" type="text/css">


</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
        }

        table { border: 1px solid #ccc; border-collapse: collapse; margin: 0; padding: 0; width: 100%; table-layout: fixed;}
      table caption { font-size: 1.5em; margin: .5em 0 .75em;}
      table tr { border: 1px solid #ddd; padding: .35em;}
      table th,
      table td { padding: .625em; text-align: center;}
      table th { font-size: .6em; letter-spacing: .1em; text-transform: uppercase;}
      @media screen and (max-width: 600px) {
        table { border: 0; }
        table caption { font-size: 1.3em; }
        table thead { border: none; clip: rect(0 0 0 0); height: 1px; margin: -1px; overflow: hidden; padding: 0; position: absolute; width: 1px;}
        table tr { border-bottom: 3px solid #ddd; display: block; margin-bottom: .625em; }
        table td { border-bottom: 1px solid #ddd; display: block; font-size: .6em; text-align: right;}
        table td::before { content: attr(data-label); float: left; font-weight: bold; text-transform: uppercase; }
        table td:last-child { border-bottom: 0; }
      }

    </style>

    <br>

    <div>
        <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px; float: left;" />

        <div>
            <h4 style=" text-align: right;margin-bottom:0;margin-top:0">Laporan Penjualan</h4>
            <h5 style=" text-align: right;margin-bottom:0;margin-top:0">Periode</h5>
            @if($start)
                <h5 style=" text-align: right;margin-bottom:0;margin-top:0">{{date('d F Y', strtotime($start))}} - {{date('d F Y', strtotime($end))}}</h5>
                @else
                <h5 style=" text-align: right;margin-bottom:0;margin-top:0">Semua</h5>
            @endif
        </div>

        <br>

        <table>
            <thead>
              <tr>
                <th>
                    #
                </th>
                <th >Nama Pelanggan</th>
                <th >Ketegori</th>
                <th >Produk</th>
                <th >Tanggal Pesan</th>
                <th >Tanggal Pembayaran</th>
                <th >Tanggal Diterima</th>
                <th >Harga Satuan</th>
                <th >Qty</th>
                <th >Biaya Kirim</th>
                <th >Total Harga</th>
              </tr>
            </thead>
            <tbody>
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
                      <td class="text-center" colspan="10">Tidak ada pesanan</td>
                  </tr>
              @endforelse
            <tr>
                <td colspan="7"></td>
                <td colspan="2">Grand Total</td>
                <td colspan="2">Rp. {{number_format($total,0)}}</td>
            </tr>
            </tbody>
          </table>


          <div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
            <p class="text-center mb-5">Pimpinan</p>
            <p class="text-center">( ........................... )</p>
        </div>

        <div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
            <p class="text-center mb-5">Admin</p>
            <p class="text-center">( {{auth()->user()->username}} )</p>
        </div>


        <footer class="footer">
            @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
            <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh :
                {{auth()->user()->username}}
            </p>
            <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
        </footer>

    </div>




    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
