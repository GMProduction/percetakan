@extends('admin.base')

@section('title')
    Data Pesanan
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Pesanan</h5>

            </div>

            {{--{{dump($data[1]->custom['jenis'])}}--}}
            <div class="d-flex justify-content-end mb-3">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Status Pengerjaan</label>
                        <div class="d-flex">
                            <form id="formCari" action="">
                                <select class="form-select" aria-label="Default select example" id="statusCari" name="status">
                                    <option selected value="">Semua</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Proses Desain">Proses Desain</option>
                                    <option value="Proses Pengerjaan">Proses Pengerjaan</option>
                                    <option value="Dikirim">Dikirim</option>
                                    <option value="Diterima">Diterima</option>
                                </select>
                            </form>
                        </div>
                    </div>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Kategori</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                    <th>Status Pengerjaan</th>
                    <th>Status Desain</th>
                    <th>Status Pembayaran</th>
                    <th>Action</th>
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
                        <td>{{$d->status_pengerjaan == 0 ? ($d->getPembayaran ? 'Menunggu Konfirmasi' : 'Menunggu Pembayaran') : ($d->status_pengerjaan == 1 ? 'Proses Desain' : ($d->status_pengerjaan == 2 ? 'Proses Pengerjaan' : ($d->status_pengerjaan == 3 ? 'Pengiriman' : ($d->status_pengerjaan == 4 ? 'Diterima' : 'Menunggu Pembayaran'))))}}</td>
                        <td>{{$d->status_desain === 0 ? 'Proses Desain' : ($d->status_desain === 1 ? 'Desain Dikirim' : ($d->status_desain === 2 ? 'Desain Ditolak' : ($d->status_desain === 3 ? 'Desain Diterima' : 'Menunggu Pembayaran')))}}</td>
                        <td>{{$d->status_bayar == 0 ? 'Belum' : 'Lunas'}}</td>
                        <td>
                            @if( $d->getHarga || isset($d->custom['satuan']))
                                <button type="button" class="btn btn-success btn-sm m-1" id="detailData" data-id="{{$d->id}}">Detail
                                </button>
                            @endif
                            @if($d->status_pengerjaan !== 0 && $d->status_pengerjaan < 3)
                                <button type="button" class="btn btn-primary btn-sm m-1" id="addDesain" data-id="{{$d->id}}" data-image="{{$d->getDesain ? $d->getDesain->url_desain : ''}}">Kirim
                                    Desain
                                </button>
                            @endif
                            <a type="button" class="btn btn-warning btn-sm m-1 " target="_blank" href="https://wa.me/{{$d->getUser->getPelanggan->no_hp}}">Chat</a>
                            @if( !$d->getHarga && !isset($d->custom['satuan']) )
                                <button type="button" class="btn btn-primary btn-sm m-1" id="buatHarga" data-id="{{$d->id}}">Buat Harga
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="10">Tidak ada pesanan</td>
                    </tr>
                @endforelse
            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>


        <div>



            <!-- Modal Detail-->
            <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="imgProduk" class="form-label">Gamabar</label>

                                    <a id="imgProduk" style="cursor: pointer"
                                       href=""
                                       target="_blank">
                                        <img src=""
                                             style="width: 100%; height: 300px; object-fit: cover"/>
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="imgFile" class="form-label">File</label>
                                    <a id="imgFile" style="cursor: pointer"
                                       href=""
                                       target="_blank">
                                        <img src=""
                                             style="width: 100%; height: 300px; object-fit: cover"/>
                                    </a>
                                </div>
                                <div class="col-8 mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="dNamaProduk" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" readonly id="dkategoriProduk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dNamaProduk" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" readonly id="dNamaProduk">
                                            </div>

                                            <div class="mb-3">
                                                <label for="dNamaPelanggan" class="form-label">Nama Pelanggan</label>
                                                <input type="text" class="form-control" readonly id="dNamaPelanggan">
                                            </div>

                                            <div class="mb-3">
                                                <label for="dPakaiLaminasi" class="form-label">Pakai Laminasi</label>
                                                <input type="text" class="form-control" readonly id="dPakaiLaminasi">
                                            </div>

                                            <div class="mb-3">
                                                <label for="dPakaiLaminasi" class="form-label">Jenis Kertas</label>
                                                <input type="text" class="form-control" readonly id="dJenisKertas">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="dQty" class="form-label">Qty </label>
                                                <input type="text" class="form-control" readonly id="dQty">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dhargaSatuan" class="form-label">Harga Satuan</label>
                                                <input type="text" class="form-control" readonly id="dhargaSatuan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dhargaLaminasi" class="form-label">Harga Laminasi</label>
                                                <input type="text" class="form-control" readonly id="dhargaLaminasi">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dBiayaOngkir" class="form-label">Biaya Ongkir</label>
                                                <input type="text" class="form-control" readonly id="dBiayaOngkir">
                                            </div>
                                            <div class="mb-3">
                                                <label for="dTotalHarga" class="form-label">Total Harga</label>
                                                <input type="text" class="form-control" readonly id="dTotalHarga">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hPakaiLaminasi" class="form-label">Keterangan</label>
                                        <textarea type="text" class="form-control" readonly id="dKeterangan"></textarea>
                                    </div>

                                </div>
                                <div class="col-4 border rounded p-3">
                                    <div class="mb-3">
                                        <label for="dStatusDesain" class="form-label">Status Desain</label>
                                        <input type="text" class="form-control" readonly id="dStatusDesain">
                                    </div>
                                    <div class="mb-3">
                                        <a for="dBuktiTransfer" class="d-block">Bukti Transfer</a>
                                        <a id="imgPayment" style="cursor: pointer"
                                           href=""
                                           target="_blank">
                                            <img src=""
                                                 style="width: 100px; height: 50px; object-fit: cover"/>
                                        </a>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Pembayaran</label>
                                        <div id="statusPembayaran"></div>
                                        <div class="d-flex" id="btnKonfirmasi">
                                            <form id="formTerima" onsubmit="return saveKonfirmasi(1)">
                                                @csrf
                                                <input name="status" value="1" hidden>
                                                <button type="submit" class="btn btn-sm btn-success me-2">Terima</button>
                                            </form>
                                            <form id="formTolak" onsubmit="return saveKonfirmasi(0)">
                                                @csrf
                                                <input name="status" value="0" hidden>
                                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Proses Pengerjaan : <span id="statusPengerjaan"></span></label>
                                        <div class="d-flex" id="btnProses">
                                        </div>
                                    </div>
                                    <div class="">
                                        <input id="detailAlamat" hidden>
                                        <a class="btn btn-sm btn-danger" id="detailPengiriman">Detail Pengiriman</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="modal  fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalDetailPengiriman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                 data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Detail </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Nama Expedisi</label>
                                        <input type="text" class="form-control" readonly id="expedisi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Layanan</label>
                                        <input type="text" class="form-control" readonly id="layanan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Estimasi</label>
                                        <input type="text" class="form-control" readonly id="estimasi">
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control" readonly id="tujuan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Alamat Detail</label>
                                        <textarea class="form-control" id="alamatDetail" readonly></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Biaya</label>
                                        <input type="text" class="form-control" readonly id="biaya">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <!-- Modal Buat Harga-->
            <div class="modal fade" id="modalbuatharga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="imgProduk" class="form-label">Gamabar</label>

                                    <a id="imgProduk" style="cursor: pointer"
                                       href=""
                                       target="_blank">
                                        <img src=""
                                             style="width: 100%; height: 300px; object-fit: cover"/>
                                    </a>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="imgFile" class="form-label">File</label>
                                    <a id="imgFile" style="cursor: pointer"
                                       href=""
                                       target="_blank">
                                        <img src=""
                                             style="width: 100%; height: 300px; object-fit: cover"/>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="dNamaProduk" class="form-label">Kategori</label>
                                        <input type="text" class="form-control" readonly id="hkategoriProduk">
                                    </div>
                                    <div class="mb-3">
                                        <label for="hNamaProduk" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" readonly id="hNamaProduk">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hNamaPelanggan" class="form-label">Nama Pelanggan</label>
                                        <input type="text" class="form-control" readonly id="hNamaPelanggan">
                                    </div>


                                    <div class="mb-3">
                                        <label for="hPakaiLaminasi" class="form-label">Pakai Laminasi</label>
                                        <input type="text" class="form-control" readonly id="hPakaiLaminasi">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hPakaiLaminasi" class="form-label">Keterangan</label>
                                        <textarea type="text" class="form-control" readonly id="hKeterangan"></textarea>
                                    </div>
                                </div>

                                <div class="col-4 ">
                                    <div class="mb-3">
                                        <label for="hBiayaOngkir" class="form-label">Biaya Ongkir</label>
                                        <input type="text" class="form-control" readonly id="hBiayaOngkir">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hJenisKertas" class="form-label">Jenis Kertas</label>
                                        <input type="text" class="form-control" readonly id="hJenisKertas">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hQty" class="form-label">Qty </label>
                                        <input type="text" class="form-control" readonly id="hQty">
                                    </div>


                                </div>

                                <div class="col-4 border rounded p-3">

                                    <form id="formharga" onsubmit="return saveDataHarga()">
                                        @csrf
                                        <label for="hHargaSatuan" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control" id="hHargaSatuan" name="hargaSatuan" onkeyup="totalharga()" value="0">

                                        <div class="mb-3">
                                            <label for="hHargaLaminasi" class="form-label">Harga Laminasi</label>
                                            <input type="number" class="form-control" id="hHargaLaminasi" name="hargaLaminasi" onkeyup="totalharga()" value="0">
                                        </div>

                                        <div class="mb-3">
                                            <label for="dTotalHarga" class="form-label">Total Harga</label>
                                            <input type="text" class="form-control" readonly id="hTotalHarga" name="totalHarga">
                                        </div>

                                        <button type="submit" class="btn btn-primary ">Submit Harga</button>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Kirim Desain-->
            <div class="modal fade" id="kirimDesain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kirim Desain</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="formDesain" enctype="multipart/form-data" onsubmit="return saveDesain()">
                                @csrf
                                <div class=" mb-2">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="url_desain" name="url_desain" accept="image/jpeg, image/png">
                                </div>
                                <a id="imgDesain" style="cursor: pointer"
                                   href=""
                                   target="_blank">
                                    <img src=""
                                         style="width: 100%; height: 100%; object-fit: cover"/>
                                </a>
                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#statusCari').val('{{request('status')}}')

        })
        var idpesanan;
        $(document).on('click', '#detailData', function () {
            idpesanan = $(this).data('id');
            getDetailPesanan(idpesanan)
            $('#detail').modal('show')
        })

        $(document).on('change', '#statusCari', function () {
            document.getElementById('formCari').submit();
        })

        function afterAddHartga() {

        }

        $(document).on('click', '#detailPengiriman', function () {
            $.get('/admin/pesanan/'+idpesanan+'/expedisi', function (data) {
                $('#expedisi').val(data['nama'])
                $('#layanan').val(data['service'])
                $('#estimasi').val(data['estimasi']+' Hari')
                $('#tujuan').val(data['nama_kota']+', '+data['nama_propinsi'])
                $('#alamatDetail').val($('#detail #detailAlamat').val())
                $('#modalDetailPengiriman #biaya').val(data['biaya'].toLocaleString())
            })
            $('#modalDetailPengiriman').modal('show');
        })

        $(document).on('click', '#addDesain', function () {
            idpesanan = $(this).data('id');
            var image = $(this).data('image');
            $('#kirimDesain #url_desain').val('')
            $('#kirimDesain #imgDesain').attr('href', image);
            $('#kirimDesain #imgDesain img').attr('src', image);
            $('#kirimDesain').modal('show')
        })

        function saveDataHarga() {
            saveData('Data harga', 'formharga', '/admin/pesanan/' + idpesanan + '/add-harga')
            return false;
        }

        function saveKonfirmasi(a) {
            var isi = 'Tolak'
            var form = 'formTolak'
            if (a === 1) {
                isi = 'Terima'
                form = 'formTerima'
            }
            let form_data = {
                'status': a,
                '_token': '{{ csrf_token() }}',
            };

            saveData(isi + ' Pembayaran', form, '/admin/pesanan/' + idpesanan + '/konfirmasi-pembayaran');
            return false;
        }

        function totalharga() {
            var satuan = $('#hHargaSatuan').val() === '' ? 0 : parseInt($('#hHargaSatuan').val());
            var laminasi = $('#hHargaLaminasi').val() === '' ? 0 : parseInt($('#hHargaLaminasi').val());
            var qty = parseInt($('#hQty').val());
            var ongkir = parseInt($('#hBiayaOngkir').val().replace(',',''));
            var total = (((satuan + laminasi) * qty) + ongkir);

            $('#hTotalHarga').val(total.toLocaleString())
        }

        $(document).on('click', '#klikProses', function () {
            var status = $(this).data('status');
            var data = {
                'status': status,
                '_token': '{{ csrf_token() }}',
            }

            console.log(data)
            saveDataObject('Ganti Proses', data, '/admin/pesanan/' + idpesanan + '/proses');
            return false;
        })

        function saveDesain() {
            saveData('Kirim Desain', 'formDesain', '/admin/pesanan/' + idpesanan + '/desain');
            return false;
        }

        function getDetailPesanan(id) {
            $.get('/admin/pesanan/' + id, function (data) {
                $('#statusPembayaran').html('')
                $('#btnKonfirmasi').removeClass('d-none')
                var btnProses;
            console.log(data)
                if (!data['get_pembayaran']){
                    $('#btnKonfirmasi').addClass('d-none')
                }
                if (data['status_bayar'] === 1) {
                    $('#statusPembayaran').html('<label class="fw-bold">Diterima</label>')
                    $('#btnKonfirmasi').addClass('d-none')
                    btnProses = '<a class="btn btn-primary" id="klikProses" data-status="1">Desain</a>';
                }
                var statusPengerjaan = 'Menunggu Konfirmasi';
                if (data['status_pengerjaan'] === 1) {
                    statusPengerjaan = 'Desain'
                    btnProses = '<a class="btn btn-primary" id="klikProses" data-status="2">Proses Pengerjaan</a>';
                } else if (data['status_pengerjaan'] === 2) {
                    statusPengerjaan = 'Proses Pengerjaan'
                    btnProses = '<a class="btn btn-primary" id="klikProses" data-status="3">Kirim</a>';
                } else if (data['status_pengerjaan'] === 3) {
                    statusPengerjaan = 'Kirim'
                    btnProses = '';
                } else if (data['status_pengerjaan'] === 4) {
                    statusPengerjaan = 'Diterima'
                    btnProses = '';
                }
                var statusDesain = 'Menunggu Pembayaran';
                var st = data['status_desain'];
                if (st !== null) {
                    statusDesain = 'Proses Desain'
                    if (st === 3) {
                        statusDesain = 'Desain Diterima'
                    } else if (st === 1) {
                        statusDesain = 'Desain Dikirim'
                    } else if (st === 2) {
                        statusDesain = 'Desain Ditolak'
                    }
                }
                $('#detail #dkategoriProduk').val(data['custom'] ? data['kategori']['nama_kategori'] : data['get_harga']['get_produk']['get_kategori']['nama_kategori']);
                $('#detail #dNamaProduk').val(data['get_harga'] ? data['get_harga']['get_produk']['nama_produk'] : 'Custom');
                $('#detail #dNamaPelanggan').val(data['get_user'] ? data['get_user']['get_pelanggan']['nama'] : '');
                $('#detail #dPakaiLaminasi').val(data['laminasi'] === 0 ? 'Tidak' : 'Ya');
                $('#detail #dJenisKertas').val(data['get_harga'] ? data['get_harga']['get_jenis']['nama_jenis'] : data['jenis']['nama_jenis']);
                $('#detail #dQty').val(data['qty']);
                $('#detail #detailAlamat').val(data['alamat']);
                $('#detail #dhargaSatuan').val(data['get_harga'] ? data['get_harga']['harga'].toLocaleString() : data['custom']['satuan'].toLocaleString());
                $('#detail #dhargaLaminasi').val(data['get_harga'] ? data['get_harga']['get_produk']['biaya_laminasi'].toLocaleString() : data['custom']['laminasi'].toLocaleString());
                $('#detail #dBiayaOngkir').val(data['biaya_ongkir'].toLocaleString());
                $('#detail #dKeterangan').val(data['keterangan']);
                $('#detail #dTotalHarga').val(data['total_harga'].toLocaleString());
                $('#detail #dStatusDesain').val(statusDesain);
                $('#detail #statusPengerjaan').html(statusPengerjaan)
                $('#detail #btnProses').html(btnProses)
                $('#detail #imgPayment').attr('href', data['get_pembayaran'] ? data['get_pembayaran']['url_gambar'] : '');
                $('#detail #imgPayment img').attr('src', data['get_pembayaran'] ? data['get_pembayaran']['url_gambar'] : '');
                $('#detail #imgProduk').attr('href', data['url_gambar']);
                $('#detail #imgProduk img').attr('src', data['url_gambar']);
                $('#detail #imgFile').attr('href', data['url_file']);
                $('#detail #imgFile img').attr('src', data['url_file']);
            })
        }

        $(document).on('click', '#buatHarga', function () {
            var id = $(this).data('id');
            getBuatHarga(id)
            $('#modalbuatharga #hHargaSatuan').val('0')
            $('#modalbuatharga #hHargaLaminasi').val('0')
            $('#modalbuatharga').modal('show')
        })

        function getBuatHarga(id) {
            $.get('/admin/pesanan/' + id, function (data) {
                console.log(data);
                idpesanan = data['id'];
                $('#modalbuatharga #hkategoriProduk').val(data['custom'] ? data['kategori']['nama_kategori'] : data['get_harga']['get_produk']['get_kategori']['nama_kategori']);
                $('#modalbuatharga #hNamaProduk').val(data['get_harga'] ? data['get_harga']['get_produk']['nama_produk'] : 'Custom');
                $('#modalbuatharga #hNamaPelanggan').val(data['get_user'] ? data['get_user']['get_pelanggan']['nama'] : '');
                $('#modalbuatharga #hPakaiLaminasi').val(data['laminasi'] === 0 ? 'Tidak' : 'Ya');
                $('#modalbuatharga #hJenisKertas').val(data['get_harga'] ? data['get_harga']['get_jenis']['nama_jenis'] : data['jenis']['nama_jenis']);
                $('#modalbuatharga #hQty').val(data['qty']);
                $('#modalbuatharga #hBiayaOngkir').val(data['biaya_ongkir'].toLocaleString());
                $('#modalbuatharga #hHargaLaminasi').attr('readonly','');
                if (data['laminasi'] === 1){
                    $('#modalbuatharga #hHargaLaminasi').removeAttr('readonly');
                }
                $('#modalbuatharga #hKeterangan').val(data['keterangan']);
                $('#modalbuatharga #imgProduk').attr('href', data['url_gambar']);
                $('#modalbuatharga #imgProduk img').attr('src', data['url_gambar']);
                $('#modalbuatharga #imgFile').attr('href', data['url_file']);
                $('#modalbuatharga #imgFile img').attr('src', data['url_file']);
            })
        }
    </script>

@endsection
