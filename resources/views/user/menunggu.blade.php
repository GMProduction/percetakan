@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="row">
            <div class="col-md-6 col-sm-12" id="dataPesanan">
            </div>
        </div>


        <!-- Modal Tambah-->

    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#menunggu").addClass("active");
            getData();
        });

        function getData() {
            $.get('/user/menunggu/get', async function (data) {
                $('#dataPesanan').html('');

                if (data) {

                    await $.each(data, function (key, value) {
                        console.log(value)
                        var produkName = 'Custom';
                        var bank = '', gambar;
                        if (value['get_harga']) {
                            produkName = value['get_harga']['get_produk']['nama_produk'];
                        }

                        if (value['get_pembayaran']) {
                            bank = value['get_pembayaran']['id_bank'];
                            gambar = value['get_pembayaran']['url_gambar'];
                        }
                        var status = value['status_bayar'] === 1 ? 'Diterima' : 'Menunggu';
                        $('#dataPesanan').append('<div class="item-box mb-3">\n' +
                            '                    <div class="d-flex">\n' +
                            '                        <img id=""\n' +
                            '                             src="' + value['url_gambar'] + '" />\n' +
                            '                        <div class="ms-4">\n' +
                            '                            <p class="title">' + produkName + '</p>\n' +
                            '                            <p class="qty">Qty : ' + value['qty'] + '</p>\n' +
                            '                            <p class="keterangan">' + value['keterangan'] + '</p>\n' +
                            '                            <p class="totalHarga">Rp. ' + value['total_harga'].toLocaleString() + '</p> \n' +
                            '                            <p class="keterangan">Status : ' + status  + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>')
                    })
                }else{
                    $('#dataPesanan').html('<h6 class="">Tidak ada data</h6>');

                }
            })
        }
    </script>

@endsection
