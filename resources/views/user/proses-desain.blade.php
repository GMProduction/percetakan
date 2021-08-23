@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="row">
            <div class="col-md-6 col-sm-12" id="dataPesanan">
            </div>
        </div>


        <!-- Modal Tambah-->
        <div class="modal fade" id="desain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Register</h5>
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
                            <div class="" id="btnKonfirmasi">
                                <label class="form-label">Konfirmasi Desain</label>
                                <div class="d-flex">
                                    <form id="formTerima" onsubmit="return saveKonfirmasi(1)">
                                        @csrf
                                        <input name="status" value="3" hidden>
                                        <button type="submit" class="btn btn-sm btn-success me-2">Terima</button>
                                    </form>
                                    <form id="formTolak" onsubmit="return saveKonfirmasi(0)">
                                        @csrf
                                        <input name="status" value="2" hidden>
                                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#proses").addClass("active");
            getData()
        });
var idpesanan;
        function getData() {
            $.get('/user/proses/get', async function (data) {
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
                        var customHarga = value['custom'] ? value['custom']['satuan'] : null;
                        var button = '<a class="btn btn-primary btn-sm ms-auto" data-bank="' + bank + '" data-gambar="' + gambar + '" data-id="' + value['id'] + '" id="uploadPayment">Upload Pembayaran</a>'
                        if (!value['get_harga'] && !customHarga) {
                            button = '<h5 class="ms-auto" style="font-size: 1rem">Menunggu harga</h5>';
                        }
                        var totalHarga = value['total_harga'] ? value['total_harga'].toLocaleString() : 0;
                        $('#dataPesanan').append('<div class="item-box mb-3">\n' +
                            '                    <div class="d-flex">\n' +
                            '                        <img id=""\n' +
                            '                             src="' + value['url_gambar'] + '" />\n' +
                            '                        <div class="ms-4">\n' +
                            '                            <p class="qty fw-bold">#' + value['id'] + '</p>\n' +
                            '                            <p class="title">' + produkName + '</p>\n' +
                            '                            <p class="qty">Qty : ' + value['qty'] + '</p>\n' +
                            '                            <p class="keterangan">' + value['keterangan'] + '</p>\n' +
                            '                            <p class="totalHarga">Rp. ' + totalHarga + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="d-flex" id="">\n' +
                            '                    <a class="btn btn-warning btn-sm ms-auto mx-2" id="invoice" data-id="' + value['id'] + '" ><i class="bx bx-file"></i></a>' +
                            '                    <div id="btnLihatDesain"><div>' +
                            '</div>\n' +
                            '                </div>')
                        if (value['get_desain']){
                            $('#btnLihatDesain').html('<a class="btn btn-success btn-sm ms-auto" id="desainData" data-status="' + value['status_desain'] + '" data-id="' + value['id'] + '" data-image="' + value['get_desain']['url_desain'] + '">Lihat Desain</a>')
                        }

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

        function saveKonfirmasi(a) {
            var isi = 'Tolak'
            var form = 'formTolak'
            if (a === 1) {
                isi = 'Terima'
                form = 'formTerima'
            }
            saveData(isi + ' Desain', form, '/user/proses/' + idpesanan + '/konfirmasi',afterAddHartga);
            return false;
        }
        function afterAddHartga() {
            $('#desain').modal('hide')
            getData()
        }
     </script>

@endsection
