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
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
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
                        Action
                    </th>
                </tr>

                </thead>
                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$d->nama_produk}}</td>
                        <td><img src="{{$d->url_gambar}}" style="width: 100px; height: 50px; object-fit: cover"/></td>
                        <td>{{$d->getKategori->nama_kategori}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-id="{{$d->id}}" id="tambahHarga">Tambah Harga
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-id="{{$d->id}}" id="editData">Ubah
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                        </td>
                    </tr>
                @empty
                @endforelse
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
                                <a type="button ms-auto" class="btn btn-primary btn-sm" id="addDataProduk">Tambah Data
                                </a>
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

                                <tbody id="tbharga">

                                </tbody>

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
                            <form id="form" onsubmit="return saveHarga()">
                                @csrf
                                <input id="id" name="id">
                                <input id="id_produk" name="id_produk">
                                <div class="mb-3">
                                    <label for="jenisKertas" class="form-label">Jenis Kertas</label>
                                    <input type="text" class="form-control" id="jenisKertas" name="jenis_kertas">
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga">
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
                                    <input type="email" class="form-control" id="nama_produk" name="nama_produk">
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <div class="d-flex">
                                        <select class="form-select" aria-label="Default select example" id="kategori" name="id_kategori">

                                        </select>
                                        <a class="btn btn-primary ms-2">+</a>
                                    </div>
                                </div>

                                <div class="mt-3 mb-2">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="url_gambar" name="url_gambar">
                                </div>

                                <div class="mb-3">
                                    <label for="biayaLaminasi" class="form-label">Biaya Laminasi</label>
                                    <input type="number" class="form-control" id="biaya_laminasi" name="biaya_laminasi">
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
        $(document).ready(function () {

        })



        $(document).on('click','#editData', function () {
            $('#tambahproduk').modal('show');
        })

        $(document).on('click','#addData', function () {
            getKategori();
            $('#tambahproduk').modal('show');
        })

        function getKategori() {
            var select = $('#kategori');
            select.empty();
            select.append('<option value="" disabled selected>Pilih Kategori</option>')
            $.get('{{route('produk_kategori')}}', function (data) {
                console.log(data);
                $.each(data, function (key, value) {
                    select.append('<option value="'+value['id']+'">'+value['nama_kategori']+'</option>')
                })
            })
        }

        //Jenis harga //
        function getDataHarga(id) {
            $.get('/admin/produk/'+id, function (data) {
                var tabel = $('#tbharga');
                tabel.empty();
                $('#tambahharga #id_produk').val(data['id']);
               $.each(data['get_harga'], function (key, value) {
                var row ='<tr>' +
                    '<td>'+parseInt(key+1)+'</td>' +
                    '<td>'+value['jenis_kertas']+'</td>' +
                    '<td>' +value['harga']+'</td>' +
                    '<td><a class="btn btn-sm btn-success" id="editDataProduk" data-id="'+value['id']+'"  data-jenis="'+value['jenis_kertas']+'" data-harga="'+value['harga']+'">Edit</a>' +
                    '<a class="btn btn-sm btn-danger"  id="deleteDataProduk" data-id="'+value['id']+'" data-jenis="'+value['jenis_kertas']+'">Hapus</a></td>' +
                    '</tr>';
                   tabel.append(row);
               })
            })
        }

        $(document).on('click','#tambahHarga', function () {
            var id = $(this).data('id');
            getDataHarga(id);
            $('#modalHarga').modal('show');
        })

        function afterAddharga() {
            var idProduk = $('#tambahharga #id_produk').val();
            $('#tambahharga').modal('hide');
            getDataHarga(idProduk);
        }
        function saveHarga(){
            var idProduk = $('#tambahharga #id_produk').val();
            saveData('Tambah Jenis harga','form','/admin/produk/'+idProduk, afterAddharga);
            return false;
        }

        $(document).on('click','#editDataProduk', function () {
            var id = $(this).data('id');
            var jenis = $(this).data('jenis');
            var harga = $(this).data('harga');

            $('#tambahharga #jenisKertas').val(jenis);
            $('#tambahharga #harga').val(harga);
            $('#tambahharga #id').val(id);
            $('#tambahharga').modal('show');
        })

        $(document).on('click','#addDataProduk', function () {
            $('#tambahharga #jenisKertas').val('');
            $('#tambahharga #harga').val('');
            $('#tambahharga #id').val('');
            $('#tambahharga').modal('show');
        })

        $(document).on('click','#deleteDataProduk', function () {
            var id = $(this).data('id');
            var nama = $(this).data('jenis');
            deleteData(nama,'/admin/produk/delete/'+id, afterAddharga)
            return false;
        })
    </script>

@endsection
