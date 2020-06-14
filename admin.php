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
        <title>Data Peserta Tonas 2020 Mojang</title>
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
		<h2>Daftar Peserta di <?php echo ucfirst($kabkot); ?></h2>
		<hr>
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>EMAIL</th>
					<th>NAMA</th>
					<th>SEKOLAH</th>
					<th>KONFIRMASI</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//query ke database SELECT tabel mahasiswa urut berdasarkan id yang paling besar
                    $query = "SELECT * FROM users WHERE peran='peserta' AND kab_kot LIKE '%$kabkot%' ORDER BY pembayaran";
                    $stmt = $db->query($query);
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $count = $stmt->rowcount();
				//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
				if($count > 0){
					//membuat variabel $no untuk menyimpan nomor urut
					$no = 1;
					//melakukan perulangan while dengan dari dari query $sql
					foreach($users as $data){
						//menampilkan data perulangan
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['email'].'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['sekolah'].'</td>
							<td>'.$data['pembayaran'].'</td>
							<td>
								<a href="konfirm.php?id='.$data['email'].'" class="badge badge-warning">Lanjut</a>
								<a href="hapus.php?id='.$data['email'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Hapus</a>
							</td>
						</tr>
						';
						$no++;
					}
				//jika query menghasilkan nilai 0
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>