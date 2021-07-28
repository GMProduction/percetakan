@extends('admin.base')

@section('title')
    Data Laporan Peminjaman
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
                <h5>Data Laporan Peminjaman</h5>
                <div style="width: 300px">
                    <a>Status</a>
                    <div class="d-flex">

                        <select class="form-select me-2" aria-label="Default select example" name="idguru">
                            <option selected>Status</option>
                            <option value="1">Semua</option>
                            <option value="2">Menunggu Staff</option>
                            <option value="3">Menunggu Guru</option>
                            <option value="4">Menunggu Siswa Ambil</option>
                            <option value="5">Di pinjam</option>
                            <option value="6">Di kembalikan</option>
                        </select>

                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#tambahsiswa">Cetak</button>
                    </div>

                </div>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        Tanggal Pinjam
                    </th>
                    <th>
                        Nama Barang
                    </th>
                    <th>
                        Jumlah Pinjam
                    </th>

                    <th>
                        Nama Siswa
                    </th>

                    <th>
                        Mapel
                    </th>

                    <th>
                        Status
                    </th>

                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        25 Juli 2021
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        bola Basket
                    </td>
                    <td>
                        Topik
                    </td>
                    <td>
                        Kimia
                    </td>
                    <td>
                        Dipinjam
                    </td>
                </tr>

                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        25 Juli 2021
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        bola Basket
                    </td>
                    <td>
                        Bagus
                    </td>
                    <td>
                        Kimia
                    </td>
                    <td>
                        Dipinjam
                    </td>
                </tr>
            </table>

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
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
