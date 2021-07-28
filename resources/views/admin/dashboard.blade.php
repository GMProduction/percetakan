@extends('admin.base')
@section('title')
Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Permintaan peminjaman barang</h5>
    
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
    
                        <th>
                            Action
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

                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Terima</button>
                            <button type="button" class="btn btn-danger btn-sm">Tolak</button>
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
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">Terima</button>
                            <button type="button" class="btn btn-danger btn-sm">Tolak</button>
                        </td>
                    </tr>
                </table>
    
            </div>

        <div class="table-container">

        <h5 class="mb-3">Barang yang sedang di pinjam</h5>

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


@endsection
