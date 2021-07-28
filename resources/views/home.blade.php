@extends('user/base')

@section('moreCss')
@endsection

@section('content')

    <section class="container">

        <div style="height: 130px"></div>
        <div class="row">
            <div class="col-lg-5">
                <img src="{{ asset('static-image/dubafest.jpg') }}"
                    style="width: 100%; height: 400px; object-fit: cover" />
            </div>

            <div class="col-lg-7">
                <p class="title-eventnow ms-2">DubaFest 2021 </p>
                <p class="date-eventnow ms-2">26 August 2021 - 28 August 2021</p>
                <p class="description-eventnow ms-2 mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not only
                    five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                    recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                @php($login = true)
                @if ($login)
                    <a href="register" class="btn btn-primary btn-lg  ms-2" data-bs-toggle="modal" data-bs-target="#register">Register
                        Now</a>
                @else
                    <a href="/login" class="btn btn-primary btn-lg  ms-2">Register Now</a>
                @endif


            </div>
        </div>

        <div style="height: 50px"></div>
        <div>
            <h4 class="mb-4">Incoming Event</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div style="height: 50px"></div>
        <div>
            <h4 class="mb-4">Past Event</h4>

            <div class="row">
                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="cardku">
                        <img src="{{ asset('static-image/dubafest.jpg') }}" />
                        <div class="content">
                            <p class="title mb-0">Title Card</p>
                            <p class="date">21 August 2021 - 26 August 2021</p>
                            <p class="description mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                                has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

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


@endsection
