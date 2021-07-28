@extends('admin.base')

@section('title')
    Data Mapel
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
                <h5>Data Mapel</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#tambahmapel">Tambah Data Mapel</button>
            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        nama Mapel
                    </th>
                    <th>
                        Guru
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
                        Matematika
                    </td>
                    <td>
                        Erfin
                    </td>

                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editmapel">Ubah</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('id', 'nama') ">hapus</button>
                    </td>
                </tr>

            </table>

        </div>


        <div>


            <!-- Modal Tambah-->
            <div class="modal  fade" id="tambahmapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Mapel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="namamapel" class="form-label">Nama Mapel</label>
                                    <input type="text" class="form-control" id="namamapel">
                                </div>


                                
                                <a>Pilih Guru</a>
                                <select class="form-select" aria-label="Default select example" name="idguru">
                                    <option selected>Mata Pelajaran</option>
                                    <option value="1">Erfin</option>
                                    <option value="2">Joko A</option>
                                    <option value="3">Joko B</option>
                                </select>

                                <div class="mb-4"></div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Edit-->
            <div class="modal  fade" id="editmapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Mapel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>


                                <div class="mb-3">
                                    <label for="namamapel" class="form-label">Nama Mapel</label>
                                    <input type="text" class="form-control" id="namamapel">
                                </div>


                                <a>Pilih Guru</a>
                                <select class="form-select" aria-label="Default select example" name="idguru">
                                    <option selected>Mata Pelajaran</option>
                                    <option value="1">Erfin</option>
                                    <option value="2">Joko A</option>
                                    <option value="3">Joko B</option>
                                </select>

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
