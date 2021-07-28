@extends('admin.base')

@section('title')
    Data Guru
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
                <h5>Data Guru</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahguru">Tambah Data Guru</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Guru
                    </th>
                    <th>
                        Alamat
                    </th>

                    <th>
                        TTL
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
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editguru">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->
            <div class="modal  fade" id="tambahguru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="namaguru" class="form-label">Nama Guru</label>
                                    <input type="text" class="form-control" id="namaguru">
                                </div>

                                <div class="mb-3">
                                    <label for="alamatguru" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamatguru">
                                </div>

                                <div class="mb-3">
                                    <label for="ttlguru" class="form-label">Tanggal Lahir</label>
                                    <input type="text"  class="form-control" id="datepicker">
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
            <div class="modal  fade" id="editguru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Guru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="editnamaguru" class="form-label">Nama Guru</label>
                                    <input type="text" class="form-control" id="editnamaguru">
                                </div>

                                <div class="mb-3">
                                    <label for="editalamatguru" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="editalamatguru">
                                </div>

                                <div class="mb-3">
                                    <label for="editttlguru" class="form-label">Tanggal Lahir</label>
                                    <input type="text"  class="form-control" id="editttlguru">
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
        $( function() {
          $( "#datepicker" ).datepicker();
        } );
        </script>
@endsection
