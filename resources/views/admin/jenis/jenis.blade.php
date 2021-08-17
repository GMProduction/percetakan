@extends('admin.base')
@section('title')
    Data Jenis Kertas
@endsection
@section('content')

    <section class="m-2">


        <div class="table-container">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Data Jenis Kertas</h5>
                <button type="button ms-auto" class="btn btn-primary btn-sm" id="addData">Tambah Data
                </button>
            </div>

            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Jenis Kertas</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                @forelse($data as $key => $d)
                    <tr>
                        <td width="20">{{$key+1}}</td>
                        <td>{{$d->nama_jenis}}</td>
                        <td width="50">
                            <a class="btn btn-sm btn-primary" id="editData" data-id="{{$d->id}}" data-nama="{{$d->nama_jenis}}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="8">Tidak ada kategori</td>
                    </tr>
                @endforelse

            </table>
            <div class="d-flex justify-content-end">
                {{$data->links()}}
            </div>
        </div>

        <div class="modal fade" id="tambahkategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formKategori" onsubmit="return saveKategori()">
                            @csrf
                            <input id="id" name="id" type="number" hidden>
                            <div class="mb-3">
                                <label for="nama_jenis" class="form-label">Nama Jenis Kertas</label>
                                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" required>
                            </div>

                            <div class="mb-4"></div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


@endsection

@section('script')
<script>
    $(document).on('click','#addData', function () {
        $('#tambahkategori #id').val('')
        $('#tambahkategori #nama_jenis').val('')

        $('#tambahkategori').modal('show')
    })

    $(document).on('click','#editData', function () {
        $('#tambahkategori #id').val($(this).data('id'))
        $('#tambahkategori #nama_jenis').val($(this).data('nama'))
        $('#tambahkategori').modal('show')
    })

    function saveKategori() {
        saveData('Tambah Jenis Kertas', 'formKategori');
        return false;
    }
</script>

@endsection
