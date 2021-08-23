@extends('base')

@section('moreCss')
    <?php
    header("Access-Control-Allow-Origin: *");
    ?>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')

    <section class="container">


        <div>
            <div style="height: 130px"></div>
            <h4 class="mb-4  fw-bold"><span class="text-primary">Custom Desain</span></h4>
            <hr>

            <div class="row">


                <div class="col-8">
                    <img src="{{ asset('static-image/own_design.jpg') }}" class="gambar-detail"/>
                    <p class="mt-3 fw-bold mb-0">
                        Custom Desain:
                    </p>

                    <p class="mt-3">
                        Ketentuan Custom Desain: .
                        Upload file dalam bentuk JPG / PNG, Isi secara detail produk yang kamu inginkan.
                    </p>
                </div>

                <div class="col-4">

                    <div class="table-container">
                        <h5 class="mb-5">Custom Desain</h5>


                        <form id="form" onsubmit="return saveCustom()" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="qty" class="form-label">Kategori Produk</label>
                                <select class="form-select me-2" aria-label="Default select example" id="kategori" name="kategori" required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Jenis Kertas</label>
                                <select class="form-select me-2" aria-label="Default select example" id="jenisKertas" name="jenisKertas" required>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Pakai Laminasi ?</label>
                                <select class="form-select me-2" aria-label="Default select example" name="laminasi" required>
                                    <option selected value="">Pilih Laminasi</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty">
                            </div>

                            <div class="mt-3 mb-3 mb-2">
                                <label for="imageFile" class="form-label">Upload File Gambar JPG / PNG</label>
                                <input class="form-control" type="file" id="imageFile" name="url_gambar" accept="image/jpeg, image/png">
                            </div>

                            <div class="mt-3 mb-3 mb-2">
                                <label for="formFile" class="form-label">Upload File yang di butuhkan</label>
                                <input class="form-control" type="file" id="formFile" name="url_file" accept="image/jpeg, image/png">
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Kota Pengiriman</label>
                                <select class=" me-2 w-100" aria-label="Default select example" id="kota" name="kota" onchange="setOngkir()" required>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Expedisi</label>
                                <select class=" me-2 w-100" aria-label="Default select example" id="kurir" name="kurir" onchange="setOngkir()" required>
                                    <option selected value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>
                            <div id="tipeKurir" class="mb-3">

                            </div>
                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Alamat Detail Pengiriman</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3" name="alamat"></textarea>
                            </div>


                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Keterangan Tambahan</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3" name="keterangan"></textarea>
                            </div>
                            <input id="ongkir" name="ongkir" hidden>
                            <input id="service" name="service" hidden>
                            <input id="estimasi" name="estimasi" hidden>
                            <input id="namaKota" name="nama_kota" hidden>
                            <input id="propinsi" name="propinsi" hidden>
                            <input id="propinsiid" name="propinsiid" hidden>
                            <div class="d-flex justify-content-between">
                                <p>Ongkir</p>
                                <h5 class="mb-5">Rp. <span id="tampilBiaya">0</span></h5>

                            </div>

                            <div class="mb-1"></div>
                            <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            getSelect('jenisKertas', '{{route('jenis_kertas')}}', 'nama_jenis')
            getSelect('kategori', '{{route('produk_kategori')}}', 'nama_kategori')
            // getAPIKota();
            getCity()
        });

        function afterOrder() {

        }

        function saveCustom() {
            @if(auth()->user() && auth()->user()->roles == 'user')
                saveData('Simpan Pesanan', 'form');
                return false;
            @else
                swal('Silahkan login / register untuk dapat melakukan pemesanan');
                return false;
            @endif

        }

        $(document).on('change','[name=tipePaket]', function () {
            var service = $(this).val();
            var biaya = $(this).data('biaya');
            var estimasi = $(this).data('estimasi');
           $('#ongkir').val(biaya);
           $('#service').val(service);
           $('#estimasi').val(estimasi);
           $('#tampilBiaya').html(biaya.toLocaleString());
        })

        function setOngkir() {
            var kurir = $('#kurir').val();
            var kota = $('#kota').val();
            var namaKota = $('#kota').find(':selected').data('nama');
            var propinsi = $('#kota').find(':selected').data('propinsi');
            var propinsiid = $('#kota').find(':selected').data('propinsiid');
            $('#namaKota').val(namaKota)
            $('#propinsi').val(propinsi)
            $('#propinsiid').val(propinsiid)
            var data = {
                'kurir': kurir,
                'tujuan': kota
            }
            $('#tipeKurir').html('');
            $.ajax({
                url: '/get-cost',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                // crossDomain: true,
                data: data,

                error: function (error, xhr, textStatus) {

                },
                success: function (data) {
                    console.log(data)
                    console.log(data['rajaongkir']['results'][0]['costs'])
                    $('#tipeKurir').append('<label>Layanan Pengiriman</labell>');
                    $.each(data['rajaongkir']['results'][0]['costs'], function (key, value) {
                        $('#tipeKurir').append('<div class="form-check">\n' +
                            '  <input class="form-check-input" type="radio" name="tipePaket" id="tipe'+key+'" data-estimasi="'+value['cost'][0]['etd']+'" data-biaya="'+value['cost'][0]['value']+'" value="'+value['service']+'">\n' +
                            '  <label class="form-check-label" for="tipe'+key+'">\n' +
                            '    '+value['service']+' ( '+value['cost'][0]['etd']+' ) '+value['cost'][0]['value']+'\n' +
                            '  </label>\n' +
                            '</div>')
                    })
                },
                headers: {
                    'Accept': "application/json",
                    'key': '7366bbad708dcf7d2f1b3d69e5f4219f',
                    'Access-Control-Allow-Origin': 'http://localhost:8002/'
                },

                cache: true
            })
        }

        function getCity() {
            var select = $('#kota');
            $.ajax({
                url: '/get-city',
                dataType: 'json',
                type: 'GET',
                delay: 250,
                // crossDomain: true,
                callback: '?',

                error: function (error, xhr, textStatus) {

                },
                success: function (data) {
                    console.log(data['rajaongkir'])
                    select.append('<option value="">Pilih Kota Pengiriman</option>')
                    $.each(data['rajaongkir']['results'], function (key, value) {
                        select.append('<option value="' + value['city_id'] + '" data-nama="' + value['city_name'] +'" data-propinsi="'+value['province']+'" data-propinsiid="'+value['province_id']+'">' + value['city_name'] + '</option>')
                    })
                    select.select2();
                },
                headers: {
                    'Accept': "application/json",
                    'key': '7366bbad708dcf7d2f1b3d69e5f4219f',
                    'Access-Control-Allow-Origin': 'http://localhost:8002/'
                },

                cache: true
            })
        }

        function getAPIKota() {
            $('#kota').select2({
                ajax: {
                    url: '/get-city',
                    dataType: 'json',
                    delay: 250,
                    crossDomain: true,
                    data: function (params) {
                        console.log(params)
                        return {
                            id: params.term,
                            province: 5,
                            page: params.page
                        }
                    },
                    complete: function (xhr, textStatus, data) {
                        console.log(xhr);
                        console.log(xhr.status);
                        console.log(textStatus);
                        console.log(data);
                    },
                    error: function (error, xhr, textStatus) {

                    },
                    headers: {
                        // 'Accept': "application/json",
                        'key': '7366bbad708dcf7d2f1b3d69e5f4219f'
                    },
                    processResults: function (data, params) {

                        console.log(data);
                        console.log(params);
                        params.page = params.page || 1;
                        return {
                            results: data.payload,
                            pagination: {
                                more: (params.page * 10) < data.total_count
                            }
                        };
                    },
                    cache: true

                },
                placeholder: 'Semua Data',
                minimumInputLength: 1,
                // templateResult: formatState,
                // templateSelection: formatRepoSelection
            });

            function formatRepoSelection(repo) {
                return repo.fullName || repo.text;
            }

            function formatState(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var level = repo[0]?.level || '';
                var $container = $(
                    '<div class="d-flex justify-content-start">' +
                    '   <div class="d-flex justify-content-center" style="width: 90px">' +
                    '       <img src="' + repo.avatar + '" height="60px" />' +
                    '   </div>' +
                    '   <div class="d-flex flex-column">' +
                    '       <div class="">' +
                    '           <span> ' + repo.fullName + '</span>  ' +
                    '       </div>' +
                    '       <div class="">' +
                    '          ' + level + '' +
                    '       </div>' +
                    '   </div>' +
                    '</div>'
                );

                return $container;

            }
        }
    </script>

@endsection
