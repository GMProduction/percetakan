@extends('base')

@section('moreCss')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@endsection

@section('content')


    <section class="container">


        <div>
            <div style="height: 130px"></div>
            <h4 class="mb-4  fw-bold"><span class="text-primary">{{$data->nama_produk}}</span> ({{$data->getKategori->nama_kategori}})</h4>
            <hr>
            <div class="row">
                <div class="col-8">
                    <img src="{{$data->url_gambar}}" class="gambar-detail"/>
                    <p class="mt-3 fw-bold mb-0">
                        Bahan Tersedia :
                    </p>
                    @forelse($data->getHarga as $b)
                        <p class="mb-0">
                            {{$b->getJenis->nama_jenis}}
                        </p>
                    @empty
                        <p class="mb-0">
                            Belum ada data bahan
                        </p>
                    @endforelse
                    <p class="mt-3">{{$data->deskripsi}}</p>
                </div>

                <div class="col-4">

                    <div class="table-container">
                        <h5 class="mb-5">Pesan Barang</h5>
                        <form id="form" enctype="multipart/form-data" onsubmit="return savePesanan()">
                            @csrf
                            <div class="mb-3">
                                <label for="qty" class="form-label">Jenis Kertas</label>
                                <select class="form-select me-2" aria-label="Default select example" id="jenisKertas" name="jenisKertas" required>
                                    <option value="">Pilih data</option>
                                    @forelse($data->getHarga as $h)
                                        <option value="{{$h->id}}" data-harga="{{$h->harga}}">{{$h->getJenis->nama_jenis}} (Rp. {{number_format($h->harga,0)}})</option>
                                    @empty
                                        <option value="">Tidak ada data</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Pakai Laminasi ?</label>
                                <select class="form-select me-2" aria-label="Default select example" id="laminasi" name="laminasi" required>
                                    <option selected value="">Pilih Laminasi</option>
                                    <option value="1">Ya (Rp. {{number_format($data->biaya_laminasi,0)}})</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" value="0" required>
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
                                <select class=" me-2 w-100" aria-label="Default select example" id="kurir" name="kurir" onchange="setOngkir()">
                                    <option selected value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>
                            </div>
                            <div id="tipeKurir" class="mb-3"></div>

                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Alamat Detail Pengiriman</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3" name="alamat" required></textarea>
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
                            <input id="totalHarga" name="totalHarga" hidden>
                            <p class="mb-0 mt-5 fw-bold">Biaya</p>
                            <div class="d-flex justify-content-between">
                                <p>Pesanan</p>
                                <h5 class="mb-0">Rp. <span id="tampilHarga">0</span></h5>

                            </div>

                            <div class="d-flex justify-content-between">
                                <p>Ongkir</p>
                                <h5 class="mb-0">Rp. <span id="tampilBiaya">0</span></h5>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <p>Total</p>
                                <h4 class="mb-5 fw-bold">Rp. <span id="tampilTotal">0</span></h4>

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
        var idHarga, hargaProduk, hargaLaminasi, hargaPesanan, ongkir = 0;
        $(document).ready(function () {
            getCity()
            hargaLaminasi = parseInt('{{$data->biaya_laminasi}}')
        });

        function afterOrder() {

        }

        function savePesanan() {
            @if(auth()->user() && auth()->user()->roles == 'user')
            saveData('Simpan Pesanan', 'form');
            return false;
            @else
            swal('Silahkan login / register untuk dapat melakukan pemesanan');
            return false;
            @endif

        }

        $(document).on('change', '[name=tipePaket]', function () {
            var service = $(this).val();
            ongkir = $(this).data('biaya');
            var estimasi = $(this).data('estimasi');
            var total = hargaPesanan + ongkir;
            $('#ongkir').val(ongkir);
            $('#service').val(service);
            $('#estimasi').val(estimasi);
            $('#tampilBiaya').html(ongkir.toLocaleString());
            $('#tampilTotal').html(total.toLocaleString());
            $('#totalHarga').val(total);
        })

        $(document).on('change', '#jenisKertas, #laminasi, #qty', function () {
            idHarga = $('#jenisKertas').val();
            hargaProduk = $('#jenisKertas').find(':selected').data('harga');
            var isLaminasi = $('#laminasi').val();
            var qty = $('#qty').val() ?? '0';
            hargaPesanan = hargaProduk * parseInt(qty);
            if (isLaminasi === '1'){
                hargaPesanan = (hargaProduk + hargaLaminasi) * parseInt(qty);
            }
            var total = hargaPesanan + ongkir;
            $('#tampilHarga').html(hargaPesanan.toLocaleString());
            $('#tampilTotal').html(total.toLocaleString());
            $('#totalHarga').val(total);
            console.log('laminasi '+hargaPesanan.toString());
            console.log('harga produk '+hargaProduk);
            console.log('harga laminasi '+hargaLaminasi);
            console.log('qty '+parseInt(qty));
            console.log('harga pesanan '+hargaPesanan);
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
                            '  <input class="form-check-input" type="radio" name="tipePaket" id="tipe' + key + '" data-estimasi="' + value['cost'][0]['etd'] + '" data-biaya="' + value['cost'][0]['value'] + '" value="' + value['service'] + '">\n' +
                            '  <label class="form-check-label" for="tipe' + key + '">\n' +
                            '    ' + value['service'] + ' ( ' + value['cost'][0]['etd'] + ' ) ' + value['cost'][0]['value'] + '\n' +
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
                        select.append('<option value="' + value['city_id'] + '" data-nama="' + value['city_name'] + '" data-propinsi="' + value['province'] + '" data-propinsiid="' + value['province_id'] + '">' + value['city_name'] + '</option>')
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
    </script>

@endsection
