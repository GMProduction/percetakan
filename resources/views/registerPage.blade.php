<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Peminjaman Alat</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/myStyle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Styles -->
    <script src="{{ asset('js/swal.js') }}"></script>

</head>


<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card login-content shadow-lg border-0">
                <div class="card-body">

                    <h3 class="text-logo">Register</h3>
                    <br>
                    <form method="post" id="form" onsubmit="return saveRegister()">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label for="namaeditbarang" class="form-label t">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-2 text-left">
                                    <label for="namaeditbarang" class="form-label t">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>

                                <div class="mb-2 text-left">
                                    <label for="namaeditbarang" class="form-label t">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>


                                <div class="mb-2 text-left">
                                    <label for="namaeditbarang" class="form-label t">Password Konfirmasi</label>
                                    <input type="password" class="form-control" id="password" name="password_confirmation" required>
                                </div>
                                <div class="mb-2">
                                    <label for="namaeditbarang" class="form-label t">No. Ho</label>
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                                </div>
                                <div class="mb-2">
                                    <label for="ttlsiswa" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                </div>

                                <div class="text-center mt-5">
                                    <button class="btn btn-primary btn-sm border-0 ms-auto" type="submit"
                                            name="submit">Register
                                    </button>
                                    <span class="d-block mt-2">Sudah punya akun ? <a class="ms-2 link"
                                                                                     href="/login">Sign In.</a></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div style="height: 50px"></div>

        </div>
    </div>
</div>

<script src="{{ asset('bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/myStyle.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/dialog.js') }}"></script>

<script>
    $(function () {
        $("#datepicker").datepicker();
    });
    function afterRegister() {
       location.replace('/');
    }
    function saveRegister() {
        saveData('Register', 'form',null, afterRegister)
        return false;
    }
</script>
</body>


</html>
