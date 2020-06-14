<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/style.css">
        <title>Login Tonas 2020 Mojang</title>
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
                            <a class="nav-link" href="/register.php">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <?php 
            if (isset($_GET['gameid'])) {
                $pesan = $_GET['gameid'];
            } else {
                $pesan = '';
            }
            
            if (isset($_GET['relog'])) {
                $mail = $_GET['relog'];
            } else {
                $mail = '';
            }
        ?>

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                    <img src="files/login.png" width="100%"/>
                    <div class="container">
                        <hr>
                        <h3>Login</h3>
                        <hr>
                        <?php if ($pesan == "Password salah !!!" || $pesan == "Username tidak ditemukan !!!"){ ?>
                            <div class="alert alert-danger" role="alert">
                        <?php } else if ($pesan=='') {} else { ?>
                            <div class="alert alert-success" role="alert">
                        <?php } ?>
                                <?php echo $pesan; ?>
                            </div>
                        <form action="/get_user.php" method="post" class="">
                            <div class="form-group">
                                <label for="email">Alamat Email/Surel</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $mail ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <button type="submit" name="login" id="login" class="btn btn-primary">Login</button>
                                </div>
                                <div class="col-12 col-sm-8 text-right">
                                    <a href="/register.php">Belum mempunyai akun?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>