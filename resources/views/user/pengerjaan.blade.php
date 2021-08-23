@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="row">
            <div class="col-md-6 col-sm-12" id="dataPesanan">
            </div>
        </div>

        <div class="modal fade" id="desain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Desain</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="d-flex justify-content-center">
                            <a id="imgDesain" style="cursor: pointer"
                               href=""
                               target="_blank">
                                <img src=""
                                     style="width: 400px; object-fit: cover"/>
                            </a>
                        </div>
                        <div>
                            <div id="statusDesain"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function() {

            $("#pengerjaan").addClass("active");
            getData();
        });

        function getData() {
            $.get('/user/pengerjaan/get',async function (data) {
                $('#dataPesanan').html('');

                if(data) {
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
                            '                            <p class="qty fw-bold">#' + value['id'] + '</p>\n' +
                            '                            <p class="title">' + produkName + '</p>\n' +
                            '                            <p class="qty">Qty : ' + value['qty'] + '</p>\n' +
                            '                            <p class="keterangan">' + value['keterangan'] + '</p>\n' +
                            '                            <p class="totalHarga">Rp. ' + value['total_harga'].toLocaleString() + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="d-flex">' +
                            '                    <a class="btn btn-warning btn-sm ms-auto mx-2" id="invoice" data-id="' + value['id'] + '" ><i class="bx bx-file"></i></a>' +
                            '                   <a class="btn btn-success btn-sm " id="desainData" data-status="' + value['status_desain'] + '" data-id="' + value['id'] + '" data-image="' + value['get_desain']['url_desain'] + '">Lihat Desain</a>' +
                            '                    </div>' +
                            '                </div>')
                    })
                }else{
                    $('#dataPesanan').html('<h6 class="">Tidak ada data</h6>');

                }
            })
        }

        $(document).on('click', '#desainData', function () {
            idpesanan = $(this).data('id');
            var image = $(this).data('image');
            var status = $(this).data('status');
            $('#statusDesain').html('');
            $('#btnKonfirmasi').addClass('d-none')
            if (status === 1) {
                $('#btnKonfirmasi').removeClass('d-none').addClass('m-3')
            } else if (status === 2) {
                $('#statusDesain').html('<label class="fw-bold m-3">Desain Ditolak</label>');
            }  else if (status === 3) {
                $('#statusDesain').html('<label class="fw-bold m-3">Desain Diterima</label>');
            }
            $('#desain #imgDesain').attr('href', image);
            $('#desain #imgDesain img').attr('src', image);
            $('#desain').modal('show')
        })
    </script>

@endsection
