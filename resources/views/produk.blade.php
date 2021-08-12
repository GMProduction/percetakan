@extends('base')

@section('moreCss')
@endsection

@section('content')

    <section>
        <div style="height: 80px"></div>


        <div class="slider">
            <img src="https://tympanus.net/Development/HoverEffectIdeas/img/4.jpg" alt="img04"/>
        </div>
        <div style="height: 50px"></div>
    </section>
    <section class="container">

        <div>
            <h4 class="mb-5 text-center fw-bold">Desain {{request('kategori')}} Yang Kami Punya</h4>

            <div class="row">
                @forelse($data as $d)
                    <div class="col-lg-3">
                        <div class="cardku">
                            <img src="{{ asset($d->url_gambar) }}"/>
                            <div class="content">
                                <p class="title mb-0 text-primary">{{$d->nama_produk}}</p>
                                <p class="date">{{$d->getKategori->nama_kategori}}</p>
                                <p class="description mb-0">{{$d->deskripsi}}</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/produk/detail/{{$d->id}}">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4 class="text-center">Tidak ada produk {{request('kategori')}}</h4>
                @endforelse

            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$data->links()}}
        </div>
        <!-- Modal Tambah-->
        <div class="modal fade" id="register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Payment Slip</label>
                                <input class="form-control" type="file" id="formFile">
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

@section('script')

    <script>

    </script>

@endsection
