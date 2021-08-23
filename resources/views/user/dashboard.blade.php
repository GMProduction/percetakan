@extends('base')

@section('moreCss')

<link rel="stylesheet" type="text/css" href="{{ asset('css/tab.css') }}" />

@endsection

@section('content')
<style>
    #tabelInvoice td {
        border: none;
    }
</style>
    <section>
        <div style="height: 80px"></div>


    </section>
    <section class="container">



        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <p class="category">Selamat datang {{auth()->user()->getPelanggan->nama}}</p>
                    <!-- Nav tabs -->
                    <div class="card" style="min-height: 34vh">
                        <div class="card-header">
                            <ul class="nav nav-tabs justify-content-center" role="tablist">

                                <li class="nav-item">
                                    <a id="keranjang" class="nav-link" data-toggle="tab" href="/user/keranjang" role="tab">
                                        <i class="bx bx-cart"></i> Keranjang
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="menunggu" class="nav-link" data-toggle="tab" href="/user/menunggu" role="tab">
                                        <i class="bx bx-time-five"></i> Menunggu Konfirmasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="proses" class="nav-link" data-toggle="tab" href="/user/proses" role="tab">
                                        <i class='bx bx-message-rounded-edit'></i>Proses Desain
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="pengerjaan" class="nav-link" data-toggle="tab" href="/user/pengerjaan" role="tab">
                                        <i class='bx bx-message-rounded-edit'></i>Proses Pengerjaan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a id="pengiriman" class="nav-link" data-toggle="tab" href="/user/pengiriman" role="tab">
                                        <i class='bx bxs-truck' ></i> Pengiriman
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="selesai" class="nav-link" data-toggle="tab" href="/user/selesai" role="tab">
                                        <i class='bx bx-check' ></i> Selesai
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="profil" class="nav-link" data-toggle="tab" href="/user/profile" role="tab">
                                        <i class='bx bx-user'></i> Profil
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <!-- Tab panes -->
                            @yield('contentUser')
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="modalInvoice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('static-image/logo.png') }}" style="height: 40px;" />
                        </div>
                        <hr>
                        <table class="table" id="tabelInvoice">
                            <tr>
                                <td>No. Pemesanan</td>
                                <td>:</td>
                                <td id="noPesan"></td>
                            </tr>
                            <tr>
                                <td>Nama Produk</td>
                                <td>:</td>
                                <td id="nama"></td>
                            </tr>
                            <tr>
                                <td>Kategori Produk</td>
                                <td>:</td>
                                <td id="kategori"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kertas</td>
                                <td>:</td>
                                <td id="jenis"></td>
                            </tr>
                            <tr>
                                <td>Laminasi</td>
                                <td>:</td>
                                <td id="laminasi"></td>
                            </tr>
                            <tr>
                                <td>Harga Satuan</td>
                                <td>:</td>
                                <td id="hargaSatuan" class="text-end"></td>
                            </tr>
                            <tr>
                                <td>Qty</td>
                                <td>:</td>
                                <td id="qty" class="text-end"></td>
                            </tr>
                            <tr>
                                <td>Harga Laminasi</td>
                                <td>:</td>
                                <td id="hargaLaminasi" class="text-end"></td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim</td>
                                <td>:</td>
                                <td id="ongkir" class="text-end" style="border-bottom: 1px solid #cccccc"></td>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <td>:</td>
                                <td id="totHarga" class="text-end  fw-bold"></td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-end">
                            <div>
                                <h6 class="text-center">{{date('d F Y', strtotime(now('Asia/Jakarta')))}}</h6>
                                <br>
                                <h6 class="mt-3 text-center">Admin</h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function() {

            $("#menunggu").removeClass("active");
            $("#proses").removeClass("active");
            $("#pengiriman").removeClass("active");
            $("#selesai").removeClass("active");
            $("#profil").removeClass("active");
            $("#pengerjaan").removeClass("active");

            $('.slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false
            });
        });

        $(document).on('click', '#invoice', function () {
            getProduk($(this).data('id'))
            $('#modalInvoice').modal('show')
        })

        function getProduk(id) {
            $.get('/user/produk/' + id, function (data) {
                console.log(data);
                var produkName = 'Custom';
                if (data['get_harga']) {
                    produkName = data['get_harga']['get_produk']['nama_produk'];
                }

                var kategori = '',jenis, harga, hargalaminasi;
                if (data['get_harga']) {
                    kategori = data['get_harga']['get_produk']['get_kategori']['nama_kategori']
                    jenis    = data['get_harga']['get_jenis']['nama_jenis']
                    harga = data['get_harga']['harga']
                    hargalaminasi = data['get_harga']['get_produk']['biaya_laminasi']
                } else {
                    kategori = data['kategori']['nama_kategori']
                    jenis = data['jenis_kertas']['nama_jenis']
                    harga = data['custom']['satuan']
                    hargalaminasi = data['custom']['laminasi']
                }
                var laminasi = data['laminasi'] === 1 ? 'Ya' : 'Tidak';
                $('#modalInvoice #noPesan').html(data['id'])
                $('#modalInvoice #nama').html(produkName)
                $('#modalInvoice #kategori').html(kategori)
                $('#modalInvoice #jenis').html(jenis)
                $('#modalInvoice #laminasi').html(laminasi)
                $('#modalInvoice #qty').html(data['qty'].toLocaleString())
                $('#modalInvoice #hargaSatuan').html(harga.toLocaleString())
                $('#modalInvoice #hargaLaminasi').html(hargalaminasi.toLocaleString())
                $('#modalInvoice #ongkir').html(data['biaya_ongkir'].toLocaleString())
                $('#modalInvoice #totHarga').html(data['total_harga'].toLocaleString())

            })
        }

    </script>

    @yield('scriptUser')
@endsection
