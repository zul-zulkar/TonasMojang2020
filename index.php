<?php
    require('user_session.php');
    require('connect_database.php');
    if ($peran == 'admin'){
        header("Location: admin.php");
    }
    if (isset($_POST['upload'])){
        $temp = $_FILES['gambar']['tmp_name'];
        $name = rand(0,9999).$_FILES['gambar']['name'];
        $size = $_FILES['gambar']['size'];
        $type = $_FILES['gambar']['type'];
        $folder = "files/";
        if ($size < 5120000 and ($type =='image/jpeg' or $type == 'image/jpg' or $type == 'image/png')) {
            move_uploaded_file($temp, $folder.$name);
            $query = "UPDATE users SET kwitansi=:name, tipe=:type, ukuran=:size WHERE nama=:pengguna";
            $update = $db->prepare($query);
            $params = array(
                ":name" => $name,
                ":type" => $type,
                ":size" => $size,
                ":pengguna" => $pengguna
            );
            $update->execute($params);
            $terdampak = $update->rowcount();
            if ($terdampak == 1){
                session_destroy();
                $pesan ='Berhasil mengunggah bukti pembayaran!!! Masukkan kembali password Anda';
                header("location: login.php?gameid=$pesan&relog=$email");
            } else {
                $bahaya = '<b>Gagal mengunggah bukti pembayaran</b>';
                header("location: index.php?pesan=$bahaya");
            }
        }else{
            $bahaya = '<b>Gagal mengunggah bukti pembayaran</b>';
            header("location: index.php?pesan=$bahaya");
        }
    } else if (isset($_POST['delete'])) {
        $query = "UPDATE users SET kwitansi=NULL, tipe=NULL, ukuran=0 WHERE nama=:pengguna";
        $update = $db->prepare($query);
        $params = array(
            ":pengguna" => $pengguna
        );
        $update->execute($params);
        $terdampak = $update->rowcount();
        if ($terdampak == 1){
            session_destroy();
            $pesan ='Berhasil menghapus bukti pembayaran!!! Masukkan kembali password Anda';
            header("location: login.php?gameid=$pesan&relog=$email");
        } else {
            $bahaya = '<b>Gagal menghapus bukti pembayaran</b>';
            header("location: index.php?pesan=$bahaya");
        }
    }


    if (isset($_POST['logout'])){
        session_unset('user');
        session_destroy();
        header('Location: login.php');
    }
    if (isset($_GET['pesan'])) {
        $messeji = $_GET['pesan'];
    } else {
        $messeji = '';
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Pembayaran Tonas 2020 Mojang</title>
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
                    <form action="" method="post">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <button type="submit" class="nav-link" id="nav-ling" name="logout">Logout</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profil_peserta.php">Profil</a>
                        </li>
                    </ul>
                    </form>
                </div>
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                    <div class="container text-center">
                        <?php if ($kwitansi != '' && $bayar=='belum bayar'){ ?>
                                <h3>Halo <?php echo $pengguna['nama']; ?>, Pembayaran kamu akan diproses dalam waktu 1x24 jam</h3>
                                <hr>
                                <img src="files/<?php echo $kwitansi; ?>" width="400"/>
                        <?php } else if ($kwitansi == '' && $bayar=='belum bayar'){ ?>
                                <h3>Halo <?php echo $pengguna; ?>, Selesaikan pembayaran Anda</h3>
                                <hr>
                                <img src="files/belum_bayar.png" width="400"/>
                        <?php } else if ($kwitansi != '' && $bayar=='sudah bayar'){ ?>
                                <h3>
                                    Halo <?php echo $pengguna; ?>, Pembayaran kamu telah dikonfirmasi.
                                    <br><br>
                                    <img src="files/checklist.png" width="100"/>
                                    <br><br>
                                    Silahkan masuk ke [web bimbel] menggunakan voucher : [your voucher]
                                </h3>
                                <img src="files/closing.png" width="450"/>
                        <?php } ?>
                        <?php if ($kwitansi != '' && $bayar=='sudah bayar'){} else { ?>
                            <hr>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-control">
                                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                                </div>
                                <?php if ($messeji=='') {} else { ?>
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $messeji; ?>
                                </div>
                                <?php } ?>
                                <br>
                                <div class="col-12 col-sm-12 text-center">
                                    <button type="submit" name="upload" id="upload" class="btn btn-primary">Unggah</button>
                                    <button type="submit" name="delete" id="delete" class="btn btn-primary" onclick="return confirm('Yakin ingin menghapus bukti pembayaran ini?')">Hapus</button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>