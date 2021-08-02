@extends('admin.base')
@section('title')
    Dashboard
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <h5 class="mb-3">Pesanan Baru</h5>

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
                        Jenis Kertas
                    </th>

                    <th>
                        Qty
                    </th>

                    <th>
                        Total Harga
                    </th>

                    <th>
                        Tanggal
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
                        Joko
                    </td>
                    <td>
                        Undangan tipe A
                    </td>
                    <td>
                        Art Carton 260g
                    </td>
                    <td>
                        1000
                    </td>
                    <td>
                        1000000
                    </td>
                    <td>
                        25 Agustus 2021
                    </td>


                    <td>
                        <button type="button" class="btn btn-primary btn-sm">Terima</button>
                        <button type="button" class="btn btn-danger btn-sm">Tolak</button>
                    </td>
                </tr>

            </table>

        </div>

    </section>


@endsection

@section('script')


@endsection
