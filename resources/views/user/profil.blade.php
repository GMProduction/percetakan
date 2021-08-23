@extends('user.dashboard')

@section('contentUser')



    <section class="container">

        <div class="row">
            <div class="col-6">
                <div class="item-box">
                    <div class="d-flex justify-content-between">
                        <h5>Profile</h5>
                        <a class="btn btn-primary btn-sm" id="editData">Edit</a>
                    </div>
                    <form id="form">
                        @csrf
                        <div class="mb-3">
                            <label for="dNamaProduk" class="form-label">Nama</label>
                            <input type="text" class="form-control" readonly id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. Hp</label>
                            <input type="text" class="form-control" readonly id="no_hp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" readonly id="alamat" name="alamat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" readonly id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" readonly id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" readonly id="password_confirmation" name="password_confirmation">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="item-box">
                    <h5>Image</h5>
                    <form id="formImg" enctype="multipart/form-data" onsubmit="return saveImg()">
                        @csrf
                       <div class="d-flex justify-content-center">
                           <img id="img" src=""
                                class="rounded-circle" style="height: 300px; width: 300px"/>
                       </div>
                        <div class="my-3">
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>


    </section>


@endsection

@section('scriptUser')

    <script>
        $(document).ready(function () {

            $("#profil").addClass("active");
            getData();
        });

        function getData() {
            $.get('/user/profile/get', async function (data) {
                console.log(data)
                $('#username').val(data['username']);
                $('#nama').val(data['get_pelanggan']['nama']);
                $('#alamat').val(data['get_pelanggan']['alamat']);
                $('#img').attr('src', data['get_pelanggan']['image'])
                $('#no_hp').val(data['get_pelanggan']['no_hp']);
                $('#password').val('********');
                $('#password_confirmation').val('********');
            })
        }

        $(document).on('click', '#editData', function () {
            var tipe = $(this).html();
            $('#form input').removeAttr('readonly');
            $('#form textarea').removeAttr('readonly');
            if (tipe === 'Save') {
                saveDataObject('Update profile', $('#form').serialize(), '/user/profile/update-profile', afterSave)
                return false;

            } else {
                $(this).html('Save')
            }

        })

        function afterSave() {
            $('#form input').attr('readonly', '');
            $('#form textarea').attr('readonly', '');
            $('#editData').html('Edit')
            getData()
        }

        function saveImg() {
            saveData('Update Image', 'formImg', '/user/profile/update-image', afterSave)
            return false;
        }
    </script>

@endsection
