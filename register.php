<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/style.css">
        <title>Formulir Registrasi Tonas 2020 Mojang</title>
        <link rel="shortcut icon" href="icon.png">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Login Calon Peserta Tonas Online 2020 Mojang</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3>Registrasi</h3>
                <hr>
                <form action="/get_user.php" method="post" class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="namalengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" maxlength="255" name="namalengkap" id="namalengkap" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="sekolah">Asal sekolah</label>
                                <input type="text" class="form-control" minlength="6" maxlength="50" name="sekolah" id="sekolah" value="" placeholder="SLTA/sederajat" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" id="kelas" required>
                                    <option value="" selected>Pilih kelas</option>
                                    <option value="alumni">Alumni</option>
                                    <option value="xii">XII</option>
                                    <option value="xi">XI</option>
                                    <option value="x">X</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi Domisili</label>
                                <select name="provinsi" id="provinsi" class="form-control" id="provinsi" required>
                                    <option value="" selected>Pilih Provinsi Asal</option>
                                    <option value="jawa timur">Jawa Timur</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                            <label for="kabkot">Kabupaten/Kota Domisili</label>
                                <select name="kabkot" class="form-control" id="kabkot" required>
                                    <option value="" selected>Pilih Kabupaten/Kota Asal</option>
                                    <option value="jombang">Jombang</option>
                                    <option value="mojokerto">Mojokerto</option>
                                    <option value="kota mojokerto">Kota Mojokerto</option>
                                    <option value="nganjuk">Nganjuk</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nowa">Nomor Whatsapp</label>
                                <input type="text" class="form-control" minlength="12" name="nowa" id="nowa" value="" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Alamat Email/Surel</label>
                                <input type="text" class="form-control" minlength="8" maxlength="50" name="email" id="email" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" minlength="8" maxlength="20" name="password" id="password" value="" pattern="[a-zA-Z0-9]+" onchange="validatePassword();" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="passconf">Password Konfirmasi</label>
                                <input type="password" class="form-control" minlength="8" maxlength="20" name="passconf" id="passconf" value="" onchange="validatePassword();" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-12 text-center">
                            <button type="submit" name='buat_akun' id='buat_akun' class="btn btn-primary">Buat Akun</button>
                        </div>
                        <div class="col-12 col-sm-12 text-center">
                            <a href="/login.php">Sudah mempunyai akun?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <script src="/js/register.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>