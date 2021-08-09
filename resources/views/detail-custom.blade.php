@extends('base')

@section('moreCss')
@endsection

@section('content')


    <section class="container">


        <div>
            <div style="height: 130px"></div>
            <h4 class="mb-4  fw-bold"><span class="text-primary">Custom Desain</span></h4>
            <hr>

            <div class="row">


                <div class="col-8">
                    <img src="https://tympanus.net/Development/HoverEffectIdeas/img/4.jpg" class="gambar-detail" />
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


                        <form>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Jenis Kertas</label>
                                <select class="form-select me-2" aria-label="Default select example" name="jenisKertas">
                                    <option selected>Pilih Jenis Kertas</option>
                                    <option value="1">Kertas 1</option>
                                    <option value="2">Kertas 2</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Pakai Laminasi ?</label>
                                <select class="form-select me-2" aria-label="Default select example" name="jenisKertas">
                                    <option selected>Pilih Laminasi</option>
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty">
                            </div>

                            <div class="mt-3 mb-3 mb-2">
                                <label for="imageFile" class="form-label">Upload File Gambar JPG / PNG</label>
                                <input class="form-control" type="file" id="imageFile">
                            </div>

                            <div class="mt-3 mb-3 mb-2">
                                <label for="formFile" class="form-label">Upload File yang di butuhkan</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Kota Pengiriman</label>
                                <select class="form-select me-2" aria-label="Default select example" name="jenisKertas">
                                    <option selected>Pilih Kota</option>
                                    <option value="1">Solo</option>
                                    <option value="2">Sukoharjo</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Alamat Detail Pengiriman</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3"></textarea>
                            </div>


                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Keterangan Tambahan</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p>Ongkir</p>
                                <h5 class="mb-5">Rp. 12.000</h5>

                            </div>

                            <div class="mb-1"></div>
                            <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>

    </section>


@endsection

@section('script')


@endsection
