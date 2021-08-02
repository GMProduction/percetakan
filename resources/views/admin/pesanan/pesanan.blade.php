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


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        Nama Pelanggan
                    </th>
                    <th>
                        Produk
                    </th>

                    <th>
                        Qty
                    </th>

                    <th>
                        Total Harga
                    </th>

                    <th>
                        Status Pengerjaan
                    </th>

                    <th>
                        Status Pembayaran
                    </th>


                    <th>
                        Action
                    </th>

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Erfin
                    </td>
                    <td>
                        Undangan Tebal
                    </td>
                    <td>
                        100
                    </td>
                    <td>
                        1000000
                    </td>
                    <td>
                        Proses Desain
                    </td>
                    <td>
                        Sudah
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm m-1" data-bs-toggle="modal"
                            data-bs-target="#detail">Detail</button>
                        <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal"
                            data-bs-target="#kirimDesain">Kirim Desain</button>
                        <a type="button" class="btn btn-warning btn-sm m-1 " href="https://wa.me/6287879878">Chat</a>
                        <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal"
                            data-bs-target="#buatharga">Buat Harga</button>
                    </td>
                </tr>

            </table>

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

                            <a style="cursor: pointer"
                                href="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                target="_blank">
                                <img src="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                    style="width: 100%; height: 300px; object-fit: cover" />
                            </a>

                            <div class="row mt-5">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
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
                                                <input type="text" class="form-control" readonly id="dPakaiLaminasi">
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
                                        <textarea type="text" class="form-control" readonly id="hPakaiLaminasi"></textarea>
                                    </div>
                                </div>



                                <div class="col-4 border rounded p-3">
                                    <div class="mb-3">
                                        <label for="dStatusDesain" class="form-label">Status Desain</label>
                                        <input type="text" class="form-control" readonly id="dStatusDesain">
                                    </div>

                                    <div class="mb-3">
                                        <a for="dBuktiTransfer" class="d-block">Bukti Transfer</a>
                                        <a style="cursor: pointer"
                                            href="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                            target="_blank">
                                            <img src="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                                style="width: 100px; height: 50px; object-fit: cover" />
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
            <div class="modal fade" id="buatharga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <a style="cursor: pointer"
                                href="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                target="_blank">
                                <img src="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                                    style="width: 100%; height: 300px; object-fit: cover" />
                            </a>

                            <div class="row mt-5 ">
                                <div class="col-4">
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
                                        <textarea type="text" class="form-control" readonly id="hPakaiLaminasi"></textarea>
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

                                    <label for="hHargaSatuan" class="form-label">Harga Satuan</label>
                                    <input type="text" class="form-control" id="hHargaSatuan">

                                    <div class="mb-3">
                                        <label for="hHargaLaminasi" class="form-label">Harga Laminasi</label>
                                        <input type="text" class="form-control" id="hHargaLaminasi">
                                    </div>

                                    <div class="mb-3">
                                        <label for="dTotalHarga" class="form-label">Total Harga</label>
                                        <input type="text" class="form-control" readonly id="dTotalHarga">
                                    </div>

                                    <button type="button" class="btn btn-primary ">Submit Harga</button>


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
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

        })

        function hapus(id, name) {
            swal({
                    title: "Menghapus data?",
                    text: "Apa kamu yakin, ingin menghapus data ?!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Berhasil Menghapus data!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data belum terhapus");
                    }
                });
        }
    </script>

@endsection
