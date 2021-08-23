@extends('base')

@section('moreCss')
@endsection

@section('content')

    <section>
        <div style="height: 80px"></div>

        <div class="slider">

        </div>

        <div style="height: 50px"></div>
    </section>
    <section class="container">


        <div>
            <h4 class="mb-4 text-center fw-bold">Mau Cetak Apa ?</h4>

            <div class="row">
                <div class="grid">
                    @forelse($kategori as $k)
                        <figure class="effect-honey" style="height: 200px">
                            <img src="{{asset($k->url_gambar)}}"/>
                            <figcaption>
                                <h2>{{$k->nama_kategori}}</h2>
                                <a href="/produk?kategori={{$k->nama_kategori}}">View more</a>
                            </figcaption>
                        </figure>
                    @empty
                        <h4>Tidak ada kategori</h4>
                    @endforelse
                </div>


            </div>
        </div>

        <div style="height: 50px"></div>
        <div>
            <h4 class="mb-5 text-center fw-bold">Rekomendasi Untukmu</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/own_design.jpg') }}"/>
                        <div class="content">
                            <p class="title mb-0 text-primary">Desain Sendiri</p>
                            <p class="description mb-0">Upload desain mu sendiri, buat sesuai yang kamu inginkan.</p>

                            <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/custom">Mulai Pesan</a>
                        </div>
                    </div>

                </div>
                @forelse($produk as $p)
                    <div class="col-lg-3">
                        <div class="cardku">
                            <img src="{{ asset($p->url_gambar) }}"/>
                            <div class="content">
                                <p class="title mb-0 text-primary">{{$p->nama_produk}}</p>
                                <p class="date">{{$p->getKategori->nama_kategori}}</p>
                                <p class="description mb-0">{{$p->deskripsi}}</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/produk/detail/{{$p->id}}">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4 class="text-center">Tidak ada produk {{request('kategori')}}</h4>

                @endforelse

            </div>
        </div>

        <!-- Modal Tambah-->

    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function () {
            getBaner()
        });

        function getBaner(){
            $.get('/baner', function (data) {
                var slider = $('.slider');
                if (data.length > 0){
                    $.each(data, function (key, value) {
                        slider.append('<a target="_blank" href="'+value['url_web']+'"><img src="'+value['url_gambar']+'"/></a>')
                    })

                    slider.slick({
                        dots: true,
                        infinite: true,
                        speed: 500,
                        fade: true,
                        cssEase: 'linear',
                        autoplay: true,
                        autoplaySpeed: 2000,
                        arrows: false
                    });
                }else{
                    slider.append('<h4 class="text-center">Tidak ada baner<h4>')
                }
            })
        }
    </script>

@endsection
