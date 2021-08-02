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
                <h5>Data Produk</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahproduk">Tambah Data</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Produk
                    </th>
                    <th>
                        Gambar
                    </th>

                    <th>
                        Kategori
                    </th>

                    <th>
                        Jenis Kertas
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
                        Undangan Tebel
                    </td>
                    <td>
                        <img src="https://images.tokopedia.net/img/cache/900/product-1/2020/4/10/22258225/22258225_4e32e5f1-82ec-47bd-8202-5b0ca54ded39_1000_1000"
                            style="width: 100px; height: 50px; object-fit: cover" />
                    </td>
                    <td>
                        Undangan
                    </td>
                    <td>
                        3
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalHarga">Tambah Harga</button>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahproduk">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Harga-->
            <div class="modal fade" id="modalHarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">harga Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">


                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Data Harga Produk</h5>
                                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#tambahharga">Tambah Data</button>
                            </div>


                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Jenis Kertas
                                    </th>
                                    <th>
                                        harga
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
                                        Art Carton 260g
                                    </td>

                                    <td>
                                        1000
                                    </td>

                                    <td>

                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#tambahharga">Ubah</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="hapus('id', 'nama') ">hapus</button>
                                    </td>
                                </tr>

                            </table>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Tambah harga-->
            <div class="modal fade" id="tambahharga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Harga</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="jenisKertas" class="form-label">Jenis Kertas</label>
                                    <input type="text" class="form-control" id="jenisKertas">
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga">
                                </div>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Modal Tambah-->
            <div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="namaProduk" class="form-label">Nama Produk</label>
                                    <input type="email" class="form-control" id="namaProduk">
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <div class="d-flex">
                                        <select class="form-select" aria-label="Default select example" name="kategori">
                                            <option selected>Pilih Kategori</option>
                                            <option value="1">Undangan</option>
                                            <option value="2">Kartu Nama</option>
                                            <option value="3">Box</option>
                                        </select>
                                        <a class="btn btn-primary ms-2">+</a>
                                    </div>
                                </div>

                                <div class="mt-3 mb-2">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="gambar">
                                </div>

                                <div class="mb-3">
                                    <label for="biayaLaminasi" class="form-label">Biaya Laminasi</label>
                                    <input type="number" class="form-control" id="biayaLaminasi">
                                </div>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
