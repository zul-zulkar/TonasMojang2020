<?php
require('connect_database.php');
require('user_session.php');
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$pesan ='';
if(isset($_POST['login'])){
    try{
        $email = test_input($_POST["email"]);
        $password = md5(test_input($_POST["password"]));
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($query);
        // bind parameter ke query
        $params = array(
            ':email' => $email
        );
        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // jika user terdaftar
        if($user){
        // verifikasi password
            if($password == $user["password"]){
            // buat Session
                session_start();
                $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman form
                
                if ($user['peran'] == 'peserta'){
                    header("Location:index.php");
                } else {
                    header("Location:admin.php");
                }
                
            } else {
                $pesan = "Password salah !!!";
                header("Location:login.php?gameid=$pesan");
            }
        } else {
            $pesan = "Username tidak ditemukan !!!";
            header("Location:login.php?gameid=$pesan");
        }
    } catch (PDOException $e) {
        echo "Koneksi Gagal ".$e->getMessage();
    }
} else if (isset($_POST['buat_akun'])){
    try {
        
        $nama = test_input($_POST["namalengkap"]);
        $sekolah = test_input($_POST["sekolah"]);
        $kelas = test_input($_POST["kelas"]);
        $provinsi = test_input($_POST["provinsi"]);
        $kabkot = test_input($_POST["kabkot"]);
        $whatsapp = test_input($_POST["nowa"]);
        $email = test_input($_POST["email"]);
        $password = md5(test_input($_POST["password"]));
        $query = "INSERT INTO users (nama, sekolah, kelas, provinsi, kab_kot, whatsapp, email, password) VALUES (:nama, :sekolah, :kelas, :provinsi, :kab_kot, :whatsapp, :email, :password)";
        $stmt = $db->prepare($query);
        // bind parameter ke query
        $params = array(
            ':nama' => $nama, 
            ':sekolah' => $sekolah,
            ':kelas' => $kelas,
            ':provinsi' => $provinsi,
            ':kab_kot' => $kabkot,
            ':whatsapp' => $whatsapp,
            ':email' => $email,
            ':password' => $password
        );
        $stmt->execute($params);
        if ($stmt){
            $pesan = "berhasil membuat akun !!!";
            header("Location:/login.php?gameid=$pesan");
        }
    } catch (PDOException $e) {
        echo "Koneksi Gagal ".$e->getMessage();
    }
} else if (isset($_POST['edit'])){
    try {
        $nama = test_input($_POST["namalengkap"]);
        $sekolah = test_input($_POST["sekolah"]);
        $kelas = test_input($_POST["kelas"]);
        $kabkot = test_input($_POST["kabkot"]);
        $whatsapp = test_input($_POST["nowa"]);
        $sql = "UPDATE users SET nama=:nama, sekolah=:sekolah, kelas=:kelas, kab_kot=:kabkot, whatsapp=:whatsapp, tanggal_update=now()  WHERE email=:email";
        $stmt = $db->prepare($sql);
        $param = array(
            ':nama' => $nama,
            ':sekolah' => $sekolah,
            ':kelas' => $kelas,
            ':kabkot' => $kabkot,
            ':whatsapp' => $whatsapp,
            ':email' => $pengguna['email']
        );
        $stmt->execute($param);
        $user = $stmt->rowcount();
        if ($user == 1){
            session_destroy();
            $pesan ='Profil berhasil diperbarui!! Masukkan kembali password Anda';
            header("location: login.php?gameid=$pesan&relog=$email");
        } else {
            $pesan = "Gagal memperbarui profil !!!";
            header("Location:profil_peserta.php?gameid=$pesan");
        }
    } catch (PDOException $e) {
        echo "Koneksi Gagal ".$e->getMessage();
    }
}
?>