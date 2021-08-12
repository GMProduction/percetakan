@extends('admin.base')

@section('title')
    Data Barang
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
                        <td>{{$d->total_harga ?? ''}}</td>
                        <td>{{$d->status_pengerjaan == 0 ? 'Menunggu Konfirmasi' : ($d->status_pengerjaan == 1 ? 'Proses Desain' : ($d->status_pengerjaan == 2 ? 'Pengiriman' : 'Selesai'))}}</td>
                        <td>{{$d->status_bayar == 0 ? 'Belum' : 'Lunas'}}</td>
                        <td>
                            @if( $d->getHarga || isset($d->custom['satuan']))
                                <button type="button" class="btn btn-success btn-sm m-1" id="detailData" data-id="{{$d->id}}">Detail
                                </button>
                            @endif
                            <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal"
                                    data-bs-target="#kirimDesain">Kirim Desain
                            </button>
                            <a type="button" class="btn btn-warning btn-sm m-1 " href="https://wa.me/6287879878">Chat</a>
                            @if( !$d->getHarga && !isset($d->custom['satuan']) )
                                <button type="button" class="btn btn-primary btn-sm m-1" id="buatHarga" data-id="{{$d->id}}">Buat Harga
                                </button>
                            @endif
                        </td>
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

                            <a id="imgProduk" style="cursor: pointer"
                               href=""
                               target="_blank">
                                <img src=""
                                     style="width: 100%; height: 300px; object-fit: cover"/>
                            </a>

                            <div class="row mt-5">
                                <div class="col-8">
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
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-sm btn-success me-2">Terima</button>
                                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Proses Pengerjaan</label>
                                        <div class="d-flex">
                                            <select class="form-select" aria-label="Default select example" name="kategori">
                                                <option selected>Pilih</option>
                                                <option value="1">Menunggu Harga Admin</option>
                                                <option value="1">Menunggu Konfirmasi Harga</option>
                                                <option value="1">Menunggu Proses</option>
                                                <option value="2">Proses desain</option>
                                                <option value="3">Proses Pengiriman</option>
                                                <option value="3">Selesai</option>
                                            </select>
                                            <a class="btn btn-primary ms-2"><i class="bx bxs-check-circle"></i></a>
                                        </div>
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

                            <a id="imgProduk" style="cursor: pointer"
                               href=""
                               target="_blank">
                                <img src=""
                                     style="width: 100%; height: 300px; object-fit: cover"/>
                            </a>

                            <div class="row mt-5 ">
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
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Kirim Desain</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form>
                                <div class="mt-3 mb-2">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="gambar">
                                </div>


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
        })
        var idpesanan;
        $(document).on('click', '#detailData', function () {
            var id = $(this).data('id');
            getDetailPesanan(id)
            $('#detail').modal('show')
        })

        function afterAddHartga() {

        }

        function saveDataHarga() {
            saveData('Data harga', 'formharga', '/admin/pesanan/' + idpesanan + '/add-harga')
            return false;
        }

        function totalharga() {
            var satuan = $('#hHargaSatuan').val() === '' ? 0 : parseInt($('#hHargaSatuan').val());
            var laminasi = $('#hHargaLaminasi').val() === '' ? 0 : parseInt($('#hHargaLaminasi').val());
            var qty = parseInt($('#hQty').val());
            var ongkir = parseInt($('#hBiayaOngkir').val());
            var total = (((satuan + laminasi) * qty) + ongkir);

            $('#hTotalHarga').val(total.toLocaleString())
        }

        function getDetailPesanan(id) {
            $.get('/admin/pesanan/' + id, function (data) {
                $('#detail #dkategoriProduk').val(data['custom'] ? data['kategori']['nama_kategori'] : data['get_harga']['get_produk']['get_kategori']['nama_kategori']);
                $('#detail #dNamaProduk').val(data['get_harga'] ? data['get_harga']['get_produk']['nama_produk'] : 'Custom');
                $('#detail #dNamaPelanggan').val(data['get_user'] ? data['get_user']['get_pelanggan']['nama'] : '');
                $('#detail #dPakaiLaminasi').val(data['laminasi'] === 0 ? 'Tidak' : 'Ya');
                $('#detail #dJenisKertas').val(data['get_harga'] ? data['get_harga']['get_jenis']['nama_jenis'] : data['jenis']['nama_jenis']);
                $('#detail #dQty').val(data['qty']);
                $('#detail #dhargaSatuan').val(data['get_harga'] ? data['get_harga']['harga'] : data['custom']['satuan']);
                $('#detail #dhargaLaminasi').val(data['get_harga'] ? data['get_harga']['get_produk']['biaya_laminasi'] : data['custom']['laminasi']);
                $('#detail #dBiayaOngkir').val(data['biaya_ongkir']);
                $('#detail #dKeterangan').val(data['keterangan']);
                $('#detail #dTotalHarga').val(data['total_harga']);
                $('#detail #dStatusDesain').val(data['status_desain']);
                $('#detail #imgPayment').attr('href', data['get_pembayaran'] ? data['get_pembayaran']['url_gambar'] : '');
                $('#detail #imgPayment img').attr('src', data['get_pembayaran'] ? data['get_pembayaran']['url_gambar'] : '');
                $('#detail #imgProduk').attr('href', data['url_gambar']);
                $('#detail #imgProduk img').attr('src', data['url_gambar']);
            })
        }

        $(document).on('click', '#buatHarga', function () {
            var id = $(this).data('id');
            getBuatHarga(id)
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
                $('#modalbuatharga #hBiayaOngkir').val(data['biaya_ongkir']);

                $('#modalbuatharga #hKeterangan').val(data['keterangan']);
                $('#modalbuatharga #imgProduk').attr('href', data['url_gambar']);
                $('#modalbuatharga #imgProduk img').attr('src', data['url_gambar']);
            })
        }
    </script>

@endsection
