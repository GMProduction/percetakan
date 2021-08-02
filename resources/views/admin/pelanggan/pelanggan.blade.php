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
                <h5>Data Pelanggan</h5>

            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        Username
                    </th>
                    <th>
                        Nama Pelanggan
                    </th>

                    <th>
                        Alamat
                    </th>

                    <th>
                        No Hp
                    </th>



                </thead>

                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Efin123
                    </td>
                    <td>
                        Erfin Aditya
                    </td>
                    <td>
                        Sukoharjo
                    </td>
                    <td>
                        0878798745
                    </td>

                </tr>

            </table>

        </div>



    </section>

@endsection

@section('script')

@endsection
