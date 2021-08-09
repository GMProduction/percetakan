@extends('admin.base')

@section('title')
    Data Barang
@endsection

@section('content')

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            swal("Berhasil!", "Berhasil Menambah data!", "success");
        </script>
    @endif

    <section class="m-2">


        <div class="table-container">


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Pelanggan</h5>

            </div>


            <table class="table table-striped table-bordered ">
                <thead>
                <th>#</th>
                <th>Username</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No Hp</th>
                </thead>
                @forelse($data as $key => $d)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$d->username}}</td>
                        <td>{{$d->getPelanggan->nama}}</td>
                        <td>{{$d->getPelanggan->alamat}}</td>
                        <td>{{$d->getPelanggan->no_hp}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5">Tidak ada data pelanggan</td>
                    </tr>
                @endforelse
            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>


    </section>

@endsection

@section('script')

@endsection
