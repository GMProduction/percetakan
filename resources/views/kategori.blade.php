@extends('base')

@section('moreCss')
@endsection

@section('content')

    <section>
        <div style="height: 80px"></div>

            
        <div class="slider">
            <img src="https://tympanus.net/Development/HoverEffectIdeas/img/4.jpg" alt="img04" />
        </div>
        <div style="height: 50px"></div>
    </section>
    <section class="container">

        <div>
            <h4 class="mb-5 text-center fw-bold">Desain Undangan Yang Kami Punya</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0 text-primary">Nama Barang</p>
                            <p class="date">Kategori</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/detail" >Pesan Sekarang</a>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0 text-primary">Nama Barang</p>
                            <p class="date">Kategori</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/detail" >Pesan Sekarang</a>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0 text-primary">Nama Barang</p>
                            <p class="date">Kategori</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/detail" >Pesan Sekarang</a>
                        </div>
                    </div>
                    
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0 text-primary">Nama Barang</p>
                            <p class="date">Kategori</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                                <a type="button" class="btn btn-primary btn-sm ms-auto mt-3" href="/detail" >Pesan Sekarang</a>
                        </div>
                    </div>
                    
                </div>
            </div>
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
