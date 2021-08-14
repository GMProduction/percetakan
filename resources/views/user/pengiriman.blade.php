@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="row">
            <div class="col-md-6 col-sm-12" id="dataPesanan">
            </div>
        </div>

    </section>

@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#pengiriman").addClass("active");
            getData();
        });

        function getData() {
            $.get('/user/pengiriman/get', async function (data) {
                $('#dataPesanan').html('');

                if (data.length > 0) {

                    console.log(data.length)
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
                        $('#dataPesanan').append('<div class="item-box mb-3">\n' +
                            '                    <div class="d-flex">\n' +
                            '                        <img id=""\n' +
                            '                             src="' + value['url_gambar'] + '" />\n' +
                            '                        <div class="ms-4">\n' +
                            '                            <p class="title">' + produkName + '</p>\n' +
                            '                            <p class="qty">' + value['qty'] + '</p>\n' +
                            '                            <p class="keterangan">' + value['keterangan'] + '</p>\n' +
                            '                            <p class="totalHarga">Rp. ' + value['total_harga'].toLocaleString() + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="d-flex">\n' +
                            '                        <a class="btn btn-primary btn-sm ms-auto" id="diterima"  data-id="' + value['id'] + '" >Diterima</a>\n' +
                            '                    </div>' +
                            '                </div>')
                    })
                }else{
                    $('#dataPesanan').html('<h6 class="">Tidak ada data</h6>');
                }
            })
        }

        $(document).on('click', '#diterima', function () {
            var id = $(this).data('id');
            let data = {
                '_token' : '{{csrf_token()}}',
            }
            saveDataObject('Terima Pesanan',data,'/user/pengiriman/'+id+'/konfirmasi',getData);
        })
    </script>

@endsection
