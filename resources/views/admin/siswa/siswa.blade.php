@extends('admin.base')

@section('title')
    Data Siswa
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
                <h5>Data Siswa</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahsiswa">Tambah Data Siswa</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Siswa
                    </th>
                    <th>
                        Alamat
                    </th>

                    <th>
                        Tanggal Lahir
                    </th>


                    <th>
                        Kelas
                    </th>

                    <th>
                        No_hp
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
                        Sukoharjo
                    </td>
                    <td>
                        23 Maret 1994
                    </td>
                    <td>
                        XII A
                    </td>

                    <td>
                        08787845457
                    </td>

                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editsiswa">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->
            <div class="modal  fade" id="tambahsiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="namasiswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="namasiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="alamatsiswa" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamatsiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="ttlsiswa" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="datepicker">
                                </div>

                                <div class="mb-3">
                                    <label for="kelassiswa" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelassiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="nohpsiswa" class="form-label">No Hp</label>
                                    <input type="text" class="form-control" id="nohpsiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>

                                <div class="mb-3">
                                    <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="konfirmasi">
                                </div>




                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal  fade" id="editsiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="editnamasiswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="editnamasiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="editalamatsiswa" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="editalamatsiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="editttlsiswa" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="editdatepicker">
                                </div>

                                <div class="mb-3">
                                    <label for="editkelassiswa" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="editkelassiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="editnohpsiswa" class="form-label">No Hp</label>
                                    <input type="text" class="form-control" id="editnohpsiswa">
                                </div>

                                <div class="mb-3">
                                    <label for="editusername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="editusername">
                                </div>

                                <div class="mb-3">
                                    <label for="editpassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="editpassword">
                                </div>

                                <div class="mb-3">
                                    <label for="editkonfirmasi" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="editkonfirmasi">
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
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
@endsection
