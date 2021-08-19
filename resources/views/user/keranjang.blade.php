@extends('user.dashboard')

@section('contentUser')



    <section class="container">
        <div class="row item-box mb-5">
            <p class="fw-bold">Pembayaran Bisa di Lakukan di</p>

            @forelse($bank as $b)
                <div class="item-box mb-2">
                    <div class="d-flex">
                        <img
                            src="{{$b->url_gambar}}"/>
                        <div class="ms-4 flex-fill">
                            <div class="d-flex justify-content-between">
                                <p class="title">{{$b->nama_bank}}</p>
                            </div>
                            <p class=" qty mb-0">Holder Name : {{$b->holder_bank}}</p>
                            <p class="keterangan mb-3">No Rekening : {{$b->norek}}</p>
                        </div>

                    </div>

                </div>
            @empty
            @endforelse
            <label class="fw-bold">Batas waktu pembayaran maksimal 1 x 24 jam</label>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12" id="dataPesanan">

            </div>
        </div>


        <!-- Modal Tambah-->
        <div class="modal fade" id="uploadpembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formPayment" enctype="multipart/form-data" onsubmit="return savePayment()">
                            @csrf
                            <input id="id" name="id" hidden>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Pilih Bank</label>
                                <select id="bank" name="bank" class="form-select"></select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Bukti Transfer</label>
                                <input class="form-control" type="file" id="url_gambar" name="url_gambar" accept="image/jpeg, image/png">
                                <a id="imgPay" href="" target="_blank"><img class="mt-2" src="" style="width: 200px"/></a>
                            </div>


                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#keranjang").addClass("active");
            getData()
            getBank()

        });

        function getData() {
            $.get('/user/keranjang/get', async function (data) {
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
                            '                            <p class="title">' + produkName + '</p>\n' +
                            '                            <p class="qty">Qty : ' + value['qty'] + '</p>\n' +
                            '                            <p class="keterangan">' + value['keterangan'] + '</p>\n' +
                            '                            <p class="totalHarga">Rp. ' + totalHarga + '</p>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="d-flex">\n' +
                            '                       ' + button + ' \n' +
                            '                    </div>\n' +
                            '                </div>')
                    })
                }else{
                    $('#dataPesanan').html('<h6 class="">Tidak ada data</h6>');
                }
            })
        }

        function getBank(idValue) {
            var select = $('#bank');
            select.empty();
            select.append('<option value="" disabled selected>Pilih Data</option>')
            $.get('/user/get-bank', function (data) {
                $.each(data, function (key, value) {
                    if (idValue === value['id']) {
                        select.append('<option value="' + value['id'] + '" selected>' + value['nama_bank'] + ' ( an. ' + value['holder_bank'] + ' )</option>')
                    } else {
                        select.append('<option value="' + value['id'] + '">' + value['nama_bank'] + ' ( an. ' + value['holder_bank'] + ' )</option>')
                    }
                })
            })
        }

        $(document).on('click', '#uploadPayment', function () {
            var id = $(this).data('id');
            var gambar = $(this).data('gambar');
            var bank = $(this).data('bank');
            $('#uploadpembayaran #id').val(id);
            $('#uploadpembayaran #imgPay').addClass('d-none');
            if (bank) {
                $('#uploadpembayaran #imgPay').attr('href', gambar).removeClass('d-none');
                $('#uploadpembayaran #imgPay img').attr('src', gambar);
            }
            $('#uploadpembayaran #url_gambar').val('');
            getBank(bank)
            $('#uploadpembayaran').modal('show');
        })

        function afterSave() {
            getData();
            $('#uploadpembayaran').modal('hide');

        }

        function savePayment() {
            saveData('Upload Bukti Transfer', 'formPayment', '/user/keranjang/upload-image', afterSave)
            return false;
        }

    </script>

@endsection
