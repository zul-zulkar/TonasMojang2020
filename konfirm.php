<?php
    require('connect_database.php');
    require('user_session.php');
    if (isset($_POST['logout'])){
        session_unset('user');
        session_destroy();
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Konfirmasi pembayaran Tonas 2020 Mojang</title>
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
                    </ul>
                    </form>
                </div>
            </div>
        </nav>

    <div class="container" style="margin-top:20px">
	    <h2>Edit Peserta</h2>
		<hr>
	    <?php
        if(isset($_GET['id'])){
            $email = $_GET['id'];
            $query = "SELECT * FROM users WHERE email=:email";
            $stmt = $db->prepare($query);
            $param = array(
                ":email" => $email
            );
            $stmt->execute($param);
            $cek = $stmt->rowcount();
            //jika hasil query = 0 maka muncul pesan error
            if($cek != 1){
                echo '<div class="alert alert-warning">Data tidak ada dalam database.</div>';
                exit();
            //jika hasil query > 0
            }else{
                //membuat variabel $data dan menyimpan data row dari query
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        ?>
        
        <?php
        //jika tombol simpan di tekan/klik
        if(isset($_POST['submit'])){
            $aksi = $_POST['submit'];
            $status ='';
            $email = $_GET['id'];
            $voucher = !empty($_POST['kupon']) ? $_POST['kupon'] : '';
            if ($aksi == "Konfirmasi"){
                $status = 'sudah bayar';
            } else if ($aksi == "Batalkan") {
                $status = 'belum bayar';
                $voucher = '';
            }
            $query = "UPDATE users SET pembayaran = :pembayaran, voucher=:voucher WHERE email=:email";
            $stmt = $db->prepare($query);
            $param = array(
                ":pembayaran" => $status,
                ":voucher" => $voucher,
                ":email" => $email
            );
            $stmt->execute($param);
            $cek = $stmt->rowcount();
            if($cek == 1){
                echo '<script>alert("Berhasil memperbarui data."); document.location="admin.php";</script>';
            } else {
                echo '<script>alert("Gagal memperbarui data."); document.location="admin.php";</script>';
            }
        }
        ?>
            
        <form action="konfirm.php?id=<?php echo $email; ?>" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" name="nim" class="form-control" size="4" value="<?php echo $user['nama']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Asal Sekolah</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['sekolah']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['kelas']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Provinsi Domisili</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['provinsi']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kabupaten / Kota</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['kab_kot']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Whatsapp</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['whatsapp']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email / Surel</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['email']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['tanggal_buat']; ?>" readonly required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                <div class="col-sm-10">
                    <?php if ($user['kwitansi'] == ''){ ?>
                            <img src="files/menunggu.png" width="400"/>
                    <?php } else { ?>
                            <img src="files/<?php echo $user['kwitansi']; ?>" width="400"/>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <?php if ($user['pembayaran'] == 'sudah bayar'){ ?>
                        <div class="alert alert-success" role="alert">
                            <b><?php echo $user['pembayaran']; ?></b>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            <b><?php echo $user['pembayaran']; ?></b>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Voucher</label>
                <div class="col-sm-10">
                    <input type="text" name="kupon" id="kupon" minlength="6" maxlength="6" class="form-control" value="<?php echo $user['voucher']; ?>" onchange="masukanKupon();" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10">
                    <?php if ($user['kwitansi'] == ''){ ?>
                        <input type="submit" name="submit" class="btn btn-primary" value="Konfirmasi" disabled>
                    <?php } else if ($user['pembayaran'] == 'sudah bayar'){ ?>
                        <input type="submit" name="submit" class="btn btn-primary" value="Batalkan">
                    <?php } else { ?>
                        <input type="submit" name="submit" id="konfirm" class="btn btn-primary" value="Konfirmasi">
                    <?php } ?>
                    <a href="admin.php" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </form>
    </div>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>