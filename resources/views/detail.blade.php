@extends('base')

@section('moreCss')
@endsection

@section('content')


    <section class="container">


        <div>
            <div style="height: 130px"></div>
            <h4 class="mb-4  fw-bold"><span class="text-primary">Nama Barang</span> (kategori)</h4>
            <hr>

            <div class="row">


                <div class="col-8">
                    <img src="https://tympanus.net/Development/HoverEffectIdeas/img/4.jpg" class="gambar-detail" />
                    <p class="mt-3 fw-bold mb-0">
                        Tersedia Bahan:
                    </p>
                    <p class="mb-0">
                        Bahan 1
                    </p>
                    <p class="mb-0">
                        Bahan 2
                    </p>
                    <p class="mb-0">
                        Bahan 3
                    </p>
                    <p class="mt-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                        an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                        has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of
                        Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                        software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>

                <div class="col-4">

                    <div class="table-container">
                    <h5 class="mb-5">Pesan Barang</h5>


                        <form>
                            <div class="mb-3">
                            <select class="form-select me-2" aria-label="Default select example" name="jenisKertas">
                                <option selected>Pilih Jenis Kertas</option>
                                <option value="1">Kertas 1</option>
                                <option value="2">Kertas 2</option>
                            </select>
                        </div>

                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="number" class="form-control" id="qty">
                            </div>

                            <div class="mt-3 mb-3 mb-2">
                                <label for="formFile" class="form-label">Upload File yang di butuhkan</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>

                            <div class="mb-3">
                                <label for="keteranganTambahan" class="form-label">Keterangan Tambahan</label>
                                <textarea class="form-control" id="keteranganTambahan" rows="3"></textarea>
                              </div>

                            <p class="mb-0 mt-5 fw-bold">Total</p>
                            <h4 class="mb-5">Rp. 1.000.000</h4>
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
